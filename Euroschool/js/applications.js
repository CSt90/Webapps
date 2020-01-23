$(document).ready(function(){
   $('#filterTable').on('focus', function(){
      $(this).attr('placeholder', '');
   });
   $('#filterTable').on('focusout', function(){
      $(this).attr('placeholder', 'Φίλτρο');
   });
});
