$(document).ready(function(){
	$('#delRow').on('click', function(){
		ex = $('#drop option:selected').val();
		console.log(ex);
	});
});