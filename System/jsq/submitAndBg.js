$(document).ready(function(){
	$('#new').keypress(function (e) {
	  if (e.which == 13) {		
		if(newval1=='' || newval2=='')
			alert('please fill in all input fields');
		else{
			$('#submit').click();
			location.reload();
		}
		console.log("done");
		return false;    //<---- Add this line
	  }
	})
});

var originalBgColor;

//this function changes the bg color of the selected row if the user hovers over '-'
function showDelRow(row){
	originalBgColor = row.style.backgroundColor;
	for (i=1; i<row.cells.length-1; i++){
		console.log('pink cell '+i);
		row.cells[i].style.backgroundColor = 'rgba(240, 0, 12, 0.3)';
	}
}

//this function reverts selected row back to its original bg color
function hideDelRow(row){
	for (i=1; i<row.cells.length-1; i++){
		console.log('default cell '+i);
		row.cells[i].style.backgroundColor = originalBgColor;
	}
}