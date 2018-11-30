jQuery(window).ready(function($) {

	// SVG to PNG for IE8 and below
/*	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if(msie > 0) {
		$('img[src*="svg"]').attr('src', function() {
			return $(this).attr('src').replace('.svg', '.png');
		});
	}*/

	// Nav menu
	$('.nav-toggle').on('click', function(e) {
		e.preventDefault();
		$('.page-header').toggleClass('menu-visible');
	});

	$('.menu-item.menu-item-has-children a').on('touchstart', function(e) {
		var navitem = $(this);

		// Check if item has a sub menu but isn't selected don't do anything but open the menu
		if (!navitem.hasClass('selected') && navitem.next().length) {
			// Don't navigate
			e.preventDefault();

			// Close other menus
			$('.menu-item.menu-item-has-children a.selected').removeClass('selected').next().slideUp();

			// open submenu
			navitem.addClass('selected').next().slideDown();
		}
	});

	// Smooth scrolling.
	var scrollingoffset = 200;
	if (window.location.hash.length) {
		var target = $(window.location.hash);

		if (target.length) {
			$("html, body").animate({scrollTop: target.offset().top - scrollingoffset}, 1000);
		}
	}
	$('a[href^="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - scrollingoffset
				}, 1000);
				return false;
			}
		}
	});

});
