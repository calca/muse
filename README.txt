Muse Flirk Gallery

Muse Flickr Gallery use Flickr Services To
retrieve images from your Flickr Accounts and 
display nicely in your personal web site.
Muse Flickr Gallery is relased under GPL v3 
and was wrote by Gianluigi Calcaterra <gianluigi.calcaterra@gmail.com>

== Installation
1) Download last version
2) Unzip in you web-site
3) configure muse flicker gallery
4) edit template for more costumitation

== Configure 
Edit mu-config.xml

Section Gallery:
baseUrl:  Url Base of web site 
flickrKey: Flicker API Keys, http://www.flickr.com/services/api/keys/
flickrID: Flickr ID, http://idgettr.com/
flickrUser: Flickr Username
realname: Real Name to  show
email: email for contatcs
theme: Theme for Muse Flickr Gallery
title: Gallery Title
showThumbImageInPhotoSetList: Show Thumb Image In PhotoSet List true|false
showDescriptionInPhotoSetList: Show Description In PhotoSet List true|false
maxPhotosForSlideshow: Max number of photos for tag slideshows (max allowed 500)
galleryTimed: Gallery Timed true|false
galleryShowCarousel: Gallery Show Carousel true|false
galleryShowInfopane: Gallery Show Infopane true|false
galleryEmbedLinks Gallery Embed Links true|false

Section Albums
id of Flickr Set
<set id="72157594556245697" />  
 your tag
<set tags="newyork" />
your tags comma separated 
and tagmode: 
- all: for an AND combination
- any: for an OR combination of tags
Defaults to 'any' if not specified
<set tags="newyork,sky" tagmode="all"/> 

== Theme
Is possibile to customize Muse Flickr Gallery.
In mu-content/themes yuo can find themes and edit it.
There are many tags aviable:
(see it in muse/mu-template.php)

Function for Image Gallery
mu_gallery_title()
mu_photo_header()
mu_photo_set_list()
mu_photo_set_slideshow()
mu_photo_set_slideshow_navigator()
mu_photo_set_title_slideshow()
mu_photo_set_back_link_slideshow()

Function for Personal Info
mu_person_buddy_icon()
mu_person_realname()
mu_person_email()
mu_person_location()
mu_person_photos_url()
mu_person_profile_url()

Function for retrive file from template direcotry
mu_template_get_file($file)

== Libraries
Muse Flickr Gallery use external libs for build
web gallery:

- flickrAPI: http://phpflickr.com/
- SmoothGallery: http://smoothgallery.jondesign.net/what/
- BluePrintCss: http://code.google.com/p/blueprintcss/



