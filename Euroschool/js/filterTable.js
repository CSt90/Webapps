function applyFilter() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filterTable");
  console.log(input);
  // input = strToOrdinary(input);
  filter = input.value.toUpperCase();
  table =$('.table table-striped table-hover');
  tr = $('.table-striped tr');//table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
     td = $('tr').eq(i).find('td:not(.deltd):not(.edittd)');
     if (td) {
       if (td.text().toUpperCase().indexOf(filter) > -1) {
         tr[i].style.display = "";

       } else {
         tr[i].style.display = "none";
       }
       $('tr:even').css('background-color', 'white');
       $('tr:odd').css('background-color', 'rgba(0, 0, 0, 0.05)');
       // $('tr:not(#table-header):not(#add-new-patient):odd').css('background-color', '');
     }
  }
}

function strToOrdinary(str){
   if(str!=-1 && str.length>0){
      var unordinaryChars = 'ΆάΈέΉήΊίΌόΎύΏώς';
      var ordinaryChars = 'ΑαΕεΗηΙιΟοΥυΩωσ';
      str = str.split('');
      console.log(str);
      var i,x;
      for (i=0; i<str.length;i++){
         if ((x = unordinaryChars.indexOf(str[i])) != -1) {
            str[i] = ordinaryChars[x];
         }
         else {
            str[i] = str[i];
         }
      }
      return str.join('');
   }
}
