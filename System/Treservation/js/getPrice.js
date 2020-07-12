if($('#drop').val()>0){
	fetchPrice();
}

function fetchPrice(){
	var exID = $('#drop').val();
	$.ajax({ 
		url: 'fetchExcPrice.php',
		type: 'POST',
		cache: false,
		data: {exID:exID},
		success: function(data){
			console.log(data);
			$('input[name=AdultPrice]').val(data);
			if (parseInt($('input[name=KidPrice]').val())>0)
				$('input[name=KidPrice]').val(data/2);
			totalPriceCalc();
		}
	});
}