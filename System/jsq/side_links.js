$('#submenulist span').on('click', function(){
	if($(this).text() != 'Backup' && $(this).text() != 'Restore'){
		//e.preventDefault();
		link = $(this).text();
		pw = pwPopup(link);
		link = '';
	}
	else if ($(this).text() == 'Backup'){
		window.location.href = 'dbmanagement/backup.php';
	}
	else if ($(this).text() == 'Restore'){
		window.location.href = 'dbmanagement/restore.php';
	}
});

$('.hamburger').on('click', function(){
	if ($('.hamburger > span').hasClass('is-active')){
		$('.hamburger > span').removeClass('is-active');
		$('.select_table').removeClass('visible_right');//hides side menu
	} else {
		$('.hamburger > span').addClass('is-active');
		$('.select_table').addClass('visible_right');//shows side menu
	}
});
