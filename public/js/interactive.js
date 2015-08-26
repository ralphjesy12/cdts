$(function() {
	$( "#ingredient-box" ).sortable({
		connectWith: ".interactiveLists",
		placeholder : "ui-state-highlight",
		cancel : ".ui-state-highlight",
		update: function(event , ui){
			$($( "#ingredient-box" ).find('li.ui-state-highlight')).insertAfter($( "#ingredient-box" ).find('li:not(.ui-state-highlight)').last());


		}
	}).disableSelection();
	$( "#recipe-box" ).sortable({
		connectWith: ".interactiveLists",
		placeholder : "ui-state-highlight",
		receive: function( event, ui ) {
			$(ui.item).insertBefore($( "#recipe-box" ).find('li.ui-state-highlight').first());
		},
		update: function(event , ui){
			$($( "#recipe-box" ).find('li.ui-state-highlight')).insertAfter($( "#recipe-box" ).find('li:not(.ui-state-highlight)').last());

			if($( "#ingredient-box" ).children('li:not(.ui-state-highlight)').length == 0 ){
				$( "#recipe-box" ).find('li.ui-state-highlight').hide();
				if($( "#ingredient-box" ).children().length<=1)
					$( "#ingredient-box" ).append('<li class="ui-state-highlight"></li>');
			}else{
				$( "#recipe-box" ).find('li.ui-state-highlight').show();
				$( "#ingredient-box .ui-state-highlight" ).remove();
			}
		},
		cancel : ".ui-state-highlight"
	}).disableSelection();
	$( "#ingredient-box > li .icon" ).on('click',function(event){
		if($( "#recipe-box" ).children().length == 1 ){
			$(this).parents('li').prependTo("#recipe-box");
		}else{
			$(this).parents('li').insertAfter($( "#recipe-box" ).find('li:not(.ui-state-highlight)').last());
		}
		if($( "#ingredient-box" ).children('li:not(.ui-state-highlight)').length == 0 ){
			$( "#recipe-box" ).find('li.ui-state-highlight').hide();
			if($( "#ingredient-box" ).children().length<=1)
				$( "#ingredient-box" ).append('<li class="ui-state-highlight"></li>');
		}else{
			$( "#recipe-box" ).find('li.ui-state-highlight').show();
			$( "#ingredient-box .ui-state-highlight" ).remove();
		}
	});
});