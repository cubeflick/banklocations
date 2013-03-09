$('#branch_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
    $('.search_bank1').hide();
    $('#bankNameHolder').show();
    $('#stateNameHolder').show();
    $('#branchNameHolder').show();
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});
$('#bank_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
    $('.search_bank1').hide();
    $('#bankNameHolder').show();
    $('#stateNameHolder').show();
    $('#districtNameHolder').show();
    $('#cityNameHolder').show();
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});
$('#ifsc_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
    $('.search_bank1').hide();
    $('#ifscNameHolder').show();
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});
$('#micr_search').click(function(){    
    $('.search_bank1 select, .search_bank1 input').val('');
    $('.search_bank1').hide();
    $('#micrNameHolder').show();
    $('.menuItems').removeClass('active');
    $(this).parent().addClass('active');
    $('#bank_name').trigger('change');
});
$(document).ready(function(){
  
});
