//this function allows the user to edit cell data on double click
function editCell(cell){ //does not apply for 1st column/(1st cell on row) because that's where the pk is usually stored
	currentValue = cell.textContent; //store the current value of the cell
	rowData = cell.parentNode.parentNode.querySelectorAll("p"); //locate row and find all 'p's inside
	primaryKey = rowData[0].textContent; //get the primary key (1st 'p'), so it can be sent to the execute query file
	cell.contentEditable=true; //make cell editable on double click
	var newValue= null;
	cell.onkeypress = function(e){ //detect enter press when cell is selected
		if(!e)
			e = window.event;
		var keyCode=e.keyCode || e.which;
		if (keyCode == 13){
			cell.contentEditable=false; // stop editing when enter is pressed
			newValue = cell.textContent; // store new value
			top.location.href = 'editBusTable.php?newVal='+newValue+'&pk='+primaryKey;	//goto edit page with parameters
		}		
	}
}

$(document).ready(function(){
	$('td').dblclick(function(){
		cellClass = $(this).attr('class');//get the class of the td
		if(cellClass == 'c1'){
			p = $(this).find('p');
			currval = p.text();
			$('td').removeAttr('id', 'edit');
			$(this).attr('id', 'edit');
			row = $(this).parent();
			td1 = row.find('td:first').find('p'); //locate p of 1st td in row
			pk = td1.text(); //get the primary key (1st 'p'), so it can be sent to the execute query file
			p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
			$(this).keypress(function(e){
				newVal = p.text();
				if (e.which == 13){
					p.attr('contentEditable', false); //finished editing
					if (newVal != currval && newVal != ''){
						$.ajax({
							url: 'editBusTable.php',
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