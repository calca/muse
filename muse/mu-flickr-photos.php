<?php

include($_SERVER["DOCUMENT_ROOT"]
	.$GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]
	."/libraries/phpFlickr/phpFlickr.php");

function mu_flickr_photo_set_list(){
	$flickr = loginToFlickr();
	// build list of sets
	$virtualPath = $GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"];
	$listOfSets = load_albums_xml_file();
	foreach($listOfSets as $set){
	$att = $set->attributes();
		if ( !empty($att["id"]) )
			$html .=  load_head_photoset_gallery($flickr,$virtualPath,(string)$att["id"]);
		else if ( !empty($att["tag"]) )
			$html .=  load_head_tag_gallery($flickr,$virtualPath,(string)$att["tag"]);
	}
	$html .= "\n</ul>\n";
	return $html;
}

function mu_flickr_photo_set_slideshow(){
	$url = split("/",rtrim($_SERVER["REQUEST_URI"],"/"));
	$search = $url[count($url)-1];

	$flickr = loginToFlickr();
	
	if ( is_numeric($search) )
		$listOfPhotos = list_photos_from_setID($flickr,$search);
	else if ( is_string($search) )
		$listOfPhotos = list_photos_from_tag($flickr,$search);
	
	if ( count($listOfPhotos) <= 0 ) return "No photos aviable";
	
	$html = "<div id=\"flickrGallery\" >\n";
	foreach($listOfPhotos as $photo){
		//var_dump($photo);
		$html .= "<div class=\"imageElement\">\n";
		$html .= "<h3>".htmlentities($photo['title'])."</h3>\n";
		$html .= "<p>".htmlentities($photo['description'])."</p>\n";
		$html .= "<a href=\"".urlImageFromFlickr($flickr,$photo['id'])."\" ";
		$html .= "title=\"open image\" class=\"open\"></a>";
		$html .= "<img src=\"".fullImageFromFlickr($flickr,$photo['id'])."\" class=\"full\" />\n";
		$html .= "<img src=\"".thumbImageFromFlickr($flickr,$photo['id'])."\" class=\"thumbnail\" />\n";
		$html .= "</div>";
	}
	$html .= "</div>\n";
	return $html;
}


///////////////////////////////////////
// Private Functions

function loginToFlickr(){
	$key = $GLOBALS["MU_CONFIG"]["flickrKey"];
	if ( !empty($key) ){
		$flickr = new phpFlickr($key);
		$flickr->enableCache("fs",$GLOBALS["MU_CONFIG"]["MU_CACHE_DIR"]);
		return $flickr;
	}
	
	die("mu-flickr-photos :: loginToFlickr() key not configures");
}

function idFlickrUser($flickr){
	$id = $GLOBALS["MU_CONFIG"]["flickrID"];
	if ( empty($id) ){
		$username = $GLOBALS["MU_CONFIG"]["flickrUser"];
		$res = $flickr->people_findByUsername($username);
		$GLOBALS["MU_CONFIG"]["flickrID"] = $res["nsid"];
	}
	return $GLOBALS["MU_CONFIG"]["flickrID"];
}

function load_head_tag_gallery($flickr,$virtualPath,$tag){
	$args[] = array();
	$args["tags"] = $tag;
	$args["user_id"] = idFlickrUser($flickr);	
	$args["per_page"] = 1;
	$photosTag = $flickr->photos_search($args);
		
	$firtPhoto = $photosTag["photo"][0];
	$html .= "\n<li class=\"singleSet\">";	
	$html .= "<a href=\"".$virtualPath."/".strtolower($tag)."\">";
	$html .= "<img class=\"thumbSet\" ";
	$html .= "src=\"".thumbImageFromFlickr($flickr,$firtPhoto['id'])."\" />";
	$html .= "</a>";
	$html .= "<a href=\"".$virtualPath."/".strtolower($tag)."\">";
	$html .= "<div class=\"titleSet\">".htmlentities(ucfirst(strtolower($tag)))."</div>";
	$html .= "</a>";
	$html .= thumbDescription($infoSet['description']);
	$html .= "</li>";
	return $html;
}

function load_head_photoset_gallery($flickr,$virtualPath,$setID){
	$infoSet = $flickr->photosets_getInfo($setID);
	$html .= "\n<li class=\"singleSet\">";	
	$html .= "<a href=\"".$virtualPath."/".$setID."\">";
	$html .= "<img class=\"thumbSet\" ";
	$html .= "src=\"".thumbImageFromFlickr($flickr,$infoSet['primary'])."\" />";
	$html .= "</a>";
	$html .= "<a href=\"".$virtualPath."/".$set."\">";
	$html .= "<div class=\"titleSet\">".htmlentities($infoSet['title'])."</div>";
	$html .= "</a>";
	$html .= thumbDescription($infoSet['description']);
	$html .= "</li>";
	return $html;
}

function load_albums_xml_file(){
	$file = $GLOBALS["MU_CONFIG"]["fileSets"];
	$xml=simplexml_load_file($file);
	if ( $xml ){
		return $xml->albums->set;
	} else {
		die("mu-flickr-photos :: load_albums_xml_file: could not load ".$file);
	}
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

function thumbDescription($description){
	if ( !empty($description) ){
		$hmtl = "<div class=\"descriptionSet\">";
		$html .= htmlentities($description);
		$html .= "</div>";
		return $html;
	}	
	return;
}
?>
