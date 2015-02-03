    tinymce.PluginManager.add('template', function(editor) {
        var each = tinymce.each;

        function createTemplateList(callback) {
            return function() {
                var templateList = editor.settings.templates;

                if (typeof(templateList) == "string") {
                    tinymce.util.XHR.send({
                        url: templateList,
                        success: function(text) {
                            callback(tinymce.util.JSON.parse(text));
                        }
                    });
                } else {
                    callback(templateList);
                }
            };
        }

        function showDialog(templateList) {
            var win, values = [], templateHtml;

            if (!templateList || templateList.length === 0) {
                editor.windowManager.alert('No templates defined.');
                return;
            }

            tinymce.each(templateList, function(template) {
                values.push({
                    selected: !values.length,
                    text: template.title,
                    value: {
                        url: template.url,
                        content: template.content,
                        description: template.description,
                        image: template.image
                    }
                });
            });

            function onSelectTemplate(e) {
                var value = e.control.value();

                function showImage(image) {
                    var panel = win.find('panel')[0];
                    panel.innerHtml('<img src="'+image+'"/>');
                }

                function insertIframeHtml(html) {
                    if (html.indexOf('<html>') == -1) {
                        var contentCssLinks = '';

                        tinymce.each(editor.contentCSS, function(url) {
                            contentCssLinks += '<link type="text/css" rel="stylesheet" href="' + editor.documentBaseURI.toAbsolute(url) + '">';
                        });

                        html = (
                            '<!DOCTYPE html>' +
                            '<html>' +
                                '<head>' +
                                    contentCssLinks +
                                '</head>' +
                                '<body id="tinymce">' +
                                    html +
                                '</body>' +
                            '</html>'
                        );
                    }

                    html = replaceTemplateValues(html, 'template_preview_replace_values');

                    var doc = win.find('iframe')[0].getEl().contentWindow.document;
                    doc.open();
                    doc.write(html);
                    doc.close();
                }

                if (value.url) {
                    tinymce.util.XHR.send({
                        url: value.url,
                        success: function(html) {
                            templateHtml = html;
                            insertIframeHtml(templateHtml);
                            showImage();
                        }
                    });
                } else {
                    //html
                    templateHtml = value.content;
                    insertIframeHtml(templateHtml);
                    //image
                    templateImage = value.image;
                    showImage(templateImage);
                }
                win.find('#description')[0].text(e.control.value().title);
            }

            win = editor.windowManager.open({
                title: 'Insert Template',
                layout: 'flex',
                direction: 'column',
                align: 'stretch',
                padding: 10,
                spacing: 5,
                width: 640,
                height: 530,
                items: [
                    {type: 'form', flex: 0, padding: 0, items: [
                        {type: 'container', label: 'Templates', items: {
                            type: 'listbox', label: 'Templates', name: 'template', autofocus: 1, values: values, onselect: onSelectTemplate
                        }}
                    ]},
                    //{type: 'label', name: 'description', label: 'Description', text: '\u00a0'},
                    {type: 'panel', html: '<img src="'+values[0].value.image+'"/>'},
                    {type: 'iframe', flex: 1, border: 0, hidden: 1}
                ],

                onsubmit: function() {
                    insertTemplate(false, templateHtml);
                },
            });
            win.find('listbox')[0].fire('select');
        }


        function replaceVals(e) {
            var dom = editor.dom, vl = editor.getParam('template_replace_values');

            each(dom.select('*', e), function(e) {
                each(vl, function(v, k) {
                    if (dom.hasClass(e, k)) {
                        if (typeof(vl[k]) == 'function') {
                            vl[k](e);
                        }
                    }
                });
            });
        }

        function replaceTemplateValues(html, templateValuesOptionName) {
            each(editor.getParam(templateValuesOptionName), function(v, k) {
                if (typeof(v) != 'function') {
                    html = html.replace(new RegExp('\\{\\$' + k + '\\}', 'g'), v);
                }
            });

            return html;
        }

        function insertTemplate(ui, html) {
            var el, n, dom = editor.dom, sel = editor.selection.getContent();

            html = replaceTemplateValues(html, 'template_replace_values');
            el = dom.create('div', null, html);

            // Find template element within div
            n = dom.select('.mceTmpl', el);
            if (n && n.length > 0) {
                el = dom.create('div', null);
                el.appendChild(n[0].cloneNode(true));
            }

            function hasClass(n, c) {
                return new RegExp('\\b' + c + '\\b', 'g').test(n.className);
            }

            each(dom.select('*', el), function(n) {
                // Replace selection
                if (hasClass(n, editor.getParam('template_selected_content_classes', 'selcontent').replace(/\s+/g, '|'))) {
                    n.innerHTML = sel;
                }
            });

            replaceVals(el);

            editor.execCommand('mceInsertContent', false, el.innerHTML);
            editor.addVisual();
        }

        editor.addCommand('mceInsertTemplate', insertTemplate);

        editor.addButton('template', {
            title: 'Insert Template',
            onclick: createTemplateList(showDialog)
        });

        editor.addMenuItem('template', {
            text: 'Insert Template',
            onclick: createTemplateList(showDialog),
            context: 'insert'
        });

        editor.on('PreProcess', function(o) {
            var dom = editor.dom;

            each(dom.select('div', o.node), function(e) {
                if (dom.hasClass(e, 'mceTmpl')) {
                    each(dom.select('*', e), function(e) {
                        if (dom.hasClass(e, editor.getParam('template_mdate_classes', 'mdate').replace(/\s+/g, '|'))) {
                            e.innerHTML = getDateTime(editor.getParam("template_mdate_format", editor.getLang("template.mdate_format")));
                        }
                    });

                    replaceVals(e);
                }
            });
        });
    });
