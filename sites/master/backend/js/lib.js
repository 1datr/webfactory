function init_drop_hndlrs()
{
	$('.arraybox .btn-drop').click(function () {

		 $(this).parent().parent('div.array_item').remove();

		  return false;
		});	
}

$(document).ready(function() {
		  // Handler for .ready() called.		
		/*$('.htabs').tabs();
		$('.vtabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');*/
		
		init_drop_hndlrs();

		$('.btn_add').click(function() {
			
				var newelem =  $(this).parent().children('div').children('.adding_block').html();
				//alert($(this).parent().children('div').children('.adding_block').html());
				$(this).parent().children('div').append($(newelem));
				
				init_drop_hndlrs();
				return false;
			});
	});

function init_arraybox()
{

}

function add_array_item(elem)
{
	var newitem = $('div#array_box_'+elem+' .adding_block').html();
	
	//alert(newitem);
	//var newitem = $('div#array_box_'+elem+' .adding_block').html();
	$('div#array_box_'+elem).html($('div#array_box_'+elem).html() + newitem);
	
	init_arraybox();
}


function dropitem()
{
	alert($(this).html());
	
}

//init_arraybox();