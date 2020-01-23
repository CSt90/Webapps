$(document).ready(function(){
    // ON ENTER PRESS, GO TO THE INPUT BELOW INSTEAD OF SUBMITTING FORM
    $('#dates').on('keydown', 'input', function(e){
        if (e.which == 13){
            console.log('enter');
            e.preventDefault();
            inputClassName = $(this).attr('class');
            rowNo = parseInt($(this).parent().parent().attr('class').match(/\d+/)[0]);
            $(this).blur();
            $(".row"+(rowNo+1)+" > td > ."+inputClassName).focus();
            console.log(rowNo);
            if (inputClassName == "exdate"){
                exdate = dateForm(String($(".row" + rowNo + " ." + inputClassName).val()));
                console.log(typeof(exdate)+" date::"+exdate);
                exdate = new Date(exdate);
                console.log(dateDiff(exdate));
                datediff = dateDiff(exdate);
                paintRow(datediff, rowNo);
            }
        }
    })

    // ADD NEW ROW ON TOP OF SELECTED CELL
    $('.add_row').unbind().on('mousedown', function(e){
		e.preventDefault();
		if($(':focus').attr('class') == 'exdate' || $(':focus').attr('class') == 'item' || $(':focus').attr('class') == 'volume'){
			focus = $(':focus');		
			r = parseInt(focus.parent().parent().attr('class').match(/\d+/)[0]); //row number
			lastRow = parseInt($('tr:last-child')[1].className.match(/\d+/)[0]); //last row number
			insertRow(r, lastRow);
		}
    });

    // ADD NEW EMPTY CELL ON TOP OF SELECTED CELL #DATE
    $('#add_date_cell').unbind().on('mousedown', function (e) {
        e.preventDefault();
        if ($(':focus').attr('class') == 'exdate') {
            focus = $(':focus');
            r = focus.parent().parent().attr('class').match(/\d+/)[0]; //row number
            lastRow = parseInt($('tr:last-child')[1].className.match(/\d+/)[0]); //last row number
            if( $.trim($('.row'+lastRow+' .exdate').val()) == '' ){
                pushCellsDownByOne(lastRow, ' .exdate');
            }
            else{
                $('.row'+lastRow).after(newRow((lastRow+1)));
                pushCellsDownByOne((lastRow + 1), ' .exdate');
            }
        }
    });

    // ADD NEW EMPTY CELL ON TOP OF SELECTED CELL #ITEM
    $('#add_item_cell').unbind().on('mousedown', function (e) {
        e.preventDefault();
        if ($(':focus').attr('class') == 'item') {
            focus = $(':focus');
            r = focus.parent().parent().attr('class').match(/\d+/)[0]; //row number
            lastRow = parseInt($('tr:last-child')[1].className.match(/\d+/)[0]); //last row number
            if ($.trim($('.row' + lastRow + ' .item').val()) == '') {
                pushCellsDownByOne(lastRow, ' .item');
            } else {
                $('.row' + lastRow).after(newRow((lastRow + 1)));
                pushCellsDownByOne((lastRow + 1), ' .item');
            }
        }
    });

    // ADD NEW EMPTY CELL ON TOP OF SELECTED CELL #VOLUME
    $('#add_amt_cell').unbind().on('mousedown', function (e) {
        e.preventDefault();
        if ($(':focus').attr('class') == 'volume') {
            focus = $(':focus');
            r = focus.parent().parent().attr('class').match(/\d+/)[0]; //row number
            lastRow = parseInt($('tr:last-child')[1].className.match(/\d+/)[0]); //last row number
            if ($.trim($('.row' + lastRow + ' .volume').val()) == '') {
                pushCellsDownByOne(lastRow, ' .volume');
            } else {
                $('.row' + lastRow).after(newRow((lastRow + 1)));
                pushCellsDownByOne((lastRow + 1), ' .volume');
            }
        }
    });

    $(function () {
        $(".datepicker").datepicker({
            dateFormat: 'yy/mm/dd'
        });
    });

    // ON SUBMIT CHECK IF DATES USER PUT ARE ACTUAL DATES
    $('.submit').on('click', function(){
        rows = $('#dates tr').length;
        console.log(rows);
        ret = 0;
        for(i=0;i<rows;i++){
            exd = $('.row'+(i+1)+' .exdate').val();
            if ($.trim(exd)!='' && dateForm(exd)==-1){
                ret = -1;
                $('.row' + (i + 1) + ' td:nth-child(2)').css('background-color', 'pink');
                $('.row' + (i + 1) + ' .exdate').css('background-color', 'pink');
            }
        }
        if (ret == 0)
            $('.submitb').click();
            // console.log('clicked');
    });

    // CHANGE URL ACCORDING TO SELECTED SUPPLIER ON SUPPLIER CHANGE
    $('#supplierSelect').on('change', function(){
        var supplier = $('#supplierSelect option:selected').text();
        if ($(this).val() != 0)       
            $(document).prop('title', "DateX + "+supplier);
        else
            $(document).prop('title', "DateX");
    });

    $(".docid").inputFilter(function (value) {
        return /^\d*$/.test(value);
    });
});

(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };
}(jQuery));

// CALCULATE DATE DIFFERENCE ACCORDING TO TODAY'S DATE
function dateDiff(exdate){ //calculate the difference in days between the expiration date and today's date
    var today = new Date();    
    var timeDiff = exdate-today;
    var daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    return daysDiff;
}

// PAINT THE ROW ACCORDING TO THE DATE DIFFERENCE
function paintRow(datediff, rowNo){
    console.log(datediff);
    if(datediff>62){
        $(".row" + rowNo + "> td, .row" + rowNo + " input").css('color', 'black');
        $(".row" + rowNo + "> td, .row" + rowNo + " input").css('background-color', 'white');
    }
    else if(datediff < 0){
        // color = "black";
        $(".row" + rowNo + "> td, .row" + rowNo + " input").css('color', 'white');
        $(".row" + rowNo + "> td, .row" + rowNo + " input").css('background-color', 'black');
    }
    else if(datediff <= 31){
        $(".row" + rowNo + "> td, .row" + rowNo + " input").css('color', 'black');
        $(".row" + rowNo +", .row"+ rowNo+ " input").css('background-color', "#e83838");
    }
    else if(datediff <= 62){
        $(".row" + rowNo + "> td, .row" + rowNo + " input").css('color', 'black');
        $(".row" + rowNo +", .row"+ rowNo+ " input").css('background-color', "#f5834e");
    }
}

// RETURNS A NEW ROW HTML CODE
function newRow(rowNo){
    return '<tr class="row'+rowNo+'"><td>'+rowNo+'</td><td><input type="text" name="exdate[]" class="exdate" value=""></td><td><input type="text" name="item[]" class="item" value=""></td><td><input type="text" name="volume[]" class="volume" value=""></td></tr>';
}

// PUSHES CELLS DOWN BY ONE CELL, ONLY FOR THE CURRENT COLUMN
function pushCellsDownByOne(lastRow, clName){
    for (i = lastRow; i > r; i--) {
        upperval = $('.row' + (i - 1) + clName).val();
        $('.row' + i + clName).val(upperval);
    }
    focus.val('');
}

// INSERTS A NEW ROW ON TOP OF THE SELECTED CELL, PUSHING EXISTING DATA BELOW, DOWN BY 1 
function insertRow(r, lastRow){
    j=0;
    for(i=lastRow;i>=r;i--){
        j=i+1;
        $('.row'+i+' td:first-child').text((i+1));
        newrow = 'row'+j+'';
        $('.row'+i+'').attr('class', newrow);
    }
    $('.row' + (r+1)).before(newRow(r));
}