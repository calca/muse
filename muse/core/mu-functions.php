<?php

function mu_core_select_page(){
	$_dir = mu_core_theme_dir();
	$_urlParse = parse_url($_SERVER["REQUEST_URI"]);
	$virtualPath = $GLOBALS["MU_CONFIG"]["MU_VIRTUAL_PATH_GALLERY"];	
	$xmlFile = $GLOBALS["MU_CONFIG"]["MU_XMLFILENAME"];
	
	if ( strpos($_urlParse["path"],$virtualPath) > 0 )
		return mu_core_load_photo_set();
	
	if ( empty($_urlParse["path"]) || $_urlParse["path"] == "/" )
		return mu_core_load_index_gallery();	
}
	
function mu_core_theme_dir(){
	return  $GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]
		."/".$GLOBALS["MU_CONFIG"]["MU_THEME_DIR"]
		."/".$GLOBALS["MU_CONFIG"]["theme"]."/";
}

function mu_core_theme_import($file){
	$_filePath = mu_core_theme_dir().$file;
	
	if ( is_file($_filePath) ){
		include($_filePath);
	} else {
		print("mu_theme_import :: Failed to load $_filePath");
	}
}
	
function mu_core_template_get_file($file){
	$_load = mu_core_theme_dir().$file;				
	if ( is_file($_load)){	
		return "/".$_load;
	} else {
		return "mum_theme_get_file :: Failed to load $_load";
	}
}

function mu_core_load_index_gallery(){
	mu_core_theme_import($GLOBALS["MU_CONFIG"]["MU_TEMPLATE_INDEX_FILE"]);
}

function mu_core_load_photo_set(){
	mu_core_theme_import($GLOBALS["MU_CONFIG"]["MU_TEMPLATE_PHOTOSET_FILE"]);
}

?>
