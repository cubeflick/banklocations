$('#branch_search').click(function(){  
	$('.search_bank1 select, .search_bank1 input').val('');
   
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');   
});

$('#bank_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
    
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});
$('#ifsc_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
   
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});
$('#micr_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
   
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});

$('#top_states_link').click(function(){  
	$('.links').removeClass('active');
	
    $(this).parent().addClass('active');
	$('#top_banks').hide();
	$('#top_states').show();
});
$('#top_banks_link').click(function(){  
	$('.links').removeClass('active');
	
    $(this).parent().addClass('active');
	$('#top_banks').show();
	$('#top_states').hide();
});


$(document).ready(function(){
	
  
});










