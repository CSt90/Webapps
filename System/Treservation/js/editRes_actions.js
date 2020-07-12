drawCalendar();
//$('input[name=LastName]').prop('disabled', true);
if($('#drop').val()<0 && $('#datepicker').val()==''){
	$('input').not('input[name=ResDate]').prop('disabled', true);
	$('.langdrop').prop('disabled', true);
	$('#drop_office').prop('disabled', true);
}
else{
	checkAvailability();
}

$('#drop').on('change', function(){ //once an excursion is selected
	var days;
	fetchPrice();
	ptimeSet();
	checkAvailability();
	if($('#drop').val()<0){ //if instead of excursion, user selects the Excursion 'option'
		$('#datepicker').prop('disabled', true);  //calendar input remains disabled
		$('input').not('input[name=ResDate]').prop('disabled', true);
		$('#datepicker').val('');
	}
	else{ //if an excursion is selected
		$("#datepicker").val('');
		drawCalendar();
	}
	$("#datepicker").datepicker("refresh");
});

$('#datepicker').on('change', function(){
	if($('#datepicker').val()!=''){
		$('input').not('input[name=ResDate]').prop('disabled', false);
		$('.langdrop').prop('disabled', false);
		$('#drop_office').prop('disabled', false);
		checkAvailability();
	}
});

//$('#drop_office').on('change', function(){
//	if($('#drop_office').val()!=''){
//		$('input[name=SellerName]').val('');
//	}
//});

$( "input[name=PPoint]" ).autocomplete({
	source: 'ppoint_ac.php'
});

$( "input[name=Hotel]" ).autocomplete({
	source: 'hotel_ac.php'
});

/* $( "input[name=ReservationOfficeID]" ).autocomplete({
	source: 'reservationOfficeID_ac.php' 					//pending
}); */

//$( "input[name=SellerName]" ).autocomplete({
//	source: function(request, response) {
//        $.ajax({
//            url: "sellerID_ac.php",
//            dataType: "json",
//            data: {
//                term : request.term,
//                resofficeid : $("#drop_office").val()
//            },
//            success: function(data) {
//                response(data);
//            }
//        });
//	}
//});
//make function out of this
$('input[name=PPoint]').focusout(function(){
	ptimeSet();
});

function ptimeSet(){
	ppoint = $('input[name=PPoint]').val();
	exc_name = $('#drop option:selected').text();
	if ($.trim(ppoint)!=''){
		//$('input[name=PPlace]').css('background-color','rgba(248, 123, 162, 0.2)');
		$.ajax({ //send the pickup place to _getPTime.php_
			url: 'getPTime.php',
			type: 'POST',
			cache: false,
			data: {ppoint:ppoint, exc_name:exc_name},
			success: function(data){
				$('input[name=PTime]').val(data);
			}
		});
	}
}

$('input[name=Kids]').on('change', function(){
	if($('input[name=Kids]').val()>0 && $.isNumeric($('input[name=Kids]').val())){
		$('input[name=KidPrice]').prop('required', true);
//		if($('input[name=AdultPrice]').val()>0 && $.isNumeric($('input[name=AdultPrice]').val())){
//            $('input[name=KidPrice]').val($('input[name=AdultPrice]').val()/2);
//        }
//		else
//			$('input[name=KidPrice]').val('');
	}
	else{
		$('input[name=KidPrice]').prop('required', false);
		//$('input[name=KidPrice]').val('');
	}
});

//$('input[name=AdultPrice]').on('change', function(){
//	if($('input[name=Kids]').val()>0 && $.isNumeric($('input[name=Kids]').val()))
//		$('input[name=KidPrice]').val($('input[name=AdultPrice]').val()/2);
//	else
//		$('input[name=KidPrice]').val('');
//});

totalPriceCalc();
$('input[name=Adults], input[name=AdultPrice], input[name=Kids], input[name=KidPrice]').on('change', function(){
	totalPriceCalc();
	$('.total-price').text(totP+'  €');
});

function drawCalendar(){
	dropval = $('#drop').val(); //store the selected one
	$("#datepicker").datepicker("destroy");
	$.ajax({ //send the selected excursion to _getDays.php_
		url: 'getDays.php', //'displayList.php',
		type: 'POST',
		cache: false,
		data: {exc:dropval},
		success: function(data){
			console.log(data);
			days = data; //then store the string than got echo'd from the php file mentioned above which contains the days the excursion doesn't happen
		}
	});
	$('#datepicker').prop('disabled', false); //enable calendar input
	var changeYear = $( "#datepicker" ).datepicker( "option", "changeYear" );
	$("#datepicker").datepicker({dateFormat : 'dd-mm-yy', changeYear: true, beforeShowDay: function(date){ //attach calendar to input with given specs
		day = date.getDay();
		return [days.indexOf(day) == -1] //if day in the calendar is also in the returned string, disable it
		//return [(day != 1 && day != 2)]; // this disables monday and tuesday
	}});
}

function resetAll(){
	$('input').not('input[name=ResDate], input[name=Kids], input[name=Infants], input[name=POB_amt]').val('');
	$('input[name=Kids], input[name=Infants], input[name=POB_amt]').val(0);
	$('.txtcell').not('input[name=ResDate]').prop('disabled', true);
	$('.smalltxt').prop('disabled', true);
	$('.langdrop').prop('disabled', true);
	$('#drop_office').val(-1);
	$('#drop_office').prop('disabled', true);
	$('#voucher').prop('disabled', true);
	$("#datepicker").datepicker("destroy");
}

function checkAvailability(){
	var sdate = $('#datepicker').val();
	var exc = $('#drop').val();
	$.ajax({ 
		url: 'check_availability.php',
		type: 'POST',
		cache: false,
		data: {exc:exc, sdate:sdate},
		success: function(data){
			console.log(data);
			$('#max').val(data);
			$('#max').text(data);
			if($('#max').val()>=10)
				$('#max').css('color', '#18ab29');
			else
				$('#max').css('color', 'red');
		}
	});
}

function totalPriceCalc(){
	if($('input[name=Adults]').val()>0){
		adu = parseInt($('input[name=Adults]').val());
	}
	else
		adu = 0;
	if($('input[name=AdultPrice]').val()>0){
		aduP = parseFloat($('input[name=AdultPrice]').val());
		/* if($('input[name=Kids]').val()>0)
			$('input[name=KidPrice]').val(aduP/2);// */
	}
	else
		aduP = 0;
	if($('input[name=Kids]').val()>0){
		kid = parseInt($('input[name=Kids]').val());
	}
	else
		kid = 0;
	if($('input[name=KidPrice]').val()>0){
		kidP = parseFloat($('input[name=KidPrice]').val());
	}
	else
		kidP = 0;
	totP = adu*aduP+kid*kidP;
	$('.total-price').text(totP+'  €');
}