<?php  

  $returnData = Array();
  $i = 0;
  
  $lat = (isset($_GET["lat"])) ? $_GET["lat"] :   30.151823;
  $lon = (isset($_GET["long"])) ? $_GET["long"] : -85.659969;
  $requestTime = date('YmdHi');                                 // Sets the time to the minute for this request.
  
  
  $cachedir = "cache/" . $requestTime . "/";                             // Sets the directory the cache will be stored i     
  $cachedsource = $cachedir . $lat . $long . "-cache.txt";                     // Build the cache file name
  $source = (file_exists($cachedsource)) ? $cachedsource : 'http://search.twitter.com/search.json?q=&result_type=mixed&count=5&p=1&rpp=25&geocode=' . $lat . "," . $lon . ",1mi";
  
  $cache = dirname(__FILE__) . "/" . $cachedsource;          
  $data = file_get_contents($source);
  
  if (!file_exists($cache)) { 
    mkdir($cachedir, 0777);
    $cachefile = fopen($cache, 'wb');
    fwrite($cachefile,utf8_encode($data));  
    fclose($cachefile); //*/
  }
	$twitterData = json_decode($data);

  foreach($twitterData->results as $results) {
      $fakeLat = round($lat, 4) + (rand(100, 999) * .0001);
      $fakeLon = round($lon, 4) + (rand(100, 999) * .0001);
      
    //if ($results->geo != null) {
      $returnData["tweets"][$i]["tweet_id"] = $results->id;
      $returnData["tweets"][$i]["profile_image"] = $results->profile_image_url;
      $returnData["tweets"][$i]["user"] = $results->from_user;
      $returnData["tweets"][$i]["lat"] = ($results->geo != null) ? $results->geo->coordinates[0] : $fakeLat;
      $returnData["tweets"][$i]["lon"] = ($results->geo != null) ? $results->geo->coordinates[1] : $fakeLon;
      $returnData["tweets"][$i]["date"] = $results->created_at;
      $returnData["tweets"][$i]["content"] = $results->text;
      $i++;
   // }
  }
  
  $returnJSON = json_encode($returnData);
  
  echo $returnJSON;
  
?>