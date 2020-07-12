function isNumeric(n) { //function checks if input n is a numeric value
  return !isNaN(parseFloat(n)) && isFinite(n);
}
//needs fixin 1/2/19
function calcTotals(){
   var sum=0;
   $('.c19').each(function(sum){
      if($(this).parent('tr').css('display')=='')
         sum+=$(this).text();
      console.log(sum);
   });
   console.log('Filtered total is '+sum);
}

function applyFilter() {
  // Declare variables
  var input, filter, table, tr, td, i, noshow = 0;
  input = document.getElementById("filterField");
  filter = input.value.toUpperCase();
  table = document.getElementById("itable");
  tr = $('tr:not(#Cnames)');//table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = $('.c10').eq(i).find("p"); //$('tr:not(#Cnames)').eq(i).find("p");
    if (td) {
      if (td.text().toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function rangeFilter() {
	// Declare variables
	var input, filter, table, tr, td, i, noshow = 0;
	input1 = document.getElementById("voucherRangeMin");
	input2 = document.getElementById("voucherRangeMax");
	filterMin = input1.value.toUpperCase();
	filterMax = input2.value.toUpperCase();
	if ( (isNumeric(filterMin) || filterMin == "") && (isNumeric(filterMax) || filterMax == "")){
		table = document.getElementById("itable");
		tr = $('tr:not(#Cnames)');//table.getElementsByTagName("tr");
		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = $('.c2').eq(i).find("p"); //$('tr:not(#Cnames)').eq(i).find("p");
			if (td) {
				if (($.trim(td.text()) >= filterMin && $.trim(td.text()) <= filterMax) || (filterMin == "" && $.trim(td.text()) <= filterMax) || ($.trim(td.text()) >= filterMin && filterMax == "")) {//td.text().toUpperCase().indexOf(filter) > -1 &&
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
   calcTotals();
}

$('document').ready(function(){
	$('body').scrollLeft(0);
	$('#filters-slider').on('click', function(){
		if($.trim($(this).text()) == '\u21ea'){
			$('#filters-area').animate({height:'0%'}, 1200);
			$('#filters-area').children().hide(800);
			$('#filters-slider').text('\u21e9');
		}
		else{
			$('#filters-area').animate({height:'19%'}, 1200);
			$('#filters-area').children().show(800);
			$('#filters-slider').text(' \u21ea ');
		}
	});
});

leftOffset = parseInt($("#filterRes").css('left')); //Grab the left position left first
$(window).scroll(function(){
    $('#filterRes').css({
        'left': $(this).scrollLeft() + leftOffset //Use it later
    });
});
