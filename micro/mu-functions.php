<?php


function mu_get_pagina(){

	$_dir = mu_page_dir();
	$_url = $_SERVER["REQUEST_URI"];
	
	$_load = $_dir.$_url."index.php";
	if ( is_file($_load)) return $_load;

	$_load = $_dir.$_url."/"."index.php";
	if ( is_file($_load)) return $_load;

	$_load = $_dir.$_url.".php";
	if (is_file($_load))  return $_load;
		
	$_load = $_dir.rtrim($_url,"/").".php";
	if (is_file($_load)) return $_load;
	
	return $_dir."/404.php";
	
}
	
function mu_page_dir(){
		
		return MU_CONTENT."/".MU_PAGE_DIR;
		
		}

function mu_theme_dir(){
	
		return MU_CONTENT."/".MU_THEME_DIR."/".MU_THEME."/";
		
		}

function mu_theme_import($file){
	
		$_load = mu_theme_dir().$file;
				
		if ( is_file($_load)){	
			include($_load);
		} else {
			print ( "mum_theme_import :: Failed to load $file");
		}
		
		return ;
}
	


?>
