(function($) {
	'use strict';

	if ($(".js-example-basic-single").length) {
		$(".js-example-basic-single").select2();
	}
	if ($(".js-example-basic-multiple").length) {
		$(".js-example-basic-multiple").select2({
			placeholder: "Select",
			allowClear: true
		});
	}
	if ($(".select2-chrom").length) {
		$(".select2-chrom").select2({
			placeholder: "Select",
			allowClear: true
		});
	}
})(jQuery);