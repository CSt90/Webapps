function editRes(row){
	which = row.index();
	ex = $('#drop option:selected').val();
	date = $('#datepicker').val();
	lname = $('.c2').eq(which-1).text(); //get all last names but store only the one for the corresponding row
	voucher = $('.c8').eq(which-1).text(); 
	hotel = $('.c10').eq(which-1).text();
	room = $('.c11').eq(which-1).text();
	
	//send all the above via ajax to a php file that will retrieve the reservation from the db, then send it via get to the editReservation page
	// if sending from php to php via get not possible, return reservation info to this file, then using another ajax get, send to editReservation
	
	$.ajax({
		url: 'fetchReservation.php',
		type: 'POST',
		cache: false,
		data: {ex: ex, date: date, lname: lname, voucher: voucher, hotel: hotel, room: room},
		success: function(data){
			console.log('url: '+data);
			window.location = data;
		}
	});
}