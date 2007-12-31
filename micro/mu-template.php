<?php

function mu_header(){
	mu_theme_import("header.php");
}

function mu_footer(){
	mu_theme_import("footer.php");
}

function mu_page(){
	include(mu_get_pagina());
}

function mu_page_get_file($file){

	$_load=mu_page_dir()."/".$file;
	if (is_file($_load) ){
		print("/".$_load);
	} else {
		print("mum_page_get_file:: Failed to load $file");
	}
	
	return;
}

function mu_theme_get_file($file){
	
		$_load = mu_theme_dir().$file;
				
		if ( is_file($_load)){	
			print ("/".$_load);
		} else {
			print ( "mum_theme_get_file :: Failed to load $file");
		}
		
		return ;
}



?>