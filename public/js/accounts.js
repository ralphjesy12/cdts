$(function(){
	$('a[data-toggle="tab"][href="#tab_mu"]').on('shown.bs.tab', function (e) {

	});
	$('[data-toggle="tooltip"]').tooltip();

	$('#tab_mu .btn-delete').click(function(event){
		var thisevent = event;
		var _this = this;
		bootbox.confirm("Are you sure you want to delete this user",function(result){
			if(result){
				thisevent.preventDefault();
				var id = $(_this).parents('tr').data('id');
				$.post("/form/removeuser",{ id , id } ,function(){
					window.location.reload();
				});
			}
		});
	});
	$('#modal-add-user').on('hide.bs.modal',function(){
		$('#modal-add-edit input,select').val("");
	});

	$('#tab_mu .btn-edit').click(function(event){
		var thisevent = event;
		var _this = this;
		var id = $(_this).parents('tr').data('id');
		$(this).html('<i class="fa fa-fw fa-gear fa-spin"></i>');
		$.post("/form/getuserdata",{ id , id } ,function(response){
			$('#modal-add-edit [name="id"]').val(response.id);
			$('#modal-add-edit [name="username"]').val(response.username);
			$('#modal-add-edit [name="email"]').val(response.email);
			$('#modal-add-edit [name="fullname"]').val(response.fullname);
			$('#modal-add-edit [name="position"] option:contains("'+response.position+'")').prop('selected',true);
			$('#modal-add-edit [name="gender"][value="' + response.gender + '"]').prop('checked',true);
			$('#modal-add-edit').modal('show');
			$(_this).html('<i class="fa fa-fw fa-edit"></i>');
		});
	});
});