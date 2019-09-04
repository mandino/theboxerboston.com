<?php

if($_SERVER['ENV'] === 'production') {
	$robots_contents = 	"User-agent: * \r\n" .
						"Disallow: /wp-admin/ \r\n" .
						"Allow: /wp-admin/admin-ajax.php \r\n \r\n" .
						"sitemap: ". $_SERVER['WP_HOME'] ."/sitemap_index.xml";	
} else {
	$robots_contents = 	"User-agent: * \r\n" .
						"Disallow: *";
}

$robots = fopen("robots.txt", "w") or die("Unable to open file!");

if($robots) {
	fwrite($robots,$robots_contents);
	fclose($robots);
}