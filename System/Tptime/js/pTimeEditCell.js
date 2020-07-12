$(document).ready(function(){
  var cellPrev = null;
  $('td').on('dblclick', function(){
    if(cellPrev){
      $('.edit').text(prevVal);
      $('.edit').css('backgroundColor', cellColor);
      $('.edit').removeClass('edit');
    }
    console.log($(this));
    cell = $(this);
    cellPrev = $(this);
    cellP = cell.find('p');
    cellColor = cell.css('backgroundColor');
    cellP.prop('contentEditable', true);
    cell.addClass('edit');
    cell.css('backgroundColor', 'lightblue');
    prevVal = cell.text();
    $(this).keypress(function(e){
      newVal = $.trim(cellP.text());
      if (e.which == 13){
          e.preventDefault();
          console.log(newVal);
          cellP.prop('contentEditable', false);
          cell.removeClass('edit');
          cell.css('backgroundColor', cellColor);
          if(newVal != prevVal && newVal != ''){
            console.log('ajax happens here');
            console.log('new value '+ newVal);
            console.log('previous value '+prevVal);
            cellP.text(newVal);
          }
          else{
            console.log('no ajax');
            cellP.text(prevVal);
          }
      }
    });
  });
});
