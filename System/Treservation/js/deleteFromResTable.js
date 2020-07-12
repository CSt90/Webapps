var originalBgColor;

//this function changes the bg color of the selected row if the user hovers over '-'
function showDelRow(row){
	originalBgColor = row.style.backgroundColor;
	row.style.backgroundColor = 'rgba(240, 0, 12, 0.3)';
}

//this function reverts selected row back to its original bg color
function hideDelRow(row){
	row.style.backgroundColor = originalBgColor;	
}

function deleteRow(row){
	which = row.index();
    resid = row.find('td:first > p').text();
	ex = $('.c1').eq(which-1).text();
	date = $('.c2').eq(which-1).text();
	lname = $('.c5').eq(which-1).text(); //get all last names but store only the one for the corresponding row
	hotel = $('.c13').eq(which-1).text();
	room = $('.c14').eq(which-1).text();
	$('#prompt-q').text('Are you sure you want to delete reservation with the following data:\n\n - Excursion: '+ex+'\n - Date: '+date+'\n - Last Name: '+lname+'\n - Hotel: '+hotel+'\n - Room Number: '+room);
	$('#confirm-prompt').css('visibility', 'visible');
	tabs=0;
	if ($('#confirm-prompt').css('visibility') == 'visible'){
		$('#confirm').focus();
		$(document).keyup(function(e){
			if (e.which == 13){
				$('#confirm').click();
				console.log('enter');
			}
			else if (e.which == 27){
				$('#cancel').click();
				console.log('esc');
			}
			else if (e.which == 9){
				e.preventDefault();
				$('#confirm').focus();
			}
		});
	}
	$('#cancel').on('click', function(){
		$('#confirm-prompt').css('visibility', 'hidden');
		tabs=0;
	});
	$('#confirm').on('click', function(){
		$.ajax({
			url: 'delReservationFromTable.php',
			type: 'POST',
			cache: false,
			data: {resid:resid}, //, lname: lname, hotel: hotel, room: room
			success: function(data){
				if ($.isNumeric(data)){
					row.find('*:not(div)').css('color', 'rgba(0, 0, 0, 0.4)');
					//$('.edits').eq(which-1).hide();
					$('.c14').eq(which-1).children('div').hide();
					//$('.show').eq(which-1).hide();
					$('#confirm-prompt').css('visibility', 'hidden');
				}
				else{
					alert(data);
				}
			}
		});
	});
}