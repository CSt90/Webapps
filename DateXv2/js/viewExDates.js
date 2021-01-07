function dateDiff(exdate) { //calculate the difference in days between the expiration date and today's date
    var today = new Date();
    var timeDiff = exdate - today;
    var daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    return daysDiff;
}

function adjustDate(dateInput) {
    if ($.trim(dateInput) != '') {
        date = dateInput.split('/');
        console.log(date);
        if (date[2].length == 2) {
            date[2] = '20' + date[2];
        }
        console.log(date[2])
        oldDate = new Date(date[2], date[1] - 1, date[0]);
        console.log(oldDate);
        newDate = (oldDate.getMonth() + 1) + '/' + oldDate.getDate() + '/' + oldDate.getFullYear()
        console.log(newDate);
        //select newDate on calendar
    } else {
        newDate = '';
    }
    return newDate;
}

function paintRow(datediff, rowNo) {
    if (datediff > 62) {
        color = 'white';
        $(".row" + rowNo + " td" + ', .row' + rowNo + ' input').css('color', 'black');
        $(".row" + rowNo + " td" + ', .row' + rowNo + ' input').css('background-color', 'white');
    } else if (datediff < 0) {
        color = 'black';
        $(".row" + rowNo + " td" + ', .row' + rowNo + ' input').css('color', 'white');
        $(".row" + rowNo + " td" + ', .row' + rowNo + ' input').css('background-color', 'black');
    } else if (datediff <= 31) {
        color = "#e83838";
        $(".row" + rowNo + " td" + ', .row' + rowNo + ' input').css('background-color', color);
    } else if (datediff <= 62) {
        color = "#f5834e";
        $(".row" + rowNo + " td" + ', .row' + rowNo + ' input').css('background-color', color);
    }
    console.log(rowNo + ' gets ' + color);
}

$(document).ready(function(){
	 $(function () {
         $(".datepicker").datepicker({
             dateFormat: 'd/m/y'
         });
     });
     $('.add').on('click', function (e) {
         e.preventDefault();
         sup = $('#supplierSelect').val();
         window.location = 'home.php?pt=' + sup;
     });

     $('#change_sup').unbind().on('click', function(){
        if($('#deads').prop('checked') === false){
            deads = '&deads=0';
        }
        else{
            deads = '&deads=1';
        }
        supplier = $('#supplierSelect option:selected').val();
        window.location = 'viewExDates.php?pt=' + supplier + deads;
     });

     $('#change_docid').unbind().on('click', function () {
        if($('#deads').prop('checked') === false){
            deads = '&deads=0';
        }
        else{
            deads = '&deads=1';
        }
         supplier = $('#supplierSelect option:selected').val();
         docid_filter = parseInt($('.docid').val());
        //  if (Number.isInteger(docid_filter)) {
        //      console.log("integer");
        //      $.ajax({
        //          method: "POST",
        //          url: "getDocidFiltered.php",
        //          cache: false,
        //          data: {
        //              "sup": supplier,
        //              "docid": docid_filter
        //          },
        //          success: function (data) {
        //              $('tr:not(.thead tr)').remove();
        //              $('#dates tbody').append(data);
        //              $('.datepicker').val("");
        //          }
        //      })
        //  }
        if (Number.isInteger(docid_filter)) {
            window.location = 'viewExDates.php?docid=' + docid_filter + '&pt=' + supplier + deads;        
        }
     });

     $('#change_date').unbind().on('click', function () {
        if($('#deads').prop('checked') === false){
            deads = '&deads=0';
        }
        else{
            deads = '&deads=1';
        }
         supplier = $('#supplierSelect option:selected').val();
         date_filter = $('.datepicker').val();
		 console.log(date_filter);
        //  if (Date.parse(date_filter)){
        //      console.log("date");
        //      $.ajax({
        //          method: "POST",
        //          url: "getDateFiltered.php",
        //          cache: false,
        //          data: { "sup": supplier, "date": date_filter },
        //          success: function(data){
        //              $('tr:not(.thead tr)').remove();
        //              $('#dates tbody').append(data);
        //              $('.docid').val("");
        //          }
        //      })
        //  }
        date_filter = adjustDate(date_filter);
        if (Date.parse(date_filter)) {
            window.location = 'viewExDates.php?date=' + date_filter + deads;
        }
     });

     $(".docid, .datepicker").unbind().on('keydown', function(event){
         keycode = (event.keyCode ? event.keyCode : event.which);
         if (keycode == 13){
             console.log($(this)[0].outerHTML);
             if ($(this)[0].outerHTML == $(".docid")[0].outerHTML) {
                 console.log("docid");
                 $('#change_docid').click();
             }
             else if ($(this)[0].outerHTML == $(".datepicker")[0].outerHTML){
                 $('#change_date').click();
             }
         }
     });

     edit = 0;
     row_oldvals = []; //create an array to store all existing values of the row
     row_newvals = [];
     row=-1;

     $('.edit').unbind().on('click', function(e){
         if($(this).prop('className') == 'edit' && edit == 0){
            console.log('edit mode '+ $(this).text());
            //  e.preventDefault();
             edit = 1;
             row = $('.edit').index(this)+1; //get the index of the element to know which row we are processing
             $(this).prop('className', 'store'); //change class to .insert
             prevCellIndex = $(this).parent('td').prev('td')[0].cellIndex;
             prevTdColor = $('.row' + row).css('backgroundColor');
             console.log($(this).parent('td').prev('td')[0].cellIndex);

             $('.row' + row + ' input').prop('disabled', false); //enable editing for all the input elements in this row
             background = $('.row' + row + ' > td:eq(2)').css('background-color'); //save current row bg color
             console.log('bg-clr: ', background);
             $('.row' + row + ' > td, .row' + row + ' input').css('background-color', '#00BAED'); //change row bg color so that user knows which row is on edit
             $('.row' + row).css('color', 'black'); //change row bg color so that user knows which row is on edit
             previousFontColor = $('.row' + row + ' input').css('color');
             $('.row' + row + ' td').css('color', previousFontColor); //change input font color on row being edited to black
            //  blockUser(row);
              
             for (i = 0; i < $('.row' + row + ' input').length; i++){
                 row_oldvals.push($('.row' + row + ' input:eq('+i+')').val());
             }
             console.log(row_oldvals);        
     
             $('.row'+row+' input:first').focus(); //focus on the first input of the row, so the user can start editing right away
             $('.row' + row + ' input').unbind().on('keydown', function(k){ //detect keyboard input
                 if(k.which == 27){ //if ESC key is pressed, the function cancels all edits made
                     for (i = 0; i <= $('.row' + row + ' input').length; i++) { //so for every input element in the row
                         console.log(i + '\n');
                         $('.row' + row + ' input:eq(' + i + ')').val(row_oldvals[i]).blur(); //restore the previous value and remove focus
                         $('.row' + row + ' input').prop('disabled', true); //disable editing
                     }
                     row_oldvals = []; //empty the array
                     $('.store').prop('className', 'edit'); //restore original className of .edit
                     $('.row' + row + ' > td, .row' + row + ' input').css('background-color', background); //restore previous row bg color
                     $('.row' + row + ' > td:eq(-1), .row' + row + ' > td:eq(-2)').css('background-color', '#e6e6e6');
                     $('.row' + row + ' > td input').css('color', previousFontColor); //finally restore font color
                     edit = 0;
                    //  unBlockUser(row);
                }else if(k.which==13){
                    whichCell = $('.row' + row + ' input').index(this);
                    console.log(whichCell);
                    if (whichCell === 0){
                        exdate = $('.row' + row + ' .exdate').val();
                        console.log(exdate);
                        exdate = new Date(exdate);
                        console.log(exdate);
                        days = dateDiff(exdate);
                        console.log(days);
                        paintRow(days, row);
                    }
                    if (whichCell !== $('.row' + row + ' input').length-1){ //if we're not at the last input
                        $('.row' + row + ' input:eq('+(whichCell+1)+')').focus(); //focus on the next input
                    }
                    else{
                        console.log($(this));
                        storeClick();
                    }
                }
            });
         }
         else if ($(this).prop('className') == 'edit' && edit == 1) {
             return false;
         }
         else{
             storeClick();
         }
         console.log('END');
     });

     $('.del').on('click', function(){
         row = $('.del').index(this) + 1; //get the index of the element to know which row we want to delete

         $.ajax({
             method: "POST",
             url: "del_date.php",
             cache: false,
             data: { 'id': $('.row' + row + ' .entry_id')[0].innerText },
             success: function (data) {
                 console.log(data);
                 $('.row' + row).fadeOut("slow");
             }
         })
     });

     function storeClick() {
         console.log('store mode');
         if (Date.parse($('.row' + row + ' .exdate').val()) && Date.parse($('.row' + row + ' .delivery_date').val()) && (parseInt($('.row' + row + ' .volume').val()) || $.trim($('.row' + row + ' .volume').val()) == '') && parseInt($('.row' + row + ' .document_id').val())) {
            console.log('all right');
         }
         else{
            if (!Date.parse($('.row' + row + ' .exdate').val())) {
                console.log('               FOCUS');
                $('.row' + row + ' .exdate').focus();
            }
            
            if (!Date.parse($('.row' + row + ' .delivery_date').val())) {
                $('.row' + row + ' .delivery_date').focus();
            }
            
            if (!parseInt($('.row' + row + ' .volume').val()) && $.trim($('.row' + row + ' .volume').val()) !== '') {
                $('.row' + row + ' .volume').focus();
            }

            if (!parseInt($('.row' + row + ' .document_id').val())) {
                $('.row' + row + ' .document_id').focus();
            }
            return false;
         }
         for (i = 0; i < $('.row' + row + ' input').length; i++) {
             input_val = $('.row' + row + ' input:eq(' + i + ')').val();
             row_newvals.push(input_val);
             console.log($('.row' + row + ' input:eq(' + i + ')').val());
         }
         console.log('new: '+row_newvals+'\n old: '+row_oldvals);
         console.log(edit);

         if (row_newvals !== row_oldvals && row_newvals.length > 0) {
             for (i = 0; i <= $('.row' + row + ' input').length; i++) { //so for every input element in the row
                 $('.row' + row + ' input:eq(' + i + ')').val(row_newvals[i]).blur(); //display the new value and remove focus
                 $('.row' + row + ' input').prop('disabled', true); //disable editing
             }

             myKeyVals = {
                     'id': $('.row' + row + ' .entry_id')[0].innerText,
                          'ex_date' : row_newvals[0],
                          'item' : row_newvals[1], 
                          'amt': row_newvals[2],
                          'deli_date' : row_newvals[3],
                          'doc_id': row_newvals[4]
                          };

             $.ajax({
                 method: 'POST',
                 url: "edit_date.php",
                 data: myKeyVals,
                 cache: false,
                 success: function (data) {
                     console.log(data)
                 }
             });
         } else {
             for (i = 0; i <= $('.row' + row + ' input').length; i++) { //so for every input element in the row
                 $('.row' + row + ' input:eq(' + i + ')').val(row_oldvals[i]).blur(); //restore the previous value and remove focus
                 $('.row' + row + ' input').prop('disabled', true); //disable editing
             }
         }
         row_oldvals = []; //empty the arrays
         row_newvals = [];
         $('.row' + row + ' .store').prop('className', 'edit'); //restore original className of .edit
         $('.row' + row).css('background-color', background); //restore previous row bg color
         $('.row' + row + ' td').css('background-color', background); //restore previous row bg color
         $('.row' + row + ' input').css('color', previousFontColor); //finally restore font color
         edit = 0;
        //  unBlockUser(row);
     }

     function blockUser(row){
         $('select').attr('disabled', true);
         $('.change_sup').css('pointer-events', 'none');
         $('.add').css('pointer-events', 'none');
         $('.edit').css('pointer-events', 'none');

         for(i=0;i<$('#dates tr').length;i++){
            if(i !== row-1){
                $('.row' + (i + 1) + ' .del').css('pointer-events', 'none');
            }
            else
                console.log('row '+i);                
         }
     }

     function unBlockUser(row){
         $('select').attr('disabled', false);
         $('.change_sup').css('pointer-events', 'auto');
         $('.add').css('pointer-events', 'auto');
         $('.edit').css('pointer-events', 'auto');
                  console.log($('.edit'));
         for (i = 0; i < $('#dates tr').length; i++) {
             if (i !== row - 1) {
                 $('.row' + (i + 1) + ' span').css('pointer-events', 'auto');
             } else
                 console.log('row ' + i);
         }
     }
});