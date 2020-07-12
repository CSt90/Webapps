function editRes(row){
	which = row.index();
	resid = row.find('td > p').eq(0).text();
	console.log(resid);
	window.location = 'editReservation.php?resid='+resid;
}

function editShow(row){
	resid = row.find('td > p').eq(0).text();
	p = row.find('.c20 p')
	currshow = $.trim(p.text());
	$('td').removeAttr('id', 'edit');
	p.parent().attr('id', 'edit');
	$('td > p').attr('contentEditable', false);
	p.attr('contentEditable', true); //make p editable on double click. editable cell can cause p delete if empty and backspace is pressed
	p.focus();
	$(this).keypress(function(e){
		newshow = $.trim(p.text());
		if (e.which == 13){
			e.preventDefault();
			p.attr('contentEditable', false); //finished editing
			if (newshow == currshow || (newshow == 'x' && currshow == '✘')){
				p.parent().removeAttr('id', 'edit');
				p.text(currshow);
			}
			else{
				if (newshow == 'x'){
					$.ajax({
						url: 'updateShow.php',
						type: 'POST',
						cache: false,
						data: {resid: resid, noshow: newshow},
						success: function(data){
							console.log(data);
							if (data == 'Error'){
								alert('Wrong values. Try again');
								p.text(currshow);
							}
							else{
								p.parent().removeAttr('id', 'edit');
								p.text('✘');
							}
						}
					});
				}
				else{
					show = ' ';
					$.ajax({
						url: 'updateShow.php',
						type: 'POST',
						cache: false,
						data: {resid: resid, noshow: show},
						success: function(data){
							if (data == 'Error'){
								alert('Wrong values. Try again');
								p.text(currshow);
							}
							else{
								p.parent().removeAttr('id', 'edit');
								p.text('');
							}
						}
					});
					
				}
			}
		}
	});
}