$(function(){
	$('#saveExam').click(function(){
		$('#formSaveExam').submit();
	});

	$('.btn-addmorechoices').click(function(event){
		event.preventDefault();
		if($("#formSaveQuestion").find('.form-choices').length>4){
			bootbox.alert('Maximum number of choices reached');
		}else{
			var choicestring = '<div class="form-group form-choices"><label class="col-sm-2 control-label">Choice</label><div class="col-sm-10"><div class="input-group"><input type="text" class="form-control" name="choices[]" required><span class="input-group-btn"><button class="btn btn-danger btn-choiceremove"><i class="fa fa-trash"></i></button></span></div></div></div>';
			$("#formSaveQuestion").find('.form-choices').last().after(choicestring);
		}
	});
	$('#formSaveQuestion').delegate('.btn-choiceremove','click',function(event){
		event.preventDefault();
		var thisbtn = this;
		if($(this).parent().siblings('input[type="text"]').val().trim().length>0){
			bootbox.confirm('Choice box not empty. Are you sure you want to delete?',function(result){
				if(result){
					$(thisbtn).parents('.form-choices').remove();
				}
			})
		}else{
			$(this).parents('.form-choices').remove();
		}
	});
	
	$('#questionsTable .btn-edit').click(function(){
		var data = $.parseJSON($(this).data('info'));
		console.log(data);
	});
});