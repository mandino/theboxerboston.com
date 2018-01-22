
	var show_ticker = true;

	$(document).ready(function() {
			var xmlHttp;
			function srvTime(){
				try {
					xmlHttp = new XMLHttpRequest();
				} catch (err1) {
					//IE
					try {
						xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
					} catch (err2) {
						try {
							xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
						} catch (eerr3) {
							//AJAX not supported, use CPU time.
							alert("AJAX not supported");
						}
					}
				}
				xmlHttp.open('HEAD',window.location.href.toString(),false);
				xmlHttp.setRequestHeader("Content-Type", "text/html");
				xmlHttp.send('');
				return xmlHttp.getResponseHeader("Date");
			}


		jQuery(".close").click(function() {
			jQuery(".ticker").removeClass("show");
			show_ticker = false;
		});

		var time = new Date(srvTime()).getTime();
		jQuery(function() {

			if (document.getElementById('ticker') != null) {
				var countDownDate = new Date(document.getElementById('ticker').innerHTML).getTime();
				
				// Update the count down every 1 second
				var x = setInterval(function() {

					// Get todays date and time
					var now = time;
					time = time + 1000;
					// Find the distance between now an the count down date
					var distance = countDownDate - now;

					// Time calculations for days, hours, minutes and seconds
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);

					// Display the result in the element with id="ticker"
					if (days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0) {
						jQuery('.ticker').removeClass('show');
					} else {
						document.getElementById("ticker").innerHTML = "<div class='tick-days'><div>" + days + "</div><div class='tick-label'>Day/s</div></div><div class='tick-hours'><div>" + hours + "</div><div class='tick-label'>Hour/s</div></div><div class='tick-minutes'><div>"
						+ minutes + "</div><div class='tick-label'>Minute/s</div></div><div class='tick-seconds'><div>" + seconds + "</div><div class='tick-label'>Second/s</div></div><div class='clear'></div>";

						if (show_ticker == true) {
							jQuery('.ticker').addClass('show');
							jQuery('#ticker').css('display', 'block');
						}
					}
				}, 1000);
			}

		});
	});