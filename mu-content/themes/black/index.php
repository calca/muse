<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php mu_header(); ?>
</head>
<body>
<div class="container span-22">
        <div class="column span-22">
               <h1 class="gallery_title"><?php mu_gallery_title(); ?></h1>
        </div>
        <div class="column span-16 append-1">
        	<div class="gallery_intro">
        	<a href="<?php mu_person_photos_url();?>">
                	<img src="<?php mu_person_buddy_icon(); ?>" /><br />
                </a>
		</div>
        </div>
        <div class="column span-5 last">
                <?php mu_photo_set_list(); ?>
        </div>  
	<?php mu_footer(); ?>
</div>
</body>
</html>		

