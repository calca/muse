<?php
function mu_blueprintcss_header(){
	$path_bp = $GLOBALS["MU_CONFIG"]["baseUrl"];
	$path_bp .= $GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]."/libraries/Blueprint/";
	
	$html ="<link rel=\"stylesheet\" href=\"".$path_bp."blueprint/screen.css\" ";
	$html .="type=\"text/css\" media=\"screen, projection\">\n";
	$html .="<link rel=\"stylesheet\" href=\"".$path_bp."blueprint/print.css\" ";
	$html .="type=\"text/css\" media=\"print\">\n";
	$html .="<!--[if IE]><link rel=\"stylesheet\" href=\"".$path_bp."css/blueprint/lib/ie.css\" ";
	$html .="type=\"text/css\" media=\"screen, projection\"><![endif]-->";
	return $html;
}
?>
