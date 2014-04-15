jQuery(document).ready(function(){
	$('#cform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="images/nivo-preloader.gif" class="contact-loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			name: $('#name').val(),
			email: $('#email').val(),
			subject: $('#subject').val(),
			emailer: $('#myemail').val(),
			comments: $('#comments').val()
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#cform img.contact-loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				if(data.match('success') != null) $('#cform').slideUp('slow');
			}
		);

		});

		return false;

	});
	
	$('#cforms').submit(function(){

		var action = $(this).attr('action');

		$("#messages").slideUp(750,function() {
		$('#messages').hide();

 		$('#submits')
			.after('<small>Loading&hellip;</small>')
			.attr('disabled','disabled');

		$.post(action, {
			names: $('#names').val(),
			emails: $('#emails').val(),
			subjects: $('#subjects').val(),
			emailers: $('#myemails').val(),
			commentss: $('#commentss').val()
		},
			function(data){
				document.getElementById('messages').innerHTML = data;
				$('#messages').slideDown('slow');
				$('#cforms img.contact-loader').fadeOut('slow',function(){$(this).remove()});
				$('#submits').removeAttr('disabled');
				if(data.match('success') != null) $('#cforms').slideUp('slow');
			}
		);

		});

		return false;

	});
		

});