<?php

function mu_header(){
	mu_theme_import("header.php");
}

function mu_footer(){
	mu_theme_import("footer.php");
}

function mu_photo_set_list(){
	print mu_flickr_photo_set_list();
}

function mu_photo_set_slideshow(){
	print mu_flickr_photo_set_slideshow();
}

function mu_theme_get_file($file){
	
	$_load = mu_theme_dir().$file;
				
	if ( is_file($_load)){	
		print ("/".$_load);
	} else {
		print ( "mum_theme_get_file :: Failed to load $_load");
	}
}



?>
