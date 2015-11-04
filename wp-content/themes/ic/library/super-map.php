



<!-- Google Map API Files -->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
    $(document).ready(function() {

      /* Submit tweet */
      $('#twitter-form').submit(function(){  
          //setup variables  
          var form = $(this),  
          formData = form.serialize(),  
          formUrl = form.attr('action'),  
          formMethod = form.attr('method'),  
          responseMsg = $('#response')  

          //show response message - waiting  
          responseMsg.hide()  
                     .addClass('response-waiting')  
                     .text('Please Wait...')  
                     .fadeIn(200);  

             //send data to server for validation  
             $.ajax({  
                 url: formUrl,  
                 type: formMethod,  
                 data: formData,  
                 success:function(data){  
                     //setup variables  
                     var responseData = jQuery.parseJSON(data),  
                         klass = '';  

                     //response conditional  
                     switch(responseData.status){  
                         case 'error':  
                             klass = 'response-error';  
                         break;  
                         case 'success':  
                             klass = 'response-success';
                             $("#tweet").html("");
                         break;  
                     }  

                     //show reponse message  
                     responseMsg.fadeOut(200,function(){  
                         $(this).removeClass('response-waiting')  
                                .addClass(klass)  
                                .text(responseData.message)  
                                .fadeIn(200,function(){  
                                    //set timeout to hide response message  
                                    setTimeout(function(){  
                                        responseMsg.fadeOut(200,function(){  
                                            $(this).removeClass(klass);  
                                        });  
                                    },3000);  
                                 });  
                      });  
                   }  
             });

          //prevent form from submitting  
          return false;  
      })
      
     $("#infoBox").show();

      /* Hide Sidebar */
      $("a#controlbtn").click(function(e) {
      
        e.preventDefault();
        
        var slidepx=$("div#sidebar").width() + 10;
    	
    	if ($('div#sidebar').hasClass("open")) {
    	
    		margin = -280;
    		$('div#sidebar').removeClass("open");

    	} else {
    		margin = 0;
    		$("div#sidebar").addClass("open");
    	}
    	
        	$("div#sidebar").animate({ 
        		marginLeft: margin
      		}, {
                    duration: 'slow',
                    easing: 'easeOutQuint'
                });


      }); 

    });
</script>

	
	  			
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.4.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript">
    $(document).ready(function() {

       $("#infoBox").show();

      /* Hide Sidebar */
      $("#closePanelButton").click(function(e) {
      
        e.preventDefault();
        
        var slidepx=$("div#sidepanelWrapper").width() + 10;
    	
    	if ($('div#sidepanelWrapper').hasClass("open")) {
    	
    		right = -215;
    		$('div#sidepanelWrapper').removeClass("open");

    	} else {
    		right = 0;
    		$("div#sidepanelWrapper").addClass("open");
    	}
    	
        	$("div#sidepanelWrapper").animate({ 
        		right: right
      		}, {
                    duration: 'slow',
                    easing: 'easeOutQuint'
                });
                
			
      }); 

    });
</script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/gmap3new.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  
    var list = [];
    var i = 0; // Ordinal for locations.
    var locations = [];
    
    $("#clearMap").click(function(e) {
      clearMap();
      e.preventDefault();
    });
    
    $("#maparea").gmap3({
      marker:{
      	address:"<?php echo get_option('cebo_address'); ?>", data:"<?php bloginfo('name'); ?>", options:{icon:<?php if(get_option('cebo_mapmarker')) { ?>"<?php echo get_option('cebo_mapmarker'); ?>"<?php } else { ?>"http://maps.google.com/mapfiles/marker_green.png"<?php } ?>}
      },
      map: {
      action: 'init',
      options: {
          center:[<?php echo get_option('cebo_mapcenter'); ?>],
          scrollwheel: false,
          zoom: 14,
          mapTypeId: "style2",
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1", "style2"]
           }
         }   
    },
    
    styledmaptype:{
      id: "style1",
      options:{
        name: "Style 1"
      },
      styles: [
        {
          featureType: "road.highway",
          elementType: "geometry",
          stylers: [
            { hue: "#ff0022" },
            { saturation: 60 },
            { lightness: -20 }
          ]
        }
      ]
    }
  },
  { styledmaptype:{
      id: "style2",
      options:{
        name: "Style 2"
      },
      styles: [
        {
          featureType: "all",
    stylers: [
      { saturation: -80 }
    ]
  },{
    featureType: "road.arterial",
    elementType: "geometry",
    stylers: [
      { hue: "#00ffee" },
      { saturation: 50 }
    ]
  },{
    featureType: "poi.business",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
      ]
    }
  }
);
    
    getPlaces();
    
    $("#toggles li a").click(function(e) {
      e.preventDefault();
      clearMap();
    $("#toggles li a").removeClass("active");
      $(".placeData").hide(); 
        $(this).addClass("active");
        //alert("does not has");
        getPlaces();
      
    });
    
    $(".sidenav li a").attr("href", "").click(function(e) {
      clearMap();
      getLocations();
      var latlon = $(this).attr("rel");
      var latlonsplit = latlon.split(",");
      var pos = new google.maps.LatLng(latlonsplit[0], latlonsplit[1]);
      getTweets(latlonsplit[0], latlonsplit[1]);
      obLatLon = [latlonsplit[0], latlonsplit[1]];
      $("#maparea").gmap3({ 
          action: 'panTo',
          args: [pos],
          options: {
            zoom: 8, 
          }
        },  
        { 
          action: 'addOverlay',
          content: '<div class="location"><span>' + $(this).children("h1").html() + '</span></div>',
          latLng: obLatLon,
          offset:{
            y: -40,
            x:-30
          }
        }
      );
      e.preventDefault();
    });
    
    function getTweets(lat, lon) {
      $.getJSON(
        "<?php bloginfo('template_directory'); ?>/svc/cache.php?lat=" + lat + "&long=" + lon,
        function(data) {
          list = $.parseJSON(data);
          $("#maparea").gmap3("");
          $.each(data["tweets"], function(key, val){
            var latlon = [val["lat"], val["lon"]];
            $("#maparea").gmap3(
                { action: 'addMarker',
                  latLng: latlon,
                  map:{
                    center: false
                  }
                },
                { action:'addOverlay',
                  content:  '<div id="tweet' + val["tweet_id"] + '" class="marker"><img src="' + val["profile_image"] + '" class="tweetMarker" />' +
                            '<div class="tweet"><span>' + val["user"] + '</span><p>' + val["content"] + '</p><a class="retweet" href="#"></a><a class="mention" href="#"></a></div></div>', 
                  latLng: latlon,
                  offset:{
                    y: -40,
                    x:-30
                  }
                }
             );     
          });
        }
      );
      return;
    }



	$(".info").click(function() {
		$("#infoBox").toggle();
	});
	$(".twitterl a").click(function() {
		clearMap();
		$(".placeData").hide();
		getLocations();
	});      
      
      $("#maparea").mouseover(function(e) {

	$("a[rel='example1']").colorbox();
        $(".placeData .closeData").click(function() {
          $(".placeData").hide();  
        });

	$("#infoBox .closeData").click(function() {
          $("#infoBox").hide();  
        });

	$("#warning .closeData").click(function() {
          $("#warning").hide();  
        });
	$(".location").bind("click", function() {
		$(":contains(" + $(this).children("span").html() + ")").show();
		return;
	});


        $(".placeMark a").mouseover("click", function() {
          $(".placeData").hide();
          $("#placeData" + $(this).attr("rel")).show();
          e.preventDefault();
        }); 
        $("a.retweet").bind("click", function(e) {
          if ($(".signin").length > 0){
            $("#warning").show();
          } else {
            $("#tweet").html("");
            $("#ref").val("");
            name = $(this).parent().children("span").html();
            tweet = $(this).parent().children("p").html();
            status = "RT @" + name + " " + tweet;
            $("#tweet").html(status);
          }
          e.preventDefault();   
        });
        $("a.mention").bind("click", function(e) {
          if ($(".signin").length > 0){
            $("#warning").show();
          } else {
            $("#tweet").html("");
            $("#ref").val("");
            name = $(this).parent().children("span").html();
            tweet = $(this).parent().children("p").html();
            $("#tweet").html("@" + name);
          }
          e.preventDefault();
        });
      });
    
    function buildPlaceCarousel(obImages){
      var imageCarousel = '<div class="imageCarousel">';
      $.each(obImages, function(key, img) {
        imageCarousel += '<a href="' + img["src"] + '" rel="example1"><img src="' + img["src"] + '" />';
      });
      imageCarousel += '</div>';
      return imageCarousel;
    }
    
    function getPlaces() {
      $("#toggles li a.active").each(function() {
        getPlaceData($(this).attr("href"), $(this).parent().attr("class"));
      });
    }
    
    function getPlaceData(url, type) {
        $.getJSON(
         url,
         function(data) {
           list = $.parseJSON(data);
           $.each(data["places"], function(key, val){
             var docRoot = '<?php bloginfo ('template_url'); ?>';
             var coords = val["coords"].split(",", 2);
             var latlon = [coords[0], coords[1]];
             var goid = val["cater"];
             //var imgs = (val["images"] !== "undefined") ? '' : buildPlaceCarousel(val["images"]);
             var imgs = (val["images"] !== undefined) ? buildPlaceCarousel(val["images"]) : '';
            
             placeContainer = '<div class="placeData" id="placeData' + i + '"><p class="streetview">See it up close. Drag your streeview!</p><a href="#" class="closeData">X</a><div class="qualinfo"><a href="' + val["permalink"] + '"><img src="' + val["photo"] + '"/></a><div class="marco"><h4><span>' + val["name"] + '</span></h4><p class="smaller" id="' + val["cater"] + '">' + val["cater"] + '</p><p class="desc">' + val["desc"] + '</p></div></div><div class="specialinfo"><a href="' + val["permalink"] + '">More Info</a><a class="fac" href="http://www.facebook.com/sharer.php?s= 100&amp;p[title]=' + val["name"] + '&amp;p[url]=' + val["permalink"] + '&amp;p[images][0]=' + val["photo"] + '&amp;p[summary]=' + val["desc"] + '" target="_blank">Share It</a><a href="http://twitter.com/share?text=' + val["name"] + '&url=' + val["permalink"] + '"target="_blank">Tweet It</a><?php $perm = get_permalink(); $img = sp_get_image(); $regex = '/(?<!href=["\'])http:\/\//'; $regio = '/(?<!href=["\'])http:\/\//'; $perm = preg_replace($regio, '', $perm); $img = preg_replace($regex, '', $img); ?><a class="pin" href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2F<?php echo $perm; ?>&media=http%3A%2F%2F<?php echo $img; ?>&description=' + val["desc"] + ' on <?php bloginfo ('url'); ?>" target="_blank">Pin It</a></div>';
             
             $("#maparea").gmap3({ 
                 marker:{
				    latLng: latlon,
				    id: goid,
				    options:{
						draggable: false,
						icon : new google.maps.MarkerImage('yourImage.png')
					}
				  },
				  overlay:{
				    latLng: latlon,
				    options:{
				      content:  '<div id="mako" class="placeMark ' + type + '"><a target="_blank" rel="' + i + '" title="' + val["name"] + '"><p class="infobox"><i class="piccontainer" style="background-image: url(' + val["photo"] + ');"></i><span>'+ val["name"] +'</span><span class="info">'+ val["address"] +'<br>'+ val["phone"] +'<br>'+ val["distance"] +'</span><b class="monumental" id="' + val["cater"] + '">' + val["cater"] + '</b></p><small></small></a></div>',
				      offset:{
				         y: -12,
                   		 x: -15
				      }
				    }
				  }
                   }
              );
              $("body").append(placeContainer);
              i++;
           });
        }
      );
    }
    
    function getLocations(args) {
      $(".sidenav li a").each(function(e) {
        var latlon = $(this).attr("rel");
        var latlonsplit = latlon.split(",");
        getTweets(latlonsplit[0], latlonsplit[1]);
      });
    }
    
    function clearMap() {
        $("#maparea").gmap3('clear', 'markers');
	$(".placeData").hide();
  $("#maparea").gmap3({
      marker:{
        address:"<?php echo get_option('cebo_address'); ?>", data:"<?php bloginfo('name'); ?>", options:{icon:<?php if(get_option('cebo_mapmarker')) { ?>"<?php echo get_option('cebo_mapmarker'); ?>"<?php } else { ?>"http://maps.google.com/mapfiles/marker_green.png"<?php } ?>}
      },
      map: {
      action: 'init',
      options: {
          center:[<?php echo get_option('cebo_mapcenter'); ?>],
          scrollwheel: false,
          zoom: 14,
          mapTypeId: "style2",
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1", "style2"]
           }
         }   
    },
    
    styledmaptype:{
      id: "style1",
      options:{
        name: "Style 1"
      },
      styles: [
        {
          featureType: "road.highway",
          elementType: "geometry",
          stylers: [
            { hue: "#ff0022" },
            { saturation: 60 },
            { lightness: -20 }
          ]
        }
      ]
    }
  },
  { styledmaptype:{
      id: "style2",
      options:{
        name: "Style 2"
      },
      styles: [
        {
          featureType: "all",
    stylers: [
      { saturation: -80 }
    ]
  },{
    featureType: "road.arterial",
    elementType: "geometry",
    stylers: [
      { hue: "#00ffee" },
      { saturation: 50 }
    ]
  },{
    featureType: "poi.business",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
      ]
    }
  }
);
    }
    
    function wait() {
      // Just wait, buddy...  
    }
    		
		
	$(function() {
	
			$('.panelMenu li#linkerson').toggle(function(){
				$(this).addClass("active");
				$(this).next('.largebox').addClass("widest").animate({ right:'215px', opacity: 1 },{queue:false,duration:500});
			}, 
			function(){
				$(this).removeClass("active");
				$(this).next('.largebox').removeClass("widest", 500).animate({ right:'0px', opacity: 0 },{queue:false,duration:500});
			});
		});
	
		$(function() {
	
			$('.linkersonclose').click(function(){
				$('.panelMenu li#linkerson').removeClass("active");
				$('.largebox').removeClass("widest", 500).animate({ right:'0px', opacity: 0 },{queue:false,duration:500});
				
			});
		});
		
		// TOGGLE FUNCTION //
	$('#toggle-view li').click(function () {
        var text = $(this).children('div.panel');
        if (text.is(':hidden')) {
            text.slideDown('200');
            $(this).children('span').addClass('toggle-minus');     
            $(this).addClass('activated');     
        } else {
            text.slideUp('200');
			$(this).children('span').removeClass('toggle-minus'); 
            $(this).children('span').addClass('toggle-plus'); 
			$(this).removeClass('activated'); 			
        }
         
    });
    
    function scrollToAnchor(aid){
    var aTag = $("a[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
	}
	
	$("#link").click(function() {
	   scrollToAnchor('id3');
	});
		
  });

		
</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/basic.js"></script>
<!--
<script src="<?php bloginfo('template_url'); ?>/js/jquery.colorbox.js"></script>
	<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$("a[rel='example1']").colorbox();
			$("a[rel='example2']").colorbox({transition:"fade"});
			$("a[rel='example3']").colorbox({transition:"none", width:"75%", height:"75%"});
			$("a[rel='example4']").colorbox({slideshow:true});
			$(".example5").colorbox();
			$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
			$(".example7").colorbox({width:"80%", height:"80%", iframe:true});
			$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
			$(".example9").colorbox({
				onOpen:function(){ alert('onOpen: colorbox is about to open'); },
				onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
				onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
				onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
				onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
			});
			
			//Example of preserving a JavaScript event for inline calls.
			$("#click").click(function(){ 
				$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
	</script>
-->
	<!--[if lt IE 7 ]>
	<script src="js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->