<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include($root."/muse/core/mu-config.php");
include($root."/muse/core/mu-core-template.php");
include($root."/muse/core/mu-functions.php");
include($root."/muse/flickr/mu-flickr.php");
include($root."/muse/flickr/mu-flickr-person.php");
include($root."/muse/flickr/mu-flickr-photos.php");
include($root."/muse/smooth-gallery/mu-smooth-gallery.php");
include($root."/muse/blueprint/mu-blueprintcss.php");
include($root."/muse/mu-template.php");

function mu_init(){
	mu_core_select_page();
}

?>
