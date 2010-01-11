<?php
/////////////////////////////////////
// Muse Configuration
$GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"] =  "mu-content";
$GLOBALS["MU_CONFIG"]["MU_THEME_DIR"] =  "themes";
$GLOBALS["MU_CONFIG"]["MU_CACHE_DIR"] =  "cache";
$GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"] = "set";
// Template
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_INDEX_FILE"] = "index.php";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_PHOTOSET_FILE"] = "photoSet.php";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_HEADER_FILE"] = "header.php";
$GLOBALS["MU_CONFIG"]["MU_TEMPLATE_FOOTER_FILE"] = "footer.php";
$GLOBALS["MU_CONFIG"]["MU_FLICKR_PHOTO_DIV_ID"] = "flickrGallery";
// CSS
$GLOBALS["MU_CONFIG"]["MU_CSS_LIST_SETS"]= "mu_list_sets";
$GLOBALS["MU_CONFIG"]["MU_CSS_SINGLE_SET"]= "mu_single_set";
$GLOBALS["MU_CONFIG"]["MU_CSS_THUMB_IMAGE_SET"] = "mu_thumb_image_set";
$GLOBALS["MU_CONFIG"]["MU_CSS_TITLE_SET"] = "mu_title_set";
$GLOBALS["MU_CONFIG"]["MU_CSS_DESCRIPTION_SET"] = "mu_description_set";
// Info
$GLOBALS["MU_CONFIG"]["MU_NAME"] = "Muse Flickr Gallery";
$GLOBALS["MU_CONFIG"]["MU_VERSION"] = "1.0.1";
$GLOBALS["MU_CONFIG"]["MU_WEB_SITE"] = "http://blog.duea.info/projects/muse-flickr-gallery/";
////////////////////////////////////
$GLOBALS["MU_CONFIG"]["fileSets"] = "mu-config.xml";
///////////////////////////////////
load_xml_configuration();
//var_dump($GLOBALS["MU_CONFIG"]);
///////////////////////////////////
// Private function
function load_xml_configuration(){
	$file = $GLOBALS["MU_CONFIG"]["fileSets"];
	if ( $xml=@simplexml_load_file($file) )
	{
		$options = $xml->gallery;
		$GLOBALS["MU_CONFIG"]["baseUrl"] = formatBaseUrl((string)$options->baseUrl);
		$GLOBALS["MU_CONFIG"]["flickrKey"] = (string)$options->flickrKey;
		$GLOBALS["MU_CONFIG"]["flickrID"] = (string)$options->flickrID;
		$GLOBALS["MU_CONFIG"]["flickrUser"] = (string)$options->flickrUser;
		$GLOBALS["MU_CONFIG"]["realname"] = (string)$options->realname;
		$GLOBALS["MU_CONFIG"]["email"] = (string)$options->email;
		$GLOBALS["MU_CONFIG"]["maxPhotosForSlideshow"] = (string)$options->maxPhotosForSlideshow;
		$GLOBALS["MU_CONFIG"]["title"] = (string)$options->title;
		$GLOBALS["MU_CONFIG"]["theme"] = (string)$options->theme;
		$GLOBALS["MU_CONFIG"]["galleryTimed"] = (string)$options->galleryTimed;
		$GLOBALS["MU_CONFIG"]["galleryShowCarousel"] = (string)$options->galleryShowCarousel;
		$GLOBALS["MU_CONFIG"]["galleryShowInfopane"] = (string)$options->galleryShowInfopane;
		$GLOBALS["MU_CONFIG"]["galleryEmbedLinks"] = (string)$options->galleryEmbedLinks;
		$GLOBALS["MU_CONFIG"]["showThumbImageInPhotoSetList"] = 
			stringToBoolean((string)$options->showThumbImageInPhotoSetList);
		$GLOBALS["MU_CONFIG"]["showDescriptionInPhotoSetList"] = 
			stringToBoolean((string)$options->showDescriptionInPhotoSetList);
	} else {
		die("mu-config :: load_xml_configuration: could not load ".$file);
	}
}

function stringToBoolean($value){
	if ( strtoupper($value) === "TRUE" )
		return true;
		
	return false;
}

function formatBaseUrl($value){
	if ( empty($value) )
		die("mu-config :: formatBaseUrl() : baseUrl coul not empty");
		
	return	rtrim(rtrim($value),"/") ."/";
}
?>
