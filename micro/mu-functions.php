<?php

function mu_theme_select_page(){
	$_dir = mu_theme_dir();
	$_urlParse = parse_url($_SERVER["REQUEST_URI"]);
			
	if ( strpos($_urlParse["path"],'set') > 0 )
		return mu_load_photo_set();
	
	if ( empty($_urlParse["path"]) || $_urlParse["path"] == "/" )
		return mu_load_index_gallery();	
}
	
function mu_theme_dir(){
	return  $GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]
		."/".$GLOBALS["MU_CONFIG"]["MU_THEME_DIR"]
		."/".$GLOBALS["MU_CONFIG"]["theme"]."/";
}


function mu_theme_import($file){
	
	$_filePath = mu_theme_dir().$file;
	
	if ( is_file($_filePath) ){
		include($_filePath);
	} else {
		print("mu_theme_import :: Failed to load $_filePath");
	}
}
	

function mu_load_index_gallery(){
	mu_theme_import("index.php");
}

function mu_load_photo_set(){
	mu_theme_import("photoSet.php");
}

?>
