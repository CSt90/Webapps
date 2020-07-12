//this function deletes row if the user clicks '-'
function deleteRow(row){
	// code below retrieves value from 1st cell in the row, which is located between p tags
	data = row.querySelectorAll("p");//this function gets all p elements in the row
	//getElementsByTagName("td").item(0).textContent;
	id = data[0].textContent; //now get the content inside 1st p element
	top.location.href = 'delFromDriverTable.php?cell='+id; //this passes the variable id to the other php page
}

//this function allows the user to edit cell data on double click
$(document).ready(function(){
	$('td').dblclick(function(){
		cellClass = $(this).attr('class');//get the class of the td
		if(cellClass == 'c1'){
			p = $(this).find('p');
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:nth-child(2)').find('p'); //locate p of 2nd td in row; 1st td is deleteRow
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
			$(this).keypress(function(e){
				newVal = p.text();
				if (e.which == 13){
					p.attr('contentEditable', false); //finished editing
					if (newVal != currval && newVal != ''){
						$.ajax({
							url: 'editDriverTable.php',
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
	});	
});