$(document).ready(function() {
	//$('#datepicker').prop('disabled', true); //on pageload, calendar input is disabled, since no excursion is selected yet
	var dyncon = $('#dynamic-content').html();
    calendarSetup();
	$('#drop').on('change', function(){ //once an excursion is selected
		var days;
        //$('#datepicker').val(''); // ?? Ask Tasos & Yianna
		resetAll();
		if($('#drop').val()<0){ //if instead of excursion, user selects the select.. 'option'
			$('#datepicker').prop('disabled', true);  //calendar input remains disabled
			$('#datepicker').val('');
			$('#prompt-text').text('Select excursion first'); //and user is prompted to select an excursion before a date
		}
		else{ //if an excursion is selected
		  calendarSetup();	
		  $("#datepicker").datepicker("refresh");
        }
	});
		
	//when you click go..
	$('#gobtn').click(function(){
		$('#seats').text('- / -');
		$('#buses').text(' ');
		if($('#drop').val()>0 && $('#datepicker').val()!=null && $.trim($('#datepicker').val())!=''){
			exc = $('#drop').val(); date = $.trim($('#datepicker').val());
			//console.log('exc: '+exc+' | date: '+date);
			$.ajax({
				url: 'displayPickupList.php',
				type: 'POST',
				cache: false,
				data: {exc: exc, date:date},
				success: function(data){
                    urlPath = 'viewPickupList.php?ex='+exc+'&date='+date;
					processAjaxData(data, urlPath);
					seats = $('#ninja-numofseats').text();
					tseats = $('#ninja-totalseats').text();
					b = $('#ninja-buses').text();
					$('#assign').prop('disabled', false);
					//getTotalSeats(exc, date);
					if($.trim(seats)!='' && seats!=null){
						if($.trim(tseats)!='' && tseats!=null && tseats!=0)
							$('#seats').text(seats+" / "+tseats); //**** if available-current seats <10 then text will become red
							
						else
							$('#seats').text(seats); //**** if available-current seats <10 then text will become red
					}
					if($.trim(b)!='' && b!=null)
						$('#buses').text(b.replace('"', ''));
				}
			});
		}
		else
			console.log('shiiet');
	
	});
	
	function resetAll(){
		$("#datepicker").datepicker("destroy");
		$('#dynamic-content').html(dyncon);
		$('#seats').text('- / -');
		$('#buses').text(' ');
	}
	
	$('#assign').on('click', function(){
		$(this).attr( "href",  "../Assignment/busManagement.php?date="+$.trim($('#datepicker').val()));
	});
	
	$('#export-btn').on('click', function(){		
		$("#pltable").table2excel({
        // exclude CSS class
        //exclude: ".noExl",
        name: $('#drop :selected').text()+" "+$.trim($('#datepicker').val()),
        filename: $('#drop :selected').text()+"_"+$.trim($('#datepicker').val()) //do not include extension
      });
	});
    
    function calendarSetup(){
        dropval = $('#drop').val(); //store the selected one
        $.ajax({ //send the selected excursion to _getDays.php_
            url: '../Treservation/getDays.php', //'displayList.php',
            type: 'POST',
            cache: false,
            data: {exc:dropval},
            success: function(data){
                //console.log(data);
                //$('#dynamic-content').html(data);
                days = data; //then store the string than got echo'd from the php file mentioned above which contains the days the excursion doesn't happen
            }
        });
        $('#datepicker').prop('disabled', false); //enable calendar input
		var changeYear = $( "#datepicker" ).datepicker( "option", "changeYear" );
        $("#datepicker").datepicker({dateFormat : 'dd-mm-yy', changeYear: true, beforeShowDay: function(date){ //attach calendar to input with given specs
            day = date.getDay();
            return [days.indexOf(day) == -1] //if day in the calendar is also in the returned string, disable it
            //return [(day != 1 && day != 2)]; // this disables monday and tuesday
        }});	
    };
    
    function processAjaxData(data, urlPath){
     $('#dynamic-content').html(data);
     document.title = $('#drop  :selected').text(); //data.pageTitle;
     window.history.pushState({"html":data,"pageTitle":"Pickup List"},"", urlPath);
    }
    
    window.onpopstate = function(e){
        if(e.state){
            $('#dynamic-content').html(e.state.html);
            //document.title = e.state.pageTitle;
            PageURL = decodeURIComponent(window.location.search.substring(1));
            URLVars = PageURL.split('&');
            for (i = 0; i < URLVars.length; i++) {
                Parameter = URLVars[i].split('=');
                if (Parameter[0] === 'ex') {
                    //return Parameter[1] === undefined ? true : Parameter[1];
                    $('#drop').val(Parameter[1]);
                }
                else if(Parameter[0] === 'date'){
                    $('#datepicker').val(Parameter[1]);
                }
            }
            document.title = $('#drop  :selected').text();
    //        $('#drop').val();
    //        $('#datepicker').val();
            //this also has to change the excursion dropdown and date
        }
    };    
});
