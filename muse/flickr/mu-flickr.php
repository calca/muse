<?php

///////////////////////////////////////
// Private Functions

function loginToFlickr(){
	$key = $GLOBALS["MU_CONFIG"]["flickrKey"];
	if ( !empty($key) ){
		$flickr = new phpFlickr($key);
		$flickr->enableCache("fs",$GLOBALS["MU_CONFIG"]["MU_CACHE_DIR"]);
		return $flickr;
	}
	
	die("mu-flickr-photos :: loginToFlickr() key not configured");
}

function idFlickrUser($flickr){
	$id = $GLOBALS["MU_CONFIG"]["flickrID"];
	if ( empty($id) ){
		if ( !empty($GLOBALS["MU_CONFIG"]["flickrUser"]) ){
			$username = $GLOBALS["MU_CONFIG"]["flickrUser"];
			$res = $flickr->people_findByUsername($username);
			$GLOBALS["MU_CONFIG"]["flickrID"] = $res["nsid"];
		} else  {
			die("mu-flickr-photos :: idFlickUser() FlickrUser not set");
		}
	}
	return $GLOBALS["MU_CONFIG"]["flickrID"];
}

function infoFlickUser($flickr){
	$id = idFlickrUser($flickr);
	return $flickr->people_getInfo($id);
}

function list_photos_from_tag($flickr,$tag){
	$args[] = array();
	$args["tags"] = $tag;
	$args["user_id"] = idFlickrUser($flickr);
	$args["per_page"] = $GLOBALS["MU_CONFIG"]["maxPhotosForSlideshow"];
	$photosTag = $flickr->photos_search($args);
	return $photosTag["photo"];
}

function list_photos_from_setID($flickr,$setID){	
	$photoSet = $flickr->photosets_getPhotos($setID);
	return $photoSet["photo"];
}

function fullImageFromFlickr($flickr,$photoID){	
	$photo = $flickr->photos_getSizes($photoID);
	if ( !empty($photo['3'])){
		return $photo['3']['source'];
	}	
	return $photo['5']['source'];
}

function thumbImageFromFlickr($flickr,$photoID){
	$photo = $flickr->photos_getSizes($photoID);
	return $photo['0']['source'];
}

function urlImageFromFlickr($flickr,$photoID){
	$photo = $flickr->photos_getInfo($photoID);
	return $photo["urls"]["url"][0]["_content"];
}
?>
