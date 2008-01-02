<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php mu_header(); ?>
</head>
<body>
<div class="container span-22">
        <div class="column span-22">
        	<div class="gallery_slideshow_header" >
        	<div class="gallery_slide_show_back_link">
        	<?php mu_photo_set_back_link_slideshow(); ?></div>
        	<h1 class="gallery_slideshow_title"><?php mu_photo_set_title_slideshow() ?></h1>
        	</div>
        </div>
        <div class="column span-22">
		<?php mu_photo_set_slideshow(); ?>
        </div>
        <div class="column span-22">
                <div class="gallery_slideshow_navigator">
                <?php mu_photo_set_slideshow_navigator(); ?>
                </div>
        </div>  
	<?php mu_footer(); ?>
</div>
</body>
</html>
