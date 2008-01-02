<?php
/////////////////////////////////////
// Muse Configuration
$GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"] =  "mu-content";
$GLOBALS["MU_CONFIG"]["MU_THEME_DIR"] =  "themes";
$GLOBALS["MU_CONFIG"]["MU_CACHE_DIR"] =  "cache";
$GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"] = "set";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_INDEX_FILE"] = "index.php";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_PHOTOSET_FILE"] = "photoSet.php";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_HEADER_FILE"] = "header.php";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_FOOTER_FILE"] = "footer.php";
$GLOBALS["MU_CONFIG"]["MU_FLICKR_PHOTO_DIV_ID"] = "flickrGallery";
////////////////////////////////////
$GLOBALS["MU_CONFIG"]["fileSets"] = "mu-config.xml";
///////////////////////////////////
load_xml_configuration();
///////////////////////////////////
// Private function
function load_xml_configuration(){
	$file = $GLOBALS["MU_CONFIG"]["fileSets"];
	$xml=simplexml_load_file($file);
	if ( $xml ){
		$options = $xml->gallery;
		$GLOBALS["MU_CONFIG"]["flickrKey"] = (string)$options->flickrKey;
		$GLOBALS["MU_CONFIG"]["flickrID"] = (string)$options->flickrID;
		$GLOBALS["MU_CONFIG"]["flickrUser"] = (string)$options->flickrUser;
		$GLOBALS["MU_CONFIG"]["maxPhotosForSlideshow"] = (string)$options->maxPhotosForSlideshow;
		$GLOBALS["MU_CONFIG"]["title"] = (string)$options->title;
		$GLOBALS["MU_CONFIG"]["theme"] = (string)$options->theme;
		$GLOBALS["MU_CONFIG"]["galleryTimed"] = (string)$options->galleryTimed;
		$GLOBALS["MU_CONFIG"]["showThumbImageInPhotoSetList"] = 
			stringToBoolean((string)$options->showThumbImageInPhotoSetList);
	} else {
		die("mu-config :: load_xml_configuration: could not load ".$file);
	}
}

function stringToBoolean($value){
	if ( strtoupper($value) === "TRUE" )
		return true;
		
	return false;
}
?>
