$('#datepicker').prop('disabled', true); //on pageload, calendar input is disabled, since no excursion is selected yet
//var dyncon = $('#dynamic-content').html();
$('#drop').on('change', function(){ //once an excursion is selected
	var days;
	resetAll();
	if($('#drop').val()<0){ //if instead of excursion, user selects the select.. 'option'
		$('#datepicker').prop('disabled', true);  //calendar input remains disabled
		$('#datepicker').val('');
		//$('#prompt-text').text('Select excursion first'); //and user is prompted to select an excursion before a date
	}
	else{ //if an excursion is selected
		dropval = $('#drop').val(); //store the selected one
		$.ajax({ //send the selected excursion to _getDays.php_
			url: 'Treservation/getDays.php', //'displayList.php',
			type: 'POST',
			cache: false,
			data: {exc:dropval},
			success: function(data){
				//console.log(data);
				//$('#dynamic-content').html(data);
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
	$("#datepicker").datepicker("refresh");
});

$('#gobtn').on('click', function(){
	date = $('#datepicker').val();
	$(this).attr('href', 'Treservation/viewResList.php?ex='+dropval+'&date='+date);
	$(this).attr('target', '_blank');
});

$('#newResBtn').on('click', function(){
	window.open('Treservation/addReservation.php', '_blank');
});

$('#invoicesBtn').on('click', function(){
	//window.open('Invoices/selectInvoices.php', '_blank');
});

$('#today-btn').on('click', function(){
	today_date = $('#today-date').text();
	$.ajax({
		url: 'getTodaysExcs.php',
		type: 'POST',
		cache: false,
		data: {exdate:today_date},
		success: function(data){
			console.log(today_date);
			console.log(data);
			d = jQuery.parseJSON(data);
			console.log(d.length);
			if(!$.isNumeric(d[0])){
				alert('Could not fetch today\'s excursions. Refresh and try again');
			}
			else{
				for (i=0;i<d.length;i++){
					window.open('Treservation/viewResList.php?ex='+d[i]+'&date='+today_date, '_blank');
				}
			}
		}
	});
});

$('#tomorrow-btn').on('click', function(){
	tomorrow_date = $('#tomorrow-date').text();
	$.ajax({
		url: 'getTodaysExcs.php',
		type: 'POST',
		cache: false,
		data: {exdate:tomorrow_date},
		success: function(data){
			console.log(tomorrow_date);
			console.log(data);
			d = jQuery.parseJSON(data);
			console.log(d.length);
			if(!$.isNumeric(d[0])){
				alert('Could not fetch today\'s excursions. Refresh and try again');
			}
			else{
				for (i=0;i<d.length;i++){
					window.open('Treservation/viewResList.php?ex='+d[i]+'&date='+tomorrow_date, '_blank');
				}
			}
		}
	});
});

	
function resetAll(){
	$("#datepicker").datepicker("destroy");
	//$('#dynamic-content').html(dyncon);
	//$('#seats').text('- / -');
	//$('#buses').text(' ');
}