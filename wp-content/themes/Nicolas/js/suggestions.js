(function($) {
    "use strict";
	jQuery(document).ready(function($) {
		$('#nom_producteur').typeahead({
			ajax: {
					url: ajaxurl + '?action=get_listing_posts',
					triggerLength: 1
				  }
		});
		$('#disciplinediv #discipline-add-submit').val('Valider');
		$('#publish, #save-post').bind('click',function(){
			value = $('#nom_producteur').val();
			if(value == "") {
				alert("Veuillez renseigner le champs Nom producteur s'il vous plaît.");
				$('#nom_producteur').focus();
			}
		})
	});
})(jQuery);





