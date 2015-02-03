(function() {
    // Slideshow
    tinymce.PluginManager.add('slideshow', function(editor, url) {
        var slideCats = editor.settings.slidecats;
        editor.addButton('slideshow', {
            title: 'Insert Slideshow',
            icon: 'media',
            onclick: function() {
                // Open window
                editor.windowManager.open({
                    title: 'Insert Slideshow',
                    width: 600,
                    height: 350,
                    body: [
                        {
                            type: 'form',
                            items: [
                                {
                                    type: 'listbox',
                                    name: 'slideshow_id',
                                    label: 'Select a Slideshow',
                                    values: slideCats,
                                },
                                {
                                    type: 'listbox',
                                    name: 'effect',
                                    label: 'Effect',
                                    values: [
                                        {text:'Slide',value:'slide'},
                                        {text:'Fade',value:'fade'}
                                    ]
                                },
                                {
                                    type: 'combobox',
                                    name: 'width',
                                    label: 'Width (num)',
                                    values: [
                                        {text:'940px',value:'940'},
                                        {text:'1120px',value:'1120'},
                                        {text:'1180px',value:'1180'}
                                    ]
                                },
                                {
                                    type: 'combobox',
                                    name: 'height',
                                    label: 'Height (num)',
                                    values: [
                                        {text:'100px',value:'100'},
                                        {text:'200px',value:'200'},
                                        {text:'300px',value:'300'}
                                    ]
                                },
                                {
                                    type: 'combobox',
                                    name: 'autoplay',
                                    label: 'Autoplay',
                                    values: [
                                        {text:'Disabled',value:'false'},
                                        {text:'1 sec',value:'1000'},
                                        {text:'2 sec',value:'2000'},
                                        {text:'3 sec',value:'3000'},
                                        {text:'4 sec',value:'4000'},
                                        {text:'5 sec',value:'5000'},
                                    ]
                                },
                                {
                                    type: 'combobox',
                                    name: 'speed',
                                    label: 'Transition Speed',
                                    values: [
                                        {text:'1/2 sec',value:'500'},
                                        {text:'1/4 sec',value:'250'},
                                        {text:'1 sec',value:'1000'},
                                        {text:'2 sec',value:'2000'},
                                        {text:'3 sec',value:'3000'},
                                    ]
                                },
                                {
                                    type: 'checkbox',
                                    name: 'pagination',
                                    checked: true,
                                    label: 'Pagination'
                                },
                                {
                                    type: 'checkbox',
                                    name: 'prevnext',
                                    checked: true,
                                    label: 'Arrows'
                                }
                            ]
                        }
                    ],
                    onsubmit: function(e) {
                        // Insert content when the window form is submitted
                        editor.insertContent('[slideshow effect="'+ e.data.effect +'" category="'+ e.data.slideshow_id +'" width="'+ e.data.width +'" height="'+ e.data.height +'" autoplay="'+ e.data.autoplay +'" speed="'+ e.data.speed +'" pagination="'+ e.data.pagination +'" prevnext="'+ e.data.prevnext +'"]');
                    }
                });
            }
        });
    });
    // End Slideshow
})();