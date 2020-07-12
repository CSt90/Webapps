//this function deletes row if the user clicks '-'
function deleteRow(row){
	// code below retrieves value from 1st cell in the row, which is located between p tags
	data = row.querySelectorAll("p");//this function gets all p elements in the row
	//getElementsByTagName("td").item(0).innerHTML;
	id = data[0].textContent; //now get the content inside 1st p element
	top.location.href = 'delFromExcursionTable.php?cell='+id; //this passes the variable id (of the row) to the other php page
}

//this function allows the user to edit cell data on double click
$(document).ready(function(){
    thistd = '';
	$('td').on('dblclick', function(){
		cellClass = $(this).attr('class');//get the class of the td
        prevtd = thistd;
        if (prevtd != '' && (prevtd.attr('class') == 'c2'))
                restoreTdP(prevtd, prev);
        thistd = $(this);
		if(cellClass == 'c1' || cellClass == 'c3' || cellClass == 'c4' || cellClass == 'c5'){
			p = $(this).find('p');
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
			$(this).keypress(function(e){
				if (cellClass == 'c5')
					newVal = p.text().replace(' €', '');
				else
					newVal = p.text();
				if (e.which == 13){
                    e.preventDefault();
					p.attr('contentEditable', false); //finished editing
					console.log(newVal);
					if (newVal != currval && newVal != ''){
						$.ajax({
							url: 'editExcursionTable.php',
							type: 'POST',
							cache:false,
							data: {'pk': pk, 'cellClass': cellClass, 'newVal': newVal, 'oldVal':currval},
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
		else if (cellClass == 'c2'){
            updays = false;
			p = $(this).find('p');
            prev = p.text();
			currdays = p.text();
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 1st td in row
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
			//up until this point, almost all is same as above
			cell = $(this);
            console.log($(this));
			//p.hide(); //hide the p that contains the current value
			chk = $('.check');
			cln = chk.clone(true);
			cln.find('.adbtn').hide(); //clone the check boxed form and hide the add button because it is included in the original
			cln.css('height','40px');
			cln.attr('class','c2');
			cln.attr('id', 'edit'); //give attributes to the clone for styling
            cell.empty();
			$(this).append(cln);//replace the td with the clone
			cln.keypress(function(e){
				if (e.which == 13){
                    e.preventDefault();
					boxes = cln.find('input'); // store the ckeckboxes
					console.log(boxes[3]);
					days = [0,0,0,0,0,0,0];
					EDays = '';
					for (i=0;i<7;i++){ 
						if (boxes[i].checked == true){ // for each checked box
							days[i] = 1; // change the according value in days[]
							updays = true; // if at least one value of days was changed, we have something new to put in the table
						}
					}
					if (days[0] == 1)
						EDays = '|Mon| ';
					if (days[1] == 1)
						EDays = EDays+'|Tue| ';
					if (days[2] == 1)
						EDays = EDays+'|Wed| ';
					if (days[3] == 1)
						EDays = EDays+'|Thu| ';
					if (days[4] == 1)
						EDays = EDays+'|Fri| ';
					if (days[5] == 1)
						EDays = EDays+'|Sat| ';
					if (days[6] == 1)
						EDays = EDays+'|Sun|';
					newVal = days;
					if (EDays != currdays && updays == true){
						$.ajax({
							url: 'editExcursionTable.php',
							type: 'POST',
							cache:false,
							data: {'pk': pk, 'cellClass': cellClass, 'newVal': newVal},
							success: function(data){
								d = jQuery.parseJSON(data);	//needed in order to be able to read returned values from edit page
								console.log(data);
								$('td').removeAttr('id', 'edit'); //exit out of edit mode to restore bg color
								if (d.er == 'error'){ // if edit page returns error
                                    restoreTdP(thistd, currdays);
//									thistd.empty();
//                                    thistd.html('<p>'+currdays+'</p>');
									$("#errormsg").text(d.msg); //display the error message originating from the edit page
									$("#errorbox").fadeIn(300);
									setTimeout(function() {
									  $("#errorbox").fadeOut(300);
									}, 4000);
								}
								else if (d.er == 'success'){ //if edit was successful
									restoreTdP(thistd, EDays);
//									thistd.empty();
//                                    thistd.html('<p>'+EDays+'</p>');
									$("#editsuccessbox").fadeIn(300);
									setTimeout(function() {
									  $("#editsuccessbox").fadeOut(300);
									}, 4000);
								}
							}
						});
						return e.which != 13; //prevents new line when pressing enter
					}
                    else if (EDays == currdays && updays == true){
                        thistd.empty();
                        thistd.html('<p>'+currdays+'</p>');
                    }
					else if (EDays == '' || EDays == null){ //if cell is empty, no change
//						cln.replaceWith(cell);
//						cell.find('p').text(currdays); // just put the previous value back
//						cell.find('p').show();
                        thistd.empty();
                        thistd.html('<p>'+currdays+'</p>');
					}
                    else if (updays == false){
                        thistd.empty();
                        thistd.html('<p>'+currdays+'</p>');
                    }
				}
			});
		}
	});	
});

function restoreTdP(td, prev){    
    td.empty();
    td.html('<p>'+prev+'</p>');
}