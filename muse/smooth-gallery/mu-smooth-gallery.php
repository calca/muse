<?php
function mu_smooth_gallery_header(){
	$path_sg = $GLOBALS["MU_CONFIG"]["baseUrl"];
	$path_sg .= $GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]."/libraries/SmoothGallery/";
	
	$html = "<script src=\"".$path_sg."scripts/mootools.v1.11.js\" type=\"text/javascript\"></script>\n";
	$html .="<script src=\"".$path_sg."scripts/jd.gallery.js\" type=\"text/javascript\"></script>\n";
	$html .="<link rel=\"stylesheet\" ";
	$html .= "href=\"".$path_sg."css/jd.gallery.css\" type=\"text/css\" media=\"screen\" />\n";
	$html .="<script type=\"text/javascript\">\n";
	$html .="function startSmoothGallery() {\n";
	$html .="\tvar flickrGallery = ";
	$html .="new gallery($('".$GLOBALS["MU_CONFIG"]["MU_FLICKR_PHOTO_DIV_ID"]."'), {\n";
	$html .="\t\ttimed: ".$GLOBALS["MU_CONFIG"]["galleryTimed"].",\n";
	$html .="\t\tuseThumbGenerator: false,\n";
	$html .="\t\tthumbHeight: 75,\n";
	$html .="\t\tthumbWidth: 75,\n";
	$html .="\t\tshowCarousel: ".$GLOBALS["MU_CONFIG"]["galleryShowCarousel"].",\n";
	$html .="\t\tshowInfopane: ".$GLOBALS["MU_CONFIG"]["galleryShowInfopane"].",\n";
	$html .="\t\tembedLinks: ".$GLOBALS["MU_CONFIG"]["galleryEmbedLinks"].",\n";
	$html .="\t\t});\n";
	$html .="\t}\n";
	$html .="window.addEvent('domready', startSmoothGallery);\n";
	$html .="</script>\n";
	return $html;
}

?>
