jQuery(document).ready(function($) {

	/* Superfish
	================================================== */
	$(function(){ // run after page loads
		$('#menu ul.menu')
		.find('li.current_page_item,li.current_page_parent,li.current_page_ancestor,li.current-cat,li.current-cat-parent,li.current-menu-item')
			.addClass('active')
			.end()
			.superfish({
				    delay:       350,
				    animation:   {opacity:'show'},
				    speed:       350,
				    autoArrows:  true
				    });
	});
	$('#menu ul ul').prepend('<span class="sub-indicator">&nbsp;</span>');
	$('body.page-template-backstretch-page-php #content').addClass('animated fadeIn');


	// Add .last class to last menu items in main nav

	$(function(){ // run after page loads
    	$("ul#nav li:last-child").addClass("last");
	});

    /* prepend menu icon */
    $('#header').prepend('<a href="#" id="shownav" class="animated fadeIn"><span></span><span></span><span></span></a>');

    /* toggle nav */
    $("#shownav").on("click", function(e){
        $("#menu").slideToggle('fast', function() {
        if ($(this).is(":visible")) {
        	$('#shownav').addClass("active");
        } else {
        	$('#shownav').removeClass("active");
        }
        });
        e.preventDefault();
    });

	$(function(){ // run after page loads
    	var addtomainmenu = $("#st_topbar ul.menu li.append");
    	var mainmenu = $("#header ul.menu");
    	$(mainmenu).append(addtomainmenu.clone().addClass('appended'));
	});


	// Style Tags

	$(function(){ // run after page loads
		$('p.tags a').wrap('<span class="st_tag" />');
	});


	// valid XHTML method of target_blank
	$(function(){ // run after page loads
		$('a[rel*=external],a.external,li.external a').click( function() {
			window.open(this.href);
			return false;
		});
	});


	$(function(){ // run after page loads
		$('.testimonials').cycle({
			timeout: 	1000,
			fx: 		'scrollUp',
			after: 		onAfter,
			height: 	'auto',
			pause: 		true,
			containerResize: false,
			width: '100%',
			fit: 1
			}
		);
	});
	function onAfter(curr, next, opts, fwd) {
	 var $ht = $(this).height();
	 //set the container's height to that of the current slide
	 $(this).parent().css({height: $ht});
	}

	// jquery sticky footer

	$(function(){ // run after page loads
		positionFooter();

	  $(window)
	    .scroll(positionFooter)
	    .resize(positionFooter);

	  function positionFooter() {
	    var docHeight = $(document.body).height() - $("#sticky-footer-push").height();
	    if(docHeight < $(window).height()){
	      var diff = $(window).height() - docHeight;
	      if (!$("#sticky-footer-push").length > 0) {
	        $("#footer-wrap").before('<div id="sticky-footer-push"></div>');
	      }
	      $("#sticky-footer-push").height(diff);
	    }
	  }
	});
});