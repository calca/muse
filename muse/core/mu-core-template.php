<?php

function mu_core_template_gallery_title(){
	return htmlentities($GLOBALS["MU_CONFIG"]["title"]);
}

function mu_core_template_get_file($file){
	$_load = mu_core_theme_dir().$file;				
	if ( is_file($_load)){	
		return "/".$_load;
	} else {
		return "mum_theme_get_file :: Failed to load $_load";
	}
}

function mu_core_template_credits(){
	$html = "<a href=\"http://blog.duea.info/muse\" />";
	$html .= "Muse Flickr Gallery";
	$html .=" </a>";
	return $html;
}

function mu_core_template_realname(){
	if ( !empty($GLOBALS["MU_CONFIG"]["realname"]) )
		return $GLOBALS["MU_CONFIG"]["realname"];
		
	return mu_flickr_person_realname();
}

function mu_core_template_email(){
 	if ( empty($GLOBALS["MU_CONFIG"]["email"]) )
 		return "";
 		
 	$html ="<a href=\"mailto:".$GLOBALS["MU_CONFIG"]["email"]."\">email</a>";
 	return $html;
}	

function mu_core_template_base_url(){
	$html = "<a href=\"".$GLOBALS["MU_CONFIG"]["baseUrl"]."\" >";
	$html .= "&laquo;";
	$html .= mu_core_template_gallery_title();
	$html .= "</a>";
	return $html;
}
?>
