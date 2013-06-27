(function ($) {
	$(document).ready(function () {
		$('html').removeClass('no-js');

		var navigation = $('nav.mainmenu'),
			speed = 600;

		$('a', navigation).on('click', function (e) {
			$(this).parent().addClass('current-menu-item').siblings().removeClass('current-menu-item');
			var section = $(e.target).attr('href');
			$('html, body').animate({
				scrollTop: $(section).offset().top - 70
			}, speed);
			e.preventDefault();
		});
		$('.race_button a').on('click', function (e) {
			var section = $(e.target).attr('href');
			$('html, body').animate({
				scrollTop: $(section).offset().top - 70
			}, speed);
			e.preventDefault();
		});

		if (window.location.hash) {
			$('html, body').animate({
				scrollTop: $(window.location.hash).offset().top - 70
			}, speed);
		}
	});
})(jQuery);