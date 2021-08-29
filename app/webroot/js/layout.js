$(document).ready(function() {
					var doc_height = $(document).height();
					var left_bar_heigth = doc_height - 60;
					$('.left-bar').height(left_bar_heigth);

					// process datepicker
					$(".datepicker").datepicker({
						dateFormat : "yy-mm-dd"
					});
			

				});

// cms role management
function permission_select_deselect_child(selector) {

	if ($(selector).is(':checked') == false) {
		var check = false;
	} else {
		var check = true;
	}
	if ($(selector).parent().parent().hasClass('controller') == true) {
		var action_ul = $(selector).parent().next('ul');
		$.each(action_ul.children('li'), function(ind, val) {
			var cur_check_box = $(val).children('div').children('input');
			$(cur_check_box).prop('checked', check);
		});
	}
}


/*users*/
function processAvatarPreview(selector,preview_location){
	
	var file = selector.files[0];
	if(file){
		 var reader = new FileReader();
		 var file_data = reader.readAsDataURL(file);
		 reader.onload = function(evt){
			 $(preview_location).html('<img class="img-responsive" src="'+evt.target.result+'">');
		 };
	}
}
