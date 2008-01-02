<?php

function mu_gallery_title(){
 	print htmlentities($GLOBALS["MU_CONFIG"]["title"]);
}

function mu_photo_header(){
	print mu_smooth_gallery_header();
}

function mu_header(){
	print mu_core_theme_import($GLOBALS["MU_CONFIG"]["MU_TEMPLATE_HEADER_FILE"]);
}

function mu_footer(){
	print mu_core_theme_import($GLOBALS["MU_CONFIG"]["MU_TEMPLATE_FOOTER_FILE"]);
}

function mu_photo_set_list(){
	print mu_flickr_photo_set_list();
}

function mu_photo_set_slideshow(){
	print mu_flickr_photo_set_slideshow();
}

function mu_photo_person_buddy_icon(){
	print mu_flickr_person_buddy_icon();
}

function mu_person_realname(){
	print mu_flickr_person_realname();
}

function mu_person_location(){
	print mu_flickr_person_location();
}

function mu_person_photos_url(){
	print mu_flickr_person_photos_url();
}

function mu_person_profile_url(){
	print mu_flickr_person_profile_url();
}

function mu_template_get_file($file){
	print mu_core_template_get_file($file);
}
?>
