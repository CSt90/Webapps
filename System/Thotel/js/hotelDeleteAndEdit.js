//this function deletes row if the user clicks '-'
function deleteRow(row){
	which = row.index();
    idHotel = row.find('p').eq(0).text();
	hname = $('.c2').eq(which-1).text(); //get all last names but store only the one for the corresponding row
	harea = $('.c1').eq(which-1).text();
	ppwest = $('.c6').eq(which-1).text();
    ppeast = $('.c7').eq(which-1).text();
	$('#prompt-q').text('Are you sure you want to delete the Hotel with the following data:\n\n - Hotel Name: '+hname+'\n - Area: '+harea+'\n - Pickup West: '+ppwest+'\n - Pickup East: '+ppeast);
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
			url: 'delFromHotelTable.php',
			type: 'POST',
			cache: false,
			data: {idHotel:idHotel},
			success: function(data){
				if ($.isNumeric(data)){
					$('#confirm-prompt').css('visibility', 'hidden');
                    location.replace('viewHotelTable.php');
				}
				else{
                    alert(data);
				}
			}
		});
	});
    return false;
	location.href = 'viewHotelTable.php'; //this passes the variable id (of the row) to the other php page
}

//this function allows the user to edit cell data on double click
$(document).ready(function(){
    thistd = '';
	$('td').dblclick(function(){
		cellClass = $(this).attr('class');//get the class of the td
        prevtd = thistd;
        if (prevtd != '' && (prevtd.attr('class') == 'c5' || prevtd.attr('class') == 'c6' || prevtd.attr('class') == 'c7'))
                restoreTdP(prevtd, prev);
        thistd = $(this);
		if(cellClass == 'c1' || cellClass == 'c2' || cellClass == 'c3' || cellClass == 'c4' || cellClass == 'c8'){
			p = $(this).find('p');
            prev = p.text();
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
			$(this).keypress(function(e){
				newVal = p.text();
                time_regex = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/;
				if (e.which == 13){
                    if (cellClass == 'c4' && !time_regex.test(newVal)){
                        newVal = null;
                    }
					p.attr('contentEditable', false); //finished editing
					if (newVal != currval && newVal != ''){
						$.ajax({
							url: 'editHotelTable.php',
							type: 'POST',
							cache:false,
							data: {'pk': pk, 'cellClass': cellClass, 'newVal': newVal},
							success: function(data){
								d = jQuery.parseJSON(data);	//needed in order to be able to read returned values from edit page
								console.log(data);
								if (d.er == 'error'){ // if edit page returns error
									$('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
									p.text(currval); // just put the previous value back
									$("#errormsg").text(d.msg); //display the error message originating from the edit page
									$("#errorbox").fadeIn(300);
									setTimeout(function() {
									  $("#errorbox").fadeOut(300);
									}, 4000);
								}
								else if (d.er == 'success'){ //if edit was successful
									$('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
									$("#editsuccessbox").fadeIn(300);
									setTimeout(function() {
									  $("#editsuccessbox").fadeOut(300);
									}, 4000);
                                    if (cellClass =='c4')
                                        location.reload();
								}
							}
						});
						return e.which != 13; //prevents new line when pressing enter
					}
					else if (newVal == '' || newVal == null) //if cell is empty, no change
						p.text(currval);
				}
			});
		}
        else if (cellClass == 'c5'){
            p = $(this).find('p');
            prev = p.text();
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
			pk = td1.text();
            $.ajax({
                url: 'htqueueDropdown.php',
                type: 'POST',
                cache: false,
                data: {'queue':currval},
                success: function(data){
                    thistd.empty();
                    thistd.append(data);
                    thistd.children().keypress(function(e){
                        console.log( thistd.children());
                        if(e.which == 13){
                            e.preventDefault();
                            qsel = $('#drop_htqueue :selected').text();
                            $.ajax({
                                url: 'editHotelTable.php',
                                type: 'POST',
                                cache: false,
                                data: {'pk':pk, 'cellClass': cellClass, 'newVal': qsel},
                                success: function(data){
                                    d = jQuery.parseJSON(data);	//needed in order to be able to read returned values from edit page
                                    console.log(data);
                                    if (d.er == 'error'){ // if edit page returns error
                                        $('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
                                        p.text(currval); // just put the previous value back
                                        $("#errormsg").text(d.msg); //display the error message originating from the edit page
                                        $("#errorbox").fadeIn(300);
                                        setTimeout(function() {
                                          $("#errorbox").fadeOut(300);
                                        }, 4000);
                                    }
                                    else if (d.er == 'success'){ //if edit was successful
                                        $('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
                                        thistd.empty();
                                        thistd.html('<p>'+qsel+'</p>');
                                        prev = qsel;
                                        $("#editsuccessbox").fadeIn(300);
                                        setTimeout(function() {
                                          $("#editsuccessbox").fadeOut(300);
                                        }, 4000);
                                    }
							     }
                            }); 
                        }
                    });
                }
            });
        }
        else if(cellClass == 'c6' || cellClass == 'c7'){
            p = $(this).find('p');
            prev = p.text();
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			//p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and 
            $.ajax({
                url: 'getAllPickups.php',
                type: 'POST',
                cache: false,
                data: {'pp':currval},
                success: function(data){
                    thistd.empty();
                    thistd.append(data);
                    thistd.children().keypress(function(e){
                        console.log( thistd.children());
                        if(e.which == 13){
                            e.preventDefault();
                            ppselid = $('#drop_pickup :selected').val();
                            ppseltext = $('#drop_pickup :selected').text();
                            $.ajax({
                                url: 'editHotelTable.php',
                                type: 'POST',
                                cache: false,
                                data: {'pk':pk, 'cellClass': cellClass, 'newVal': ppselid},
                                success: function(data){
                                    d = jQuery.parseJSON(data);	//needed in order to be able to read returned values from edit page
                                    console.log(data);
                                    if (d.er == 'error'){ // if edit page returns error
                                        $('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
                                        p.text(currval); // just put the previous value back
                                        $("#errormsg").text(d.msg); //display the error message originating from the edit page
                                        $("#errorbox").fadeIn(300);
                                        setTimeout(function() {
                                          $("#errorbox").fadeOut(300);
                                        }, 4000);
                                    }
                                    else if (d.er == 'success'){ //if edit was successful
                                        $('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
                                        thistd.empty();
                                        thistd.html('<p>'+ppseltext+'</p>');
                                        prev = ppseltext;
                                        $("#editsuccessbox").fadeIn(300);
                                        setTimeout(function() {
                                          $("#editsuccessbox").fadeOut(300);
                                        }, 4000);
                                    }
							     }
                            }); 
                        }
                    });
                }
            });
        }
	});	
});

function restoreTdP(td, prev){    
    td.empty();
    td.html('<p>'+prev+'</p>');
}