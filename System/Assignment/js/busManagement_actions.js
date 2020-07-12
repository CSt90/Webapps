//$(document).ready(function(){});
chclck = [0,0,0,0,0,0]; //change clicks
selclk = [0,0,0,0,0,0]; //select clicks
bbup = [0,0,0,0,0,0]; //backup array for the #buses div
prev=-1; //index pointer indicating previous value; n[0]->current, prev->previous
selected = []; //selected buses array; gets filled by pushing bus names
//previousContent = $('#filled-content').html();
if ($('.more').attr('class') == 'more disabledBtn')
	console.log('disabled');
else
	console.log('enabled');

// pending
// when select label is clicked, then check the box
// when nobus is clicked, uncheck all other boxes and vice versa


$('#gobtn').on('click', function(){
	exdate = $('#datepicker').val();
	previousContent = $('#filled-content').html();
	if (exdate!=null && $.trim(exdate)){
		$.ajax({
			url: 'excsOfDay.php',
			type: 'POST',
			cache: false,
			data: {exdate:exdate},
			success: function(data){
				resetAll();
				urlPath = 'busManagement.php?date='+exdate;
				//processAjaxData(previousContent, urlPath);
				//console.log(previousContent);
				positionData(data);
				cloneBuslist(bbup);
			}
		});
	}
	else{
		$('#msg').text('Select date first');
	}
});

$('.chng').on('click', function(){
	id = $(this).attr('id'); 
	if($(id).attr('class') != 'chng disabledBtn'){
		n = id.match(/\d+/)[0]; //get the id number of the clicked	
		if(chclck[n-1] == 0){ //click 'change'
			exc = $('#exc'+n).text(); //store current value
			b=bbup[n-1];
			$.ajax({
				url: 'getBuses.php',
				type: 'POST',
				cache: false,
				data: {exc:exc, date:exdate, idno:n, buses:b},
				success: function(data){
					console.log(data);
					if(prev!=n) //if user clicks another select box
						prev=restorePrevious(); //restore the previous section that was left with a select box
					$('#buses'+n).html(data); //otherwise, show the select box
					clksel = handleSelClk(selclk[n-1]);
					selclk[n-1] = clksel;
				}
			});
			chclck[n-1] = 1;
			$('#ch'+n).text('Done');
		}
		else if (chclck[n-1] == 1){
			//just check if the same buses are selected
			checkString= '';
			checkedBuses = [];		
			//doesn't care about the order in which they get selected
			//replicate how the string of selected buses would be
			//to check whether or not it is the same as the current string showing the selected buses
			$('.chkline input:checked').each(function(){
				checkString+='|'+($(this).attr('for'))+'|';
				checkedBuses.push($(this).attr('id'));
			});
			if (checkString == bbup[n-1] || checkString==''){
				$('#buses'+n).html(bbup[n-1]); //and if they are the same, just replace it
			}
			else{
				$.ajax({
					url: 'changeBuses.php',
					type: 'POST',
					cache: false,
					data: {exc:exc, date:exdate, idno:n, buses:checkedBuses},
					success: function(data){
						console.log(data);
						$('#buses'+n).html(data);
						bbup[n-1]=data;
					}
				});
			}
			chclck[n-1] = 0;
			$('#ch'+n).text('Change');
		}
	}
});

//this function puts the output elements from getBuses to their designated positions 
function positionData(data){
	d = jQuery.parseJSON(data);
	darr = [d.e1, d.e2, d.e3, d.e4, d.e5, d.e6];
	
	for(i=0;i<6;i++){
		if(darr[i][0]!='')
			$('#exc'+(i+1)).text(darr[i][0]);
		/* else if(darr[i][0]=="" || typeof darr[i][0]==undefined)
			$('#exc'+(i+1)).text('-'); */
		if(darr[i][1]!='')
			$('#buses'+(i+1)).text(darr[i][1]);
		if(darr[i][2]!='')
			$('#eng'+(i+1)).text(darr[i][2]);
		else if (darr[i][2]==0)
			$('#eng'+(i+1)).text('0');
		if(darr[i][3]!='')
			$('#de'+(i+1)).text(darr[i][3]);
		else if (darr[i][3]==0)
			$('#de'+(i+1)).text('0');
		if(darr[i][4]!='')
			$('#fr'+(i+1)).text(darr[i][4]);
		else if (darr[i][4]==0)
			$('#fr'+(i+1)).text('0');
		if(darr[i][5]!='')
			$('#ru'+(i+1)).text(darr[i][5]);
		else if (darr[i][5]==0)
			$('#ru'+(i+1)).text('0');
		if(darr[i][6]!='')
			$('#tot'+(i+1)).text(darr[i][6]);
		else if (darr[i][6]==0)
			$('#tot'+(i+1)).text('0');
		if($('#exc'+(i+1)).text() != '-'){
			$('#ch'+(i+1)).removeClass('disabledBtn');
			$('#more'+(i+1)).removeClass('disabledBtn');
		}
			
	} 
}

function handleSelClk(clk){
	$('.sel').on('click', function(){
		if (clk == 0){
			$('.chklist').show();
			//console.log(other);
			//console.log(this);
			clk = 1;
		}
		else{
			$('.chklist').hide();
			clk = 0;
		}
	});
	radioHandler();
	return clk;
}

//this function decides what happens with the radio 'nobus'
//when it gets clicked, the checked checkboxes become unchecked
//on the other hand, if the radio is active and any checkbox gets checked
//then the radio deactivates
function radioHandler(){
	$('input:radio[name=nobus]').click(function(){
		if ($(this).prop('checked')==true){
			$('.chkline input:checked').each(function(){
				$('.chkline input:checked').prop('checked', false);
				$('input:radio[name=nobus]').prop('checked', true);
			});
		}
	});
	//$(".chkline input:checkbox:checked").length
	$(".chkline input:checkbox").click(function(){
		if ($(".chkline input:checkbox:checked").length>0){
			$('input:radio[name=nobus]').prop('checked', false);
			console.log('done');
		}
	});
}

//creates a backup array of the current visual state of all 6 buses fields
function cloneBuslist(bbup){
	for(j=1;j<7;j++){
		bbup[(j-1)] = $('#buses'+j).html(); //bbup:0->5
	}
}

function restorePrevious(){
	//restore previous span
	$('#buses'+prev).html(bbup[prev-1]);
	//undo clicks that are registered as 1 for change and select
	chclck[prev-1]=0;
	$('#ch'+(prev)).text('Change');
	selclk[prev-1]=0;
	//console.log('current: '+n, 'prev: '+prev);
	return n;// current becomes previous, for the next possible change
}

function resetAll(){
	for (i=0; i<6;i++){
		$('#exc'+(i+1)).text('-');
		$('#buses'+(i+1)).text('-');
		$('#eng'+(i+1)).text('-');
		$('#de'+(i+1)).text('-');
		$('#fr'+(i+1)).text('-');
		$('#ru'+(i+1)).text('-');
		$('#tot'+(i+1)).text('-');
	}
	prev=-1;
	chclck = [0,0,0,0,0,0];
	$('.chng').text('Change');
	selclk = [0,0,0,0,0,0];
	bbup = [];
	drivers = '';
	guides = '';
	notes = '';
	morearr = [0, 0, 0];
	$('.chng').addClass('disabledBtn');
	$('.more').addClass('disabledBtn');
}

/* $('.more').on('click', function(){
	if (exdate = $('#datepicker').val()){
		moreID = $(this).attr('id');
		moreNo = moreID.slice(-1); //get the line number
		exc = $('#exc'+moreNo).text();
		exdate = $('#datepicker').val();
	}
}); */

$('.more').on('click', function(){
	if($('#datepicker').val()!=''){
		exdate = $('#datepicker').val();
		id = $(this).attr('id'); 
		n = id.slice(-1); //get the line number
		if ($('#more'+n).attr('class') != 'more disabledBtn'){
			excMore = $('#exc'+n).text();
			console.log('excursion '+ excMore + '\ndate '+exdate);
			$.ajax({
				url: 'getMore.php',
				type: 'POST',
				cache: false,
				data: {exc:excMore, date:exdate},
				success: function(data){
					m = jQuery.parseJSON(data);
					marr = [m.drv, m.gd];
					$('#drivers').val(m.drv);
					$('#guides').val(m.gd);
					$('#notes').val(m.not);
					$('#overlay').css('visibility', 'visible');
				}
			});
		}
	}
});

$('#moreClose').on('click', function(){
	if ($('#overlay').css('visibility') == 'visible'){
		$('#overlay').css('visibility', 'hidden');
		$('#successful-submission').css('visibility', 'hidden');
		$('#unsuccessful-submission').css('visibility', 'hidden');
	}
		
});

morearr = [0, 0, 0];
/* drvarr = [];
garr = []; */

//get the drivers typed in by the user; the commented part was used for separating each driver name into a string array
$('#drivers').on('change', function(){
	drivers = $.trim($('#drivers').val());
	//d = drivers.split(',');
	if(drivers != $.trim(m.drv)){
		/* k1 = 0;
		drvarr = [];
		for (i=0; i<d.length; i++){
			d[i] = $.trim(d[i]);
			drvarr[k1] = d[i];
			k1++;
		} */
		morearr[0] = 1;
	}
	else{
		drivers = ''; //drvarr = []
		morearr[0] = 0;
	}
});

//get the guides typed in by the user; the commented part was used for separating each guide name into a string array
$('#guides').on('change', function(){
	guides = $.trim($('#guides').val());
	//guides = $.trim($('#guides').val().split(', ').join(','));
	//g = guides.split(',');
	//k2 = 0;
	if(guides != $.trim(m.gd)){
		/* k2 = 0;
		garr = [];
		for (i=0; i<g.length; i++){
			g[i] = $.trim(g[i]);
			garr[k2] = g[i];
			k2++;
		} */
		morearr[1] = 1;
	}
	else{
		guides = ''; //garr = [];
		morearr[1] = 0;
	}
});

notes = '';
$('#notes').on('change', function(){
	if ($.trim($('#notes').val()) != m.not){
		morearr[2] = 1;
		notes = $('#notes').val();
	}
	else{
		notes = '';
		morearr[2] = 0;
	}
});


$('#submit-more-label').on('click', function(){
	/* console.log(garr);
	console.log(drvarr);
	console.log(notes); */
	console.log(morearr);
	$.ajax({
		url: 'addMore.php',
		type: 'POST',
		cache: false,
		data: {exc:excMore, date:exdate, drivers:drivers, guides:guides, notes:notes, changed:morearr}, //drivers:drvarr, guides:garr,
		success: function(data){
			console.log(data);
			if (data == 1){
				$('#successful-submission').css('visibility', 'visible');
				$('#unsuccessful-submission').css('visibility', 'hidden');
			}
			else{
				$('#unsuccessful-submission').css('visibility', 'visible');
				$('#successful-submission').css('visibility', 'hidden');
			}
			/* m = jQuery.parseJSON(data);
			marr = [m.drv, m.gd];
			$('#overlay').css('visibility', 'hidden'); */
		}
	});
});

/*********************************/
/* function processAjaxData(data, urlPath){
	 $('#filled-content').html(data);
	 //document.title = $('#drop  :selected').text(); //data.pageTitle;
	 window.history.pushState({"html":data,"pageTitle":"Bus Management"},"", urlPath);
	}

window.onpopstate = function(e){
	if(e.state){
		console.log(e.state.html);
		$('#filled-content').html(e.state.html);
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
//        $('#drop').val();
//        $('#datepicker').val();
		//this also has to change the excursion dropdown and date
	}
};  */
/*************************************/	