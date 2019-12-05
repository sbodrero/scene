jQuery( document ).ready(function($) {

	var btn_toggle = $('a.form-search-toggle');

	if (btn_toggle.length > 0) {

		$('.em-search-wrapper').hide(); // Cacher le form seulement si interrupteur présent

		btn_toggle.live('click', function(e) {
			$('.em-search-wrapper').slideToggle('slow');
		});
	}

});