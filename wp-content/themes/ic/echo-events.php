<?php
/**
 * Template Name: echo events
 
 
 */

  $query = new WP_Query( 
	array( 
		'post_type' => 'tribe_events',
		'eventDisplay' => 'upcoming', 
		'posts_per_page' => 4
		 ) 
	); 	
  $results = array();
  $key = 0;
  $img = 1;
  $replaceWords = array("/v=/i"); 


function getCoordinatesFromAddress( $sQuery, $sCountry = 'it' )
{
	$sURL = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($sQuery).'&sensor=false&region='.$sCountry.'&language='.$sCountry;
	$sData = file_get_contents($sURL);
	
	return json_decode($sData);
}


  if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); 

      if (get_post_meta ($post->ID, 'furu_youtube', $single = true) ) { 
    		$url = get_post_meta ($post->ID, 'furu_youtube', $single = true); 
    		$url = ($url) ? str_replace("watch?", "", $url) : ""; 
    		$url = ($url) ? preg_replace($replaceWords, "v/", $url): ""; 
  	  }
  	  
  	  $taxonomy = strip_tags( get_the_term_list($post->ID, 'loctype') );
  	
  	$postId = $post->ID;
  	
  	
  	
  	 $addressw = tribe_get_full_address([ $includeVenueName = false]);
  	 $addresser = trim(preg_replace('/\s\s+/', '', $addressw));
  	 $addressers = preg_replace('/<\/span>/', ' ', $addresser);
  	 $addressees = preg_replace('/<\/abbr>/', ' ', $addressers);
  	 
  	 $coords = getCoordinatesFromAddress('105 Covington Street , Panama City Beach , FL 32408 United States');
	 
	 $lat =  $coords->results[0]->geometry->location->lat;
	 $long =  $coords->results[0]->geometry->location->lng;
		
	  $fullco = $lat . ',' . $long;
  	  
  	  
  	  
  	  
  	  if(tribe_has_venue()) { 
  	  
  	  
  	  
  	  
  	  
  	  
  	  
  	  
  	  $results["places"][$key]["name"] = get_the_title();
  	  $results["places"][$key]["photo"] = sp_get_image();
  	  $results["places"][$key]["desc"] = get_the_excerpt();
  	  $results["places"][$key]["cater"] = 'events';
  	  $results["places"][$key]["coords"] =  $fullco;
  	  $results["places"][$key]["permalink"] = get_post_meta ($post->ID, 'cebo_outbound', $single = true);
  	  $results["places"][$key]["address"] =  get_post_meta ($post->ID, 'cebo_phone', $single = true);
  	  $results["places"][$key]["video"] = ($url != null) ? '<object style="height: 390px; width: 640px"><param name="movie" value="' . $url . '"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="' . $url . '" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="640" height="360"></object>' : null;
  	  $results["places"][$key]["deal"] =  get_post_meta ($post->ID, 'furu_hotdeal', $single = true);
  
  	  while($img <= 20) {
  	    if(sp_get_image($img)) {
  	      $results["places"][$key]["images"][$img]["src"] = sp_get_image($img);
  	      $img++;
  	    } else {
  	      break;
  	    }
  	  }	
  
  	  $key++;
  	  
  	  }

  endwhile; 
  endif;

  $returnJSON = json_encode($results);
  echo $returnJSON;
	