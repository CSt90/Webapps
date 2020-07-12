$('input[name=Hotel]').on('change', function(){
	hname = $('input[name=Hotel]').val();
    exc = $('#drop option:selected').text();
	$('#pp-btn').qtip({
		content: {
			text: function(event, api) {
				// This time, we return the deferred object, not a 'Loading...' message.
				$.ajax({
					url: 'fetchClosePpoints.php', // Use data-url attribute for the URL
					cache:false,
					data: {hname:hname, exc:exc}
				})
				.then(function(content) {
					api.set('content.text', content);
				}, function(xhr, status, error) {
					// Errors aren't handled by the library automatically, so
					// you'll need to call .set() upon failure, just as before.
					api.set('content.text', status + ': ' + error);
				});
			}
		},
		show: 'click',
		hide: 'click',
		style: {
			classes: 'qtip-bootstrap'
		},
		position: {
			my: 'top center',
			at: 'bottom center',
		}
	});
});

function setAsPpoint(ppoint){
	$('input[name=PPoint]').val(ppoint.text());
	$('input[name=PPoint]').focusout();
}
