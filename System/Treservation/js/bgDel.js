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
	ex = $('#drop option:selected').val();
	date = $('#datepicker').val();
	lname = $('.c2').eq(which-1).text(); //get all last names but store only the one for the corresponding row
	hotel = $('.c10').eq(which-1).text();
	room = $('.c11').eq(which-1).text();
	$('#prompt-q').text('Are you sure you want to delete reservation with the following data:\n\n - Excursion: '+$('#drop option:selected').text()+'\n - Date: '+date+'\n - Last Name: '+lname+'\n - Hotel: '+hotel+'\n - Room Number: '+room);
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
			url: 'delReservationFromExcursion.php',
			type: 'POST',
			cache: false,
			data: {ex: ex, date:date, lname: lname, hotel: hotel, room: room}, //, lname: lname, hotel: hotel, room: room
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

function changeNoshow(currBtn){
	whichBtn = currBtn.parent().parent().parent().index();
    console.log(whichBtn);
	ex = $('#drop option:selected').val();
	date = $('#datepicker').val();
	lname = $('.c2').eq(whichBtn-1).text(); //get all last names but store only the one for the corresponding row
	hotel = $('.c10').eq(whichBtn-1).text();
	room = $('.c11').eq(whichBtn-1).text();
	if ($.trim(currBtn.text()) == 'Noshow'){
		$.ajax({
			url: 'updateShowNoResid.php',
			type: 'POST',
			cache: false,
			data: {ex: ex, date:date, lname: lname, hotel: hotel, room: room, noshow:0},
			success: function(data){
				if ($.isNumeric(data)){
					currBtn.removeAttr('class', 'noshow');
					currBtn.attr('class', 'show');
					currBtn.prop('title', 'Remove noshow');
					currBtn.text('Show');
                    $('.c17').eq(whichBtn-1).find('p').html("&#x2718");
				}
				else
					alert(data);				
			}
		});
	}
	else{		
		$.ajax({
			url: 'updateShowNoResid.php',
			type: 'POST',
			cache: false,
			data: {ex: ex, date:date, lname: lname, hotel: hotel, room: room, noshow:1},
			success: function(data){
				if ($.isNumeric(data)){
					currBtn.removeAttr('class', 'show');
					currBtn.attr('class', 'noshow');
					currBtn.prop('title', 'Set as noshow');
					currBtn.text('Noshow');
                    $('.c17').eq(whichBtn-1).find('p').text("");
				}
				else
					alert(data);				
			}
		});		
	}	
}