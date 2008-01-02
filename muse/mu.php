<?php
include("core/mu-config.php");
include("core/mu-core-template.php");
include("core/mu-functions.php");
include("flickr/mu-flickr.php");
include("flickr/mu-flickr-person.php");
include("flickr/mu-flickr-photos.php");
include("smooth-gallery/mu-smooth-gallery.php");
include("blueprint/mu-blueprintcss.php");
include("mu-template.php");

function mu_init(){
	mu_core_select_page();
}

?>
