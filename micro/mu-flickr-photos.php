<?php

include($_SERVER["DOCUMENT_ROOT"]
	.$GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]
	."/libraries/phpFlickr/phpFlickr.php");

function mu_flickr_photo_set_list(){
	$flickr = loginToFlickr();
	// build list of sets
	$listOfSets = file($GLOBALS["MU_CONFIG"]["fileSets"]);
	$html = "\n<ul>";
	foreach($listOfSets as $set){
		$infoSet = $flickr->photosets_getInfo($set);
		$html .= "\n<li class=\"singleSet\">";	
		$html .= "<a href=\"set/".$set."\">";
		$html .= "<img class=\"thumbSet\" src=\"".thumbImageFromFlickr($flickr,$infoSet['primary'])."\" />";
		$html .= "</a>";
		$html .= "<a href=\"set/".$set."\">";
		$html .= "<div class=\"titleSet\">".htmlentities($infoSet['title'])."</div>";
		$html .= "</a>";
		$html .= thumbDescription($infoSet['description']);
		$html .= "</li>";
	}
	$html .= "\n</ul>\n";
	return $html;
}


function mu_flickr_photo_set_slideshow(){
	$url = split("/",rtrim($_SERVER["REQUEST_URI"],"/"));
	$setID = $url[count($url)-1];	
	$flickr = loginToFlickr();
	$photoSet = $flickr->photosets_getPhotos($setID);
	$listOfPhotos = $photoSet["photo"];
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

function fullImageFromFlickr($flickr,$photoID){	
	$photo = $flickr->photos_getSizes($photoID);
	if ( !empty($photo['3'])){
		return $photo['4']['source'];
	}	
	return $photo['5']['source'];
}

function thumbImageFromFlickr($flickr,$photoID){
	$photo = $flickr->photos_getSizes($photoID);
	return $photo['0']['source'];
}

function urlImageFromFlickr($flickr,$photoID){
	$photo = $flickr->photos_getInfo($photoID);
	var_dump($photo["urls"]["url"]);
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
