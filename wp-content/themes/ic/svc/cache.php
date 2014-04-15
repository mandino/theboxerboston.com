<?php  

  $returnData = Array();
  $user = Array();
  $i = 0;
  //  Miracle Strip (30.201816959816046, -85.84768295288086)
  $lat = (isset($_GET["lat"])) ? $_GET["lat"] :   30.2018169;
  $lon = (isset($_GET["long"])) ? $_GET["long"] : -85.8476829;
  $requestTime = date('YmdHi');                                 // Sets the time to the minute for this request.
  
  
  $cachedir = "cache/" . $requestTime . "/";                             // Sets the directory the cache will be stored i     
  $cachedsource = $cachedir . $lat . $long . "-cache.txt";                     // Build the cache file name
  //$source = (file_exists($cachedsource)) ? $cachedsource : 'http://search.twitter.com/search.json?q=&result_type=mixed&count=5&p=1&rpp=50&geocode=' . $lat . "," . $lon . ",1mi";
  $source = 'http://search.twitter.com/search.json?q=&result_type=mixed&count=5&p=1&rpp=50&geocode=' . $lat . "," . $lon . ",1mi";
  
  $cache = dirname(__FILE__) . "/" . $cachedsource;          
  $data = @file_get_contents($source);
  
  if (!file_exists($cache)) { 
    mkdir($cachedir, 0777);
    $cachefile = fopen($cache, 'wb');
    fwrite($cachefile,utf8_encode($data));  
    fclose($cachefile); //*/
  }
	$twitterData = json_decode($data);
  foreach($twitterData->results as $results) {
      $fakeLat = round($lat, 3) + (rand(0, 1000) * .00001);
      $fakeLon = round($lon, 3) + (rand(0, 1000) * .00001);
      
    //if ($results->geo != null) {
      
      $user[$results->from_user]["lat"] = ($user[$results->from_user]["lat"] != null) ? $user[$results->from_user]["lat"] : $fakeLat;
      $user[$results->from_user]["lon"] = ($user[$results->from_user]["lon"] != null) ? $user[$results->from_user]["lon"] : $fakeLon;
      $returnData["tweets"][$i]["tweet_id"] = $results->id_str;
      $returnData["tweets"][$i]["profile_image"] = $results->profile_image_url;
      $returnData["tweets"][$i]["user"] = $results->from_user;
      $returnData["tweets"][$i]["lat"] = ($results->geo != null) ? $results->geo->coordinates[0] : $user[$results->from_user]["lat"];
      $returnData["tweets"][$i]["lon"] = ($results->geo != null) ? $results->geo->coordinates[1] : $user[$results->from_user]["lon"];
      $returnData["tweets"][$i]["date"] = $results->created_at;
      $returnData["tweets"][$i]["content"] = $results->text;
      $i++;
   //}
  }
  
  $returnJSON = json_encode($returnData);
  
  echo $returnJSON;
  
?>