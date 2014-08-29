$(function() {
	$('.bilgilerim .tabs a').on('click', function() {
		var elClass = $(this).attr('href'),
			elClass = elClass ? elClass.replace('#', '') : undefined,
			$tabsWrapper = $('.bilgilerim .tab-content'),
			$tab = $('.' + elClass, $tabsWrapper);


		if ( $tab.length > 0 ) {
			$('>', $tabsWrapper).hide();
			$tab.show();
			$(this).parent().find('a').removeClass('active');
			$(this).addClass('active');
		}
		return false;
	})
})