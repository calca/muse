<?php
function mu_flickr_photo_set_list(){
	$flickr = loginToFlickr();
	// build list of sets
	$virtualPath = $GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"];
	$listOfSets = load_albums_xml_file();
	$html .= "\n<ul class=".$GLOBALS["MU_CONFIG"]["MU_CSS_LIST_SETS"].">\n";
	foreach($listOfSets as $set){
	$att = $set->attributes();
		if ( !empty($att["id"]) )
			$html .=  htmlentities(load_head_photoset_gallery($flickr,(string)$att["id"]));
		else if ( !empty($att["tags"]) )
			$html .=  htmlentities(load_head_tag_gallery($flickr,(string)$att["tags"],
				(string)$att["tagmode"]));
	}
	$html .= "\n</ul>\n";
	return $html;
}

function mu_flickr_photo_set_slideshow(){
	list($search, $tagmode) = find_search_parameters();
	$flickr = loginToFlickr();
	
	if ( is_numeric($search) )
		$listOfPhotos = list_photos_from_setID($flickr,$search);
	else if ( is_string($search) )
		$listOfPhotos = list_photos_from_tag($flickr,$search,$tagmode);
	
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

function mu_flickr_photo_set_title_slideshow(){
	list($search, $tagmode) = find_search_parameters();
	if ( is_numeric($search) ){
		$flickr = loginToFlickr();
		$infoSet = $flickr->photosets_getInfo($search);
		return htmlentities($infoSet['title']);
	}
	
	return firstTag($search);	
}

function  mu_flickr_photo_set_slideshow_navigator(){

	list($prevSet, $nextSet) =  find_prev_next_current_photo_set();
	
	if ( !empty($prevSet) ){
		$link_prev = "<a href=\"";
		$link_prev .= create_url_slideshow(tagsToUrl($prevSet["id"],$prevSet["tagmode"]));
		$link_prev .= "\"> &laquo; Prev Album";
		$link_prev .= "</a>";
	}
	if ( !empty($nextSet)  ){
		$set = $valori[$position+1];
		$link_next = "<a href=\"";
		$link_next .= create_url_slideshow(tagsToUrl($nextSet["id"],$nextSet["tagmode"]));
		$link_next .= "\">Next Album&raquo;";
		$link_next .= "</a>";
	}
	$html = $link_prev . " | " . $link_next;
	return $html;
}

///////////////////////////////////////
// Private Functions
function load_head_tag_gallery($flickr,$tags,$tagmode){
	$Photos = list_photos_from_tag($flickr,$tags,$tagmode,1);
	$firstPhoto = $Photos[0];
	return load_head_html_gallery($flickr,tagsToUrl($tags,$tagmode),
		$firstPhoto['id'],firstTag($tags));
}

function tagsToUrl($value,$tagMode){
	$tags = str_replace(",","/",strtolower($value));
	$tags .= "/".$tagMode;
	return $tags;
}

function firstTag($value){
	$tags = split(",",$value);
	if ( !empty($tags[0]) )
		$value = $tags[0];
	return ucfirst(strtolower($value));
}

function load_head_photoset_gallery($flickr,$setID){
	$infoSet = $flickr->photosets_getInfo($setID);
	return load_head_html_gallery($flickr,$setID,
			$infoSet['primary'],$infoSet['title'],$infoSet['description']);
}

function load_head_html_gallery($flickr,$id,$idImage,$title,$description = ""){
	$html .= "\n<li class=\"".$GLOBALS["MU_CONFIG"]["MU_CSS_SINGLE_SET"]."\">\n";	
	if ( $GLOBALS["MU_CONFIG"]["showThumbImageInPhotoSetList"] ){
		$html .= "<a href=\"".create_url_slideshow($id)."\">";
		$html .= "<img class=\"".$GLOBALS["MU_CONFIG"]["MU_CSS_THUMB_IMAGE_SET"]."\" ";
		$html .= "src=\"".thumbImageFromFlickr($flickr,$idImage)."\" />";
		$html .= "</a>\n";
	}
	$html .= "<a href=\"".create_url_slideshow($id)."\">";
	$html .= "<div class=\"".$GLOBALS["MU_CONFIG"]["MU_CSS_TITLE_SET"]."\">".htmlentities($title)."</div>\n";
	$html .= "</a>";
	if ( $GLOBALS["MU_CONFIG"]["showDescriptionInPhotoSetList"] )
		$html .= html_description($description);
	$html .= "</li>";
	return $html;
}

function create_url_slideshow($id){
	$urlBase = $GLOBALS["MU_CONFIG"]["baseUrl"];
	$virtualPath = $GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"];
	$url = $urlBase . $virtualPath . "/" . $id;
	return $url;
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
		$hmtl = "<div class=\"".$GLOBALS["MU_CONFIG"]["MU_CSS_DESCRIPTION_SET"]."\">";
		$html .= htmlentities($description);
		$html .= "</div>\n";
		return $html;
	}	
	return;
}

function find_search_parameters(){
	$urlParse = parse_url($_SERVER["REQUEST_URI"]);
	$urlPath = $urlParse["path"];
	$virtualPath = $GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"];
	$position = strpos($urlPath,$virtualPath);
	if ( $position < 0 ) die ("mu-flickr-photos :: find_search_parameters() No VirtualPath");

	$withoutVirtualPath = str_replace($virtualPath,"",$urlPath);	
	$withoutAny = str_replace("any","",trim($withoutVirtualPath,"/"));
	$withoutAll = str_replace("all","",trim($withoutAny,"/"));
	$res[] = str_replace("/",",",trim($withoutAll,"/"));
	
	if ( strpos($urlPath,"any") > 0 )
		$res[] = "any";
	else if ( strpos($urlPath,"all") > 0 )
		$res[] = "all";
	else
		$res[] = "";
		
	return $res;
}

function find_prev_next_current_photo_set(){
	list($search, $tagmode) = find_search_parameters();
	$listOfSets = load_albums_xml_file();
	$valori = array();
	$position = 0; $i = 0;
	foreach($listOfSets as $set){
		$att = $set->attributes();
		if ( !empty($att["id"]) )
			$valori[]  =  array( "id"=>(string)$att["id"], "tagmode"=>"");
		else if ( !empty($att["tags"]) )
			$valori[] = array( "id"=>(string)$att["tags"], "tagmode"=>(string)$att["tagmode"]);
		if ( $valori[$i]["id"] == $search )
			$position = $i;
		$i++;			
	}
	
	if ( $position > 0 ){
		$sets[] = $valori[$position-1];
	} else {
		$sets[] = "";
	}
	
	if ( $position < count($valori)-1 ){
		$sets[] = $valori[$position+1];
	} else {
		$sets[] = "";
	}
	return $sets;
}
?>
