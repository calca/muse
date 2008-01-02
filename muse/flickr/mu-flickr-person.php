<?php

function mu_flickr_person_buddy_icon(){
	$flickr = loginToFlickr();
	$user = infoFlickUser($flickr);
	$url="http://farm";
	if ( $user['iconfarm'] > 0 )
		$url .= $user['iconfarm'];
	$url .= ".static.flickr.com/";
	$url .= $user['iconserver'];
	$url .= "/buddyicons/";
	$url .= idFlickrUser($flickr);
	$url .= ".jpg";
	
	if ( is_valid_url($url) )
		return $url;

	// Standard buddy icon
	return "http://www.flickr.com/images/buddyicon.jpg"; 
}

function mu_flickr_person_realname(){
	init_mu_flickr_person_info();
	return $GLOBALS['MU_INFO_FLICK_USER']['realname'];
}

function mu_flickr_person_location(){
	init_mu_flickr_person_info();
	return $GLOBALS['MU_INFO_FLICK_USER']['location'];
}

function mu_flickr_person_photos_url(){
	init_mu_flickr_person_info();
	return $GLOBALS['MU_INFO_FLICK_USER']['photosurl'];
}

function mu_flickr_person_profile_url(){
	init_mu_flickr_person_info();
	return $GLOBALS['MU_INFO_FLICK_USER']['profileurl'];
}

////////////////////////////////////////////////////////////
// Private
function init_mu_flickr_person_info(){
	if ( isset($GLOBALS['MU_INFO_FLICK_USER']) )
		return;
		
	$flickr = loginToFlickr();
	$GLOBALS['MU_INFO_FLICK_USER'] = infoFlickUser($flickr);
}

function is_valid_url($url){
	$ch = curl_init();
	$timeout = 5; // set to zero for no timeout
	curl_setopt ($ch, CURLOPT_URL, 'http://example.com');
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch);
	curl_close($ch);

	if ( $file_contents )
		return true;
		
	return false;
}


?>
