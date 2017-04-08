// =============================
// = General JS for every page =
// = 						   =
// =   Alexander Regier 2015   =
// =============================

$(document).ready(function() {
	$('#allcats').click(function() {
		if ($(this).is(':checked')) {
			$('input[type="checkbox"][name="cats[]"]').each(function() {
				if (!$(this).is('#allcats'))
					$(this).prop('checked', true).trigger('change');
			});
		};
	});
	
	
	$('input[type="checkbox"][name="cats[]"]').click(function() {
		if (!$(this).is('#allcats')) {
			if ($('#allcats').is(':checked')) {
				$('#allcats').attr('checked', false);
			}
		}
	});
	
});