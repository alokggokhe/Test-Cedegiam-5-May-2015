$(document).ready(function(){

	$('.datetimepicker').datetimepicker();

	$('.delete_schedule').unbind().click(function() {
		var schedule_id = $('#entity_delete_id').val();    
		$.ajax({
			type:"POST",
			url: schedule_delete_url,
			data:{ 'schedule_id' : schedule_id },
			success:function (callback) {
				try {
					if (callback.s_status == 'success') {
						$('#popupCommonDelete').modal('hide');
						window.location.reload();
					}
				} catch (s_error) {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				}
			}
		});
		return false;
	});
});
function deleteSchedule(schduleid) {
	$('.delete-message').html("Are you sure, do you want to delete this session?");
	$('#popupCommonDelete').modal('show');
	$('#entity_delete_id').val(schduleid);
}