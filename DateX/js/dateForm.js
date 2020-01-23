function dateForm(input){
    chars = input.length;
    if (chars >= 4 && chars <= 8){
        if (chars >= 6 && chars <= 8){
            datearr = input.split(/[\-\/]/); // dd/mm/yy
            dd = datearr[0];
            mm = String(parseInt(datearr[1])-1);
            yy = String(parseInt(datearr[2])+2000);
            if(parseInt(mm)+1 == 2){
                if (parseInt(yy)%4 == 0){
                    if(parseInt(dd) > 29){
                        console.log('not a date');
                        return -1;
                    }
                }
                else{
                    if (parseInt(dd) > 28) {
                        console.log('not a date');
                        return -1;
                    }
                }
            }
            d = new Date(yy, mm, dd);
            mm = String(parseInt(datearr[1]));
            d = yy + '-' + mm + '-' + dd;
        }
        else if (chars >= 4 && chars <= 5) {
            datearr = input.split(/[\-\/]/); // mm/yy
            dd = '0';
            mm = String(parseInt(datearr[0]));
            yy = String(parseInt(datearr[1]) + 2000);
            d = new Date(yy, mm, dd);
            dd = d.getDate();
            d = yy + '-' + mm + '-' + dd;
        }
        if (Date.parse(d)){
            if(parseInt(mm)<10){
                mm = '0' + mm;
            }
            if (parseInt(dd) < 10) {
                dd = '0' + dd;
            }
            dateString = yy + '-' + mm + '-' + dd;
            console.log(dateString);
            return dateString;
        }
        else{
            console.log('not a date');
            return -1;
        }
    }
    else{
        console.log('not a date');
        return -1;
    }

}