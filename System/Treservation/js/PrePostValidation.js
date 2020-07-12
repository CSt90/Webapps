$('#submit').attr('disabled', true);
$('#voucher').on('change', function(){
	if ($('#voucher').val()){
		voucher = $('#voucher').val();
		$.ajax({
			url: 'checkVoucherNo.php',
			type: 'POST',
			cache:false,
			data: {'voucher': voucher},
			success: function(data){
				if ($.isNumeric(data)){
					$('#voucher').css('background-color', 'pink');
					$('#submit').attr('disabled', true);
				}
				else{
					$('#voucher').css('background-color', 'white');
					$('#submit').attr('disabled', false);
				}
			}
		});        
	}
	else
		$('#voucher').css('background-color', 'white');
});
$('#submit').on('click', function(e){
	a=0; k=0;     
	if ($.isNumeric($('input[name=PPoint]').val())){
		e.preventDefault();
		$('input[name=PPoint]').css('background-color', 'yellow');
	}
	else
		$('input[name=PPoint]').css('background-color', 'white');
	rg=/(?:[0-5][0-9]):[0-5][0-9]$/; //time format regex hh:mm
	if ($.isNumeric($('input[name=PTime]').val()) || !rg.test($('input[name=PTime]').val())){ //second parameter checks if PTime is not of time format hh:mm
		e.preventDefault();
		$('input[name=PTime]').css('background-color', 'yellow');
	}
	else
		$('input[name=PTime]').css('background-color', 'white');
	if ($.isNumeric($('input[name=LastName]').val())){
		e.preventDefault();
		$('input[name=LastName]').css('background-color', 'yellow');
	}
	else
		$('input[name=LastName]').css('background-color', 'white');
   /*  if($('input[name=Phone]').val()!='' && !$.isNumeric($('input[name=Phone]').val())){
        e.preventDefault();
		$('input[name=Phone]').css('background-color', 'yellow');
    }
    else
        $('input[name=Phone]').css('background-color', 'white'); */
    if($('input[name=Email]').val()!='' && !isEmail($('input[name=Email]').val())){
        e.preventDefault();
		$('input[name=Email]').css('background-color', 'yellow');
    }
    else
        $('input[name=Email]').css('background-color', 'white');
	if ($.isNumeric($('input[name=Hotel]').val())){
		e.preventDefault();
		$('input[name=Hotel]').css('background-color', 'yellow');
	}
	else
		$('input[name=Hotel]').css('background-color', 'white');
	if($.isNumeric($('input[name=Nat]').val())){
		e.preventDefault();
		$('input[name=Nat]').css('background-color', 'yellow');
	}
	else
		$('input[name=Nat]').css('background-color', 'white');
	
	a = parseInt($('input[name=Adults]').val());
	k = parseInt($('input[name=Kids]').val());
	
	if (!$.isNumeric(a) || a<=0){
		e.preventDefault();
		$('input[name=Adults]').css('background-color', 'yellow');
	}
	else{
		if (a+k>$('#max').val())
			$('input[name=Adults]').css('background-color', 'rgba(240, 0, 12, 0.3)');
		else
			$('input[name=Adults]').css('background-color', 'white');		
	}
	if (!$.isNumeric($('input[name=AdultPrice]').val()) || $('input[name=AdultPrice]').val()<=0){
		e.preventDefault();
		$('input[name=AdultPrice]').css('background-color', 'yellow');
	}
	else
		$('input[name=AdultPrice]').css('background-color', 'white');
	if (!$.isNumeric(k) || k<0){
		e.preventDefault();
		$('input[name=Kids]').css('background-color', 'yellow');
	}
	else{
		if (a+k>$('#max').val())
			$('input[name=Kids]').css('background-color', 'rgba(240, 0, 12, 0.3)');
		else
			$('input[name=Kids]').css('background-color', 'white');
	}
	if ((!$.isNumeric($('input[name=KidPrice]').val()) || $('input[name=KidPrice]').val()<=0) && $('input[name=KidPrice]').prop('required') === true){
		e.preventDefault();
		$('input[name=KidPrice]').css('background-color', 'yellow');
	}
	else
		$('input[name=KidPrice]').css('background-color', 'white');
	if (!$.isNumeric($('input[name=Infants]').val()) || $('input[name=Infants]').val()<0){
		e.preventDefault();
		$('input[name=Infants]').css('background-color', 'yellow');
	}
	else
		$('input[name=Infants]').css('background-color', 'white');
	if (!$.isNumeric($('input[name=POB_amt]').val()) || $('input[name=POB_amt]').val()<0){
		e.preventDefault();
		$('input[name=POB_amt]').css('background-color', 'yellow');
	}
	else
		$('input[name=POB_amt]').css('background-color', 'white');
//	if ($.isNumeric($('input[name=SellerName]').val())){
//		e.preventDefault();
//		$('input[name=SellerName]').css('background-color', 'yellow');
//	}
//	else
//		$('input[name=SellerName]').css('background-color', 'white');
});

function isEmail(email) {
    regex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
//  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}