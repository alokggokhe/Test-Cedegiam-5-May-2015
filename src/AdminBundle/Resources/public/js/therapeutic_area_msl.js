$(document).ready(function(){
	
	getTherapeuticAreaList();

	getMslList();

	$('#therapeutic_area_add').click(function() {
		var s_therapeutic_area_name = $('#txt_therapeutic_area').val();
		
		var frm_serialize_data = $( "#frm_therapeutic_area" ).serialize();
		
		$.ajax({
			type:"POST",
			url: therapeutic_area_add_url,
			data:frm_serialize_data,
			success:function (callback) {
				try {
					if (callback.s_status != 'success') {
						$('.alert-message').html(callback.data);
						$('#popupCommonAlert').modal('show');
					} else {
						$('#frm_therapeutic_area').trigger("reset");
						getTherapeuticAreaList();
					}

				} catch (s_error) {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				}
			}
		});
		
		return false;
	});

	$(document).on('click','.therapeutic_area_edit',function(e){
		$('#hid_therapeutic_area_id').val($(this).attr('therapeutic_area_id'));
		$('#txt_edit_therapeutic_area').val($(this).attr('therapeutic_area_name'));
		$('.edit-therapeutic-area-alert-msg').addClass('hide');
		$('.edit-therapeutic-area-response-msg').html('');
		$('#popupEditTherapeuticArea').modal('show');
		return false;
	});

	$('.btn_edit_therapeutic_area').click(function() {
		var frm_serialize_data = $( "#frm_edit_therapeutic_area" ).serialize();
		
		$.ajax({
			type:"POST",
			url: therapeutic_area_edit_url,
			data:frm_serialize_data,
			success:function (callback) {
				try {
					if (callback.s_status != 'success') {
						$('.edit-therapeutic-area-response-msg').html(callback.data);
						$('.edit-therapeutic-area-alert-msg').removeClass('hide');
					} else {
						$('#popupEditTherapeuticArea').modal('hide');	
						getTherapeuticAreaList();
					}

				} catch (s_error) {
					$('.edit-therapeutic-area-response-msg').html(callback.data);
					$('.edit-therapeutic-area-alert-msg').removeClass('hide');
				}
			}
		});
		return false;
	});

	
	$('#msl_add').click(function() {

		$('#hid_msl_id').val(0);

		var s_msl_first_name 	= $.trim($('#txt_first_name').val());
		var s_msl_last_name 	= $.trim($('#txt_last_name').val());
		var s_msl_email 		= $.trim($('#txt_email').val());
		
		var frm_serialize_data = $( "#frm_msl" ).serialize();
		
		$.ajax({
			type:"POST",
			url: msl_add_url,
			data:frm_serialize_data,
			success:function (callback) {
				try {
					if (callback.s_status != 'success') {
						$('.alert-message').html(callback.data);
						$('#popupCommonAlert').modal('show');
					} else {
						$('#frm_msl').trigger("reset");
						getMslList();
					}

				} catch (s_error) {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				}
			}
		});
		
		return false;
	});

	$(document).on('click','.msl_edit',function(e){

		$('.edit-msl-alert-msg').addClass('hide');
		$('.edit-msl-response-msg').html('');

		var form_data 	= new Object;
		form_data.msl_id = $(this).attr('msl_id');

		$.ajax({
			type:"POST",
			url: msl_get_url,
			data:form_data,
			success:function (callback) {
				try {
					if (callback.s_status != 'success') {
						$('.alert-message').html(callback.data);
						$('#popupCommonAlert').modal('show');
					} else {
						$('#msl_form_edit_div').html(callback.data);
						$('#popupEditMsl').modal('show');
					}

				} catch (s_error) {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				}
			}
		});
		return false;
	});

	$('.btn_delete_msl').click(function() {
		$('.delete-message').html("Are you sure, do you want to delete this user?");
		$('#popupCommonDelete').modal('show');
	});

	$('.delete_entity').click(function() {

		var form_data 	= new Object;
		form_data.msl_id = $('#hid_msl_id').val();

		$.ajax({
			type:"POST",
			url: msl_delete_get_url,
			data:form_data,
			success:function (callback) {
				try {
					if (callback.s_status != 'success') {
						$('.alert-message').html(callback.data);
						$('#popupCommonAlert').modal('show');
					} else {
						$('#popupCommonDelete').modal('hide');
						$('#popupEditMsl').modal('hide');
						getMslList();
					}

				} catch (s_error) {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				}
			}
		});
	});

	$('.btn_save_msl').click(function() {
		$('.edit-msl-alert-msg').addClass('hide');
		$('.edit-msl-response-msg').html('');
		
		var frm_serialize_data = $( "form[name=edit_msl]" ).serialize();
		$.ajax({
			type:"POST",
			url: msl_edit_url,
			data:frm_serialize_data,
			success:function (callback) {
				try {
					if (callback.s_status != 'success') {
						$('.edit-msl-alert-msg').removeClass('hide');
						$('.edit-msl-response-msg').html(callback.data);
					} else {
						$('#msl_form_edit_div').html('');
						$('#popupEditMsl').modal('hide');
						getMslList();
					}

				} catch (s_error) {
					$('.edit-msl-alert-msg').removeClass('hide');
					$('.edit-msl-response-msg').html(callback.data);
				}
			}
		});
		
		return false;
	});	
});

function getTherapeuticAreaList() {
	$.ajax({
		type:"POST",
		url: therapeutic_area_list_url,
		data:'',
		success:function (callback) {
			try {
				
				if (callback.s_status != 'success') {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				} else {
					if(callback.i_record >= 8) {
						$('#therapeutic_area_list_div').addClass('scroll-table');
					} else {
						$('#therapeutic_area_list_div').addClass('no-scroll-table');
					}
					$('#table_therapeutic_area_list').html(callback.data);
				}

			} catch (s_error) {
				$('.alert-message').html(callback.data);
				$('#popupCommonAlert').modal('show');
			}
		}
	});
	return false;
}

function getMslList() {
	$.ajax({
		type:"POST",
		url: msl_list_url,
		data:'',
		success:function (callback) {
			try {
				
				if (callback.s_status != 'success') {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				} else {
					if(callback.i_record >= 8) {
						$('#msl_list_div').addClass('scroll-table');
					} else {
						$('#msl_list_div').addClass('no-scroll-table');
					}
					$('#table_msl_list').html(callback.data);
				}

			} catch (s_error) {
				$('.alert-message').html(callback.data);
				$('#popupCommonAlert').modal('show');
			}
		}
	});
	return false;
}