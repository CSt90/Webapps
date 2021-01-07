function printDiv() { //https://stackoverflow.com/questions/33732739/print-a-div-content-using-jquery
    var divToPrint = $('.result_area')[0];//document.getElementsByClassName('result_area');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write('<html><head><meta charset="UTF-8"><link rel="stylesheet" href="styles/printDates.css"><head/><body onload="window.print()">' + divToPrint.outerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function () {
        newWin.close();
    }, 10);

}

function adjustDate(dateInput) {
    if ($.trim(dateInput) != ''){
        date = dateInput.split('/');
        console.log(date);
        if (date[2].length == 2){
            date[2] = '20' + date[2];
        }
        console.log(date[2])
        oldDate = new Date(date[2], date[1]-1, date[0]);
        console.log(oldDate);
        newDate = (oldDate.getMonth() + 1) + '/' + oldDate.getDate() + '/' + oldDate.getFullYear()
        console.log(newDate);
        //select newDate on calendar
    }
    else{
        newDate = '';
    }
    return newDate;
}

$(document).ready(function(){

    $(function () {
        $(".datepicker").datepicker({
            dateFormat: 'd/m/y'
        });
    });

    $('#get_exdates').unbind().on('click', function(){
        from = $.trim($('#from_date').val());
        aFrom = adjustDate(from);
        console.log(aFrom);
        until = $.trim($('#until_date').val());
        aUntil = adjustDate(until);
        console.log(aUntil);
        console.log(from+" - "+until);
        $.ajax({
            method: "GET",
            url: "getExDates.php",
            cache: false,
            data: {
                "from_date": aFrom,
                "until_date": aUntil
            },
            success: function (data) {
                $('#dates').remove();
				console.log(data);
                $('.result_area').append(data);
            }
        });
    });

    $('.print').unbind().on('click', function(){
        if ($('#dates tr').length > 1){
            printDiv();
            console.log('printing');
        }
    });

    $('#from_date').unbind().on().keyup(function(e){        
        if(e.which == 13){
            console.log($('#from_date').val());
            $(this).blur();
            $('#until_date').focus();
        }
        else if(e.which == 27){
            $('#from_date').val('');
        }
    });

    $('#until_date').unbind().on().keyup(function (e) {
        if (e.which == 13) {
            $(this).blur();
            $('#get_exdates').click();
        } else if (e.which == 27) {
            $('#until_date').val('');
        }
    });

    // $('#from_date, #until_date').unbind().on('click', function(){
    //     if($(this).val!=''){
    //         $(this).val('');
    //     }
    // });
});