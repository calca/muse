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
	
	$html = "<div id=\"".$GLOBALS["MU_CONFIG"]["MU_FLICKR_PHOTO_DIV_ID"]."\" >\n";
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
function load_head_tag_gallery($flickr,$virtualPath,$tag){
	$showThumb = $GLOBALS["MU_CONFIG"]["showThumbImageInPhotoSetList"];
	$args[] = array();
	$args["tags"] = $tag;
	$args["user_id"] = idFlickrUser($flickr);	
	$args["per_page"] = 1;
	$photosTag = $flickr->photos_search($args);
		
	$firstPhoto = $photosTag["photo"][0];
	return load_head_html_gallery($flickr,$virtualPath,strtolower($tag),
		$firstPhoto['id'],ucfirst(strtolower($tag)));
}

function load_head_photoset_gallery($flickr,$virtualPath,$setID){
	$infoSet = $flickr->photosets_getInfo($setID);
	return load_head_html_gallery($flickr,$virtualPath,$setID,
			$infoSet['primary'],$infoSet['title'],$infoSet['description']);
}

function load_head_html_gallery($flickr,$virtualPath,$id,$idImage,$title,$description = ""){
	$html .= "\n<li class=\"singleSet\">";	
	if ( $GLOBALS["MU_CONFIG"]["showThumbImageInPhotoSetList"] ){
		$html .= "<a href=\"".$virtualPath."/".$id."\">";
		$html .= "<img class=\"thumbSet\" ";
		$html .= "src=\"".thumbImageFromFlickr($flickr,$idImage)."\" />";
		$html .= "</a>";
	}
	$html .= "<a href=\"".$virtualPath."/".$id."\">";
	$html .= "<div class=\"titleSet\">".htmlentities($title)."</div>";
	$html .= "</a>";
	$html .= html_description($description);
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

function html_description($description){
	if ( !empty($description) ){
		$hmtl = "<div class=\"descriptionSet\">";
		$html .= htmlentities($description);
		$html .= "</div>";
		return $html;
	}	
	return;
}
?>
