<?php
  //  Name:     Local Iterator
  //  Purpose:  Repeats remote service response locally for AJAX.
  
  class localIterator {
    
    public $RemoteURL = "";             //  The remote service
    
    public function __construct() {}
    
    public function buildQuery($lat = 0, $long = 0) {
      //  Example http://search.twitter.com/search.json?q=Twitter%20API
      //    &result_type=mixed
      //    &count=5
      //    &geocode=37.781157,-122.398720,.5mi
      
      $location = $lat . "," . $long . ",.5mi"
      
      $this->RemoteURL = "http://search.twitter.com/search.json?q=Twitter%20API";
      $this->RemoteURL .= "&geocode=" . $location;
      
    }
    
    private function pullData() {
      
      
      
    }
  }

?>