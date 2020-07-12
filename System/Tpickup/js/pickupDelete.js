//this function deletes row if the user clicks '-'
function deleteRow(row){
	// code below retrieves value from 1st cell in the row, which is located between p tags
	data = row.querySelectorAll("p");//this function gets all p elements in the row
	//getElementsByTagName("td").item(0).textContent;
	id = data[0].textContent; //now get the content inside 1st p element
	top.location.href = 'delFromPickupTable.php?cell='+id; //this passes the variable id (of the row) to the other php page
}

$(document).ready(function(){
    thistd = '';
	$('td').on('dblclick', function(){
		cellClass = $(this).attr('class');//get the class of the td
        prevtd = thistd;
        if (prevtd != '' && (prevtd.attr('class') == 'c3'))
                restoreTdP(prevtd, prev);
        thistd = $(this);
		if(cellClass == 'c1' || cellClass == 'c2'){
			p = $(this).find('p');
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
			$(this).keypress(function(e){
                newVal = p.text();
				if (e.which == 13){
                    e.preventDefault();
					p.attr('contentEditable', false); //finished editing
					console.log(newVal);
					if (newVal != currval && newVal != ''){
						$.ajax({
							url: 'editPickupTable.php',
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
                                    location.reload();
//									$("#editsuccessbox").fadeIn(300);
//									setTimeout(function() {
//									  $("#editsuccessbox").fadeOut(300);
//									}, 4000);
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
        else if (cellClass == 'c3'){
            p = $(this).find('p');
            prev = p.text();
            currval = p.text();
            $('td').removeAttr('id', 'edit');
            $(this).attr('id', 'edit');
            row = $(this).parent();
            td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
            pk = td1.text();
            $.ajax({
                url: 'ppgroupDropdown.php',
                type: 'POST',
                cache: false,
                data: {'ppgroup':currval},
                success: function(data){
                    thistd.empty();
                    thistd.append(data);
                    thistd.children().keypress(function(e){
                        console.log( thistd.children());
                        if(e.which == 13){
                            e.preventDefault();
                            qsel = $('#drop_ppgroup :selected').text();
                            $.ajax({
                                url: 'editPickupTable.php',
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
                                        location.reload();
                                        thistd.empty();
                                        thistd.html('<p>'+qsel+'</p>');
                                        prev = qsel;
//                                        $("#editsuccessbox").fadeIn(300);
//                                        setTimeout(function() {
//                                          $("#editsuccessbox").fadeOut(300);
//                                        }, 4000);
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