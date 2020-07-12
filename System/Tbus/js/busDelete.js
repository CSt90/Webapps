//this function deletes row if the user clicks '-'
function deleteRow(row){
	// code below retrieves value from 1st cell in the row, which is located between p tags
	data = row.querySelectorAll("p");//this function gets all p elements in the row
	//getElementsByTagName("td").item(0).textContent;
	id = data[0].textContent; //now get the content inside 1st p element
	top.location.href = 'delFromBusTable.php?cell='+id; //this passes the variable id to the other php page
}