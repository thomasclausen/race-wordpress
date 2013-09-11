(function ($) {
	$(document).ready(function () {
		$('html').removeClass('no-js');

		var navigation = $('nav.mainmenu'),
			speed = 600,
			navigation_height = navigation.outerHeight(),
			navigation_items = $('a', navigation),
			scroll_items = navigation_items.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		$('a', navigation).on('click', function (e) {
			var section = $(e.target).attr('href');
			$('html, body').animate({
				scrollTop: $(section).offset().top - navigation_height
			}, speed);
			e.preventDefault();
		});
		$('.race_button a').on('click', function (e) {
			var section = $(e.target).attr('href');
			$('html, body').animate({
				scrollTop: $(section).offset().top - navigation_height
			}, speed);
			e.preventDefault();
		});

		$(window).scroll(function() {
			scroll_items.map(function(){
				if ($(this).offset().top < $(window).scrollTop() + (navigation_height + 1)) {
					navigation_items.filter('[href=#' + $(this).attr('id') + ']').parent().addClass('current-menu-item').siblings().removeClass('current-menu-item');
				}
			});
		});

		if (window.location.hash) {
			$('html, body').animate({
				scrollTop: $(window.location.hash).offset().top - navigation_height
			}, speed);
		}
	});
})(jQuery);