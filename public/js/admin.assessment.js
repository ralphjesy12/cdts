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
			if($('#formSaveQuestion').find('.form-choices').length<3){
				$('#formSaveQuestion').find('.form-choices .btn-choiceremove').addClass('disabled').prop('disabled',true);
			}else{
				$('#formSaveQuestion').find('.form-choices .btn-choiceremove').removeClass('disabled').prop('disabled',false);
			}
		}
	});
	$('#formSaveQuestion').delegate('.btn-choiceremove','click',function(event){
		event.preventDefault();
		var thisbtn = this;
		if ($(this).parent().siblings('input[type="text"]').val().trim().length>0){
			bootbox.confirm('Choice box not empty. Are you sure you want to delete?',function(result){
				if(result){
					$(thisbtn).parents('.form-choices').remove();
					if($('#formSaveQuestion').find('.form-choices').length<3){
						$('#formSaveQuestion').find('.form-choices .btn-choiceremove').addClass('disabled').prop('disabled',true);
					}else{
						$('#formSaveQuestion').find('.form-choices .btn-choiceremove').removeClass('disabled').prop('disabled',false);
					}
				}
			});
		} else {
			$(this).parents('.form-choices').remove();
		}
	});
	$('#makeQuestions').on('hidden.bs.modal',function(){
		$('#formSaveQuestion .form-choices:gt(1)').remove();
		$('#formSaveQuestion .form-control').val('');
		$('#formSaveQuestion [name="questionid"]').remove();
	});
	$('#makeQuestions').on('show.bs.modal',function(){
		if($('#formSaveQuestion').find('.form-choices').length<3){
			$('#formSaveQuestion').find('.form-choices .btn-choiceremove').addClass('disabled').prop('disabled',true);
		}else{
			$('#formSaveQuestion').find('.form-choices .btn-choiceremove').removeClass('disabled').prop('disabled',false);
		}
	});
	$('#questionsTable .btn-edit').click(function(){
		var data = $(this).data('info');
		$('#formSaveQuestion').append('<input type="hidden" name="questionid" value="' + data.id + '">');
		$('#formSaveQuestion [name="examtitle"]').val(data.body);
		var choices = $.parseJSON(data.choices);
		$.each(choices,function(i,v){
			var inputnow = $('#formSaveQuestion .form-choices').eq(i);
			if(inputnow.length>0)
				$(inputnow[0]).find('input[name="choices[]"]').val(v);
			else{
				var choicestring = '<div class="form-group form-choices"><label class="col-sm-2 control-label">Choice</label><div class="col-sm-10"><div class="input-group"><input type="text" class="form-control" name="choices[]" required value="'+v+'"><span class="input-group-btn"><button class="btn btn-danger btn-choiceremove"><i class="fa fa-trash"></i></button></span></div></div></div>';
				$("#formSaveQuestion").find('.form-choices').last().after(choicestring);
			};
		});

		$('#makeQuestions').modal('show');
	});
});