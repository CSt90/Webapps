/* $('#drop_office').on('change', function(){
	office = $('#drop_office').val();
});

$('#fromDate').on('change', function(){
	office = $('#drop_office').val();
});

$('#drop_office').on('change', function(){
	office = $('#drop_office').val();
}); */

$('#cleanup').on('click', function(){
	if (($('#drop_office').val() != '') && $('#fromDate').val() !=''){
		$('#drop_office').css('backgroundColor', 'white');
		$('#fromDate').css('backgroundColor', 'white');
		office = '<strong>' + $('#drop_office option:selected').text() + '</strong>';
		fDate = $('#fromDate').val();
		tDate = $('#toDate').val();
		if (tDate == ''){
			fDate = ' since <strong>'+fDate+'</strong>';
		}
		else{
			fDate = ' from <strong>'+fDate+'</strong> until <strong>'+tDate+'</strong>';
		}
		displayText = 'Reservations made by '+office + fDate +' will be deleted permanently from the database.</p><p>Are you sure you want to continue?';
		$('#prompt-q').html(displayText);
		$('#confirm-prompt').css('visibility', 'visible');
	}
	else if($('#drop_office').val() == '' && $('#fromDate').val() == ''){
		$('#drop_office').css('backgroundColor', 'rgba(248, 123, 162, 0.2)');
		$('#fromDate').css('backgroundColor', 'rgba(248, 123, 162, 0.2)');
	}
	else if($('#drop_office').val() != '' && $('#fromDate').val() == ''){
		$('#drop_office').css('backgroundColor', 'white');
		$('#fromDate').css('backgroundColor', 'rgba(248, 123, 162, 0.2)');
	}
	else if($('#drop_office').val() == '' && $('#fromDate').val() != ''){
		$('#drop_office').css('backgroundColor', 'rgba(248, 123, 162, 0.2)');
		$('#fromDate').css('backgroundColor', 'white');
	}
});

$('#submit-label').on('click', function(){
	$('#confirm-prompt').css('visibility', 'hidden');
});

$('#backup').on('click', function(){
	window.location.href = '../dbmanagement/backup.php';
});

$('#cancel').on('click', function(){
	$('#confirm-prompt').css('visibility', 'hidden');
});