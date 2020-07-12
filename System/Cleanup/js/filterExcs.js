function applyFilter() {
  // Declare variables 
  var input, filter, table, tr, td, i, noshow = 0;
  input = document.getElementById("filterExcs");
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

$('document').ready(function(){
   $('body').scrollLeft(0); 
});

leftOffset = parseInt($("#filterRes").css('left')); //Grab the left position left first
$(window).scroll(function(){
    $('#filterRes').css({
        'left': $(this).scrollLeft() + leftOffset //Use it later
    });
});