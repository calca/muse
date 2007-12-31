<?php

define (MU_CONTENT, "mu-content");
define (MU_THEME_DIR, "themes");
define (MU_PAGE_DIR, "pages");

define (MU_THEME,"black");

include("mu-functions.php");
include("mu-template.php");
include("mu-promo.php");

function mu_init(){
	mu_theme_import("index.php");
}

?>
