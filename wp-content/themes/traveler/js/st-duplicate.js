jQuery(document).ready(function($) {
	var flag = false;
	$('button#st-duplicate-data').click(function(event) {
		/* Act on the event */
		var t = $(this);
		if(flag) return false;
		flag = true;

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'st_duplicate_ajax',
				name: 'st_allow_duplicate',
				security: st_duplicate_string.string
			},
			beforeSend: function(){
				$('#st-duplicate-data-wrapper .spinner').addClass('is-active');
				t.text('Waiting...');
			},
		})
		.done(function(data) {
			$('#st-duplicate-data-wrapper .spinner').removeClass('is-active');
			console.log(typeof data);
			if(typeof data != 'json' && data.status == 1){
				t.text('Run');
				$('#message').text(data.msg).addClass('text-updated').slideDown('500', function() {
					setTimeout(function(){
						$('#message').slideUp('500').removeClass('text-updated'); 
					}, 3000);
				});
			}else{
				t.text('Run');
				$('#message').text(data.msg).addClass('text-error').slideDown('500', function() {
					setTimeout(function(){
						$('#message').slideUp('500').removeClass('text-error'); 
					}, 3000);
				});
			}	
		})
		.fail(function(data, er) {
			console.log('error');
		})
		.always(function(){
			console.log("complete");
			flag = false;
		});
		return false;
	});
	
});