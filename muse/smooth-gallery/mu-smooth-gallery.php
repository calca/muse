<?php
function mu_smooth_gallery_header(){
	$path_sg = "/";
	$path_sg .= $GLOBALS["MU_CONFIG"]["MU_CONTENT_DIR"]."/libraries/SmoothGallery/";
	
	$html = "<script src=\"".$path_sg."scripts/mootools.v1.11.js\" type=\"text/javascript\"></script>\n";
	$html .="<script src=\"".$path_sg."scripts/jd.gallery.js\" type=\"text/javascript\"></script>\n";
	$html .="<link rel=\"stylesheet\" ";
	$html .= "href=\"".$path_sg."css/jd.gallery.css\" type=\"text/css\" media=\"screen\" />\n";
	$html .="<script type=\"text/javascript\">
			function startGallery() {
				var flickrGallery = 
				new gallery($('".$GLOBALS["MU_CONFIG"]["MU_FLICKR_PHOTO_DIV_ID"]."'), {
							timed: ".$GLOBALS["MU_CONFIG"]["galleryTimed"].",
							useThumbGenerator: false,
							thumbHeight: 75,
							thumbWidth: 75,
							showCarousel: ".$GLOBALS["MU_CONFIG"]["galleryShowCarousel"].",
							showInfopane: ".$GLOBALS["MU_CONFIG"]["galleryShowInfopane"].",
							embedLinks: ".$GLOBALS["MU_CONFIG"]["galleryEmbedLinks"].",
				});
			}
			window.addEvent('domready', startGallery);
		</script>\n";
	return $html;
}

?>
