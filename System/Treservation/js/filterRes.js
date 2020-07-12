function applyFilter() {
  // Declare variables 
  var input, filter, table, tr, td, i, noshow = 0;
  input = document.getElementById("filterRes");
  filter = input.value.toUpperCase();
  if ($.trim(filter) == 'NOSHOW')
      noshow = 1;
  else  
      noshow = 0;
  table = document.getElementById("rtable");
  tr = $('tr:not(#Cnames)');//table.getElementsByTagName("tr");
    console.log(noshow);

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    if (noshow == 1){
        td = $('tr:not(#Cnames)').eq(i).find("td.c20 p");
        if (td) {
          if (td.text() == '✘') { //✘
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
    }
    else{
        td = $('tr:not(#Cnames)').eq(i).find("p");
        if (td) {
          if (td.text().toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
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