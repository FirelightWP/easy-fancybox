=== Easy FancyBox ===
Contributors: RavanH
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number=1%2e3%2e1&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us
Tags: fancybox, jquery, images, lightbox, gallery, image overlay, youtube, vimeo
Requires at least: 2.7
Tested up to: 3.0.1
Stable tag: 1.3.3.4

Easily enable the FancyBox 1.3.3 jQuery extension on all image, SWF, YouTube and Vimeo links. Multi-Site compatible and supports iFrame and Flash movies in overlay viewport.

== Description ==

No options to be set. No configuration pages. It just gives you FancyBox-in-a-Box for all links to image (.jpg/.bmp/.gif/.png) _and_ Flash movie (.swf) files. Easy FancyBox uses the packed FancyBox jQuery extension, is WP 3.0 Multi-Site compatible and supports iFrame and Flash movies -including YouTube and others- in an overlay.

See the [Screenshot](http://wordpress.org/extend/plugins/easy-fancybox/screenshots/) and you know how images will be presented on your site as soon as you have installed and (network) activated this simple plugin.

See [FAQ's](http://wordpress.org/extend/plugins/easy-fancybox/faq/) for instructions to get YouTube and Vimeo movies (and similar services) and HTML content display in a FancyBox overlay.

Looking for some basic control? You can find a new section **FancyBox** on your **Settings > Media** admin page:

- *Auto-enable*: file types FancyBox should be automatically enabled for.
- *Auto-detect*: control auto-detection and enabling for links to YouTube and Vimeo movies.
- *Title Position*: Overlay / Inside / Outside to control the position of the image title. Includes the new "Overlay" position.
- *Transition In / Out*: Elastic / Fade / None to control the transition effects during opening and closing of the overlay.

Visit [FancyBox](http://fancybox.net/) for more information, examples and the Support Forum. Please consider a DONATION to the FancyBox project.

= Translations =

- **Dutch** * Author: [R.A. van Hagen](http://4visions.nl)

== Installation ==

= Wordpress =

Quick installation: [Install now](http://coveredwebservices.com/wp-plugin-install/?plugin=easy-fancybox) !

 &hellip; OR &hellip;

Search for "easy fancybox" and install with that slick **Plugins > Add New** back-end page.

 &hellip; OR &hellip;

Follow these steps:

 1. Download archive.

 2. Upload the zip file via the Plugins > Add New > Upload page &hellip; OR &hellip; unpack and upload with your favourite FTP client to the /plugins/ folder.

 3. Activate the plugin on the Plug-ins page.

Done! Check your sparkling new FancyBoxed images :)

Not happy with the default settings? Check out the new options under **Settings > Media**.

= WordPress 3+ in Multi Site mode =

Same as above but do a **Network Activate** to activate FancyBox image overlays on each site on your network.

= Wordpress MU =

The plugin works best from the **/mu-plugins/** folder where it runs quietly in the background without bothering any blog owner with new options or the need for special knowledge about FancyBox. Just upload the complete package content to /mu-plugins/ and move the file fancybox.php from the new /mu-plugins/easy-fancybox/ to /mu-plugins/.

== Frequently Asked Questions ==

= What's FancyBox? =

Basically, it is a fancy way of presenting images on your website. If you have scaled-down images in your posts which are linked to the original large version, instead of opening them in a blanc page, FancyBox opens those in a smooth overlay. Visit [FancyBox](http://fancybox.net/) for more information and examples. 

= Why EASY FancyBox? =

Instead of bothering you with the HUGE amount of configuration options that FancyBox can handle, this plugin requires NO configuration. Easy, isn't it? ;)

If you *do* want configuration options to tweak and fiddle for days, check out some of the other FancyBox plugins available.

= Which version of FancyBox does this plugin use? =

The same version as this plugin has. I aim to keep close pace to FancyBox upgrades and always move to the latest and greates version. Please, let me know if I'm lagging behind and missed an upgrade!

= Where is the settings page? =

There is no new settings page but there are a few options you can change. You will find a new **FancyBox** section on **Settings > Media**. To see the default, check out the example under [Screenshots](http://wordpress.org/extend/plugins/easy-fancybox/) ...

= Will a WordPress generated gallery be displayed in a FancyBox overlay? =

Yes, but _only_ if you used the option **Link thumbnails to: Image File** when inserting the gallery!

= Can I display web pages or HTML files in a FancyBox overlay? =

Yes. Place a link with either `class="fancybox-iframe"` or `class="fancybox iframe"` (notice the space instead of the hyphen) to any web page or .htm(l) file in your content. 

NOTE: The difference between these two classes (- or space) is in size of the overlay viewport. Try it out and use the one that works best :)

= Can I play SWF files in a FancyBox overlay? =

Yes. Just place a link _with the URL ending in .swf_ to your Flash file in the page content.

If you do not have **swf** included in the *Auto-enable* option on Settings > Media admin page, you will need to add either `class="fancybox"` or `class="fancybox-swf"` (to force swf content recognition) to the link to enable FancyBox for it.

= Can I play YouTube and Vimeo movies in a FancyBox overlay? =

Yes. 

For YouTube, just place a link to the YouTube page in your content. If you have disabled Auto-detection, use it with `class="fancybox-youtube"` to manually enable FancyBox for it. (Note: For shortened YouTube URLs, the class does not work. Auto auto-detection needs to be enabled seperately.)

For Vimeo, just place a link to the Vimeo page in your content. If you have disabled Auto-detection, use it with `class="fancybox-vimeo"` to manually enable FancyBox for it.

These are actually a special case of SWF files. The URL for these movies do not end in .swf so the FancyBox script will not be able to auto-detect the Flash content. This can be forced with `class="fancybox-youtube"`, `class="fancybox-swf"` or alternatively `class="fancybox-iframe"`. The difference between the three are mainly in transition effect and size of the overlay viewport. Just choose the one that works best for you or...

Just let the plugin auto-detect and auto-enable it for you :)

= Is Easy FancyBox multi-site compatible? =

Yes. Designed to work with **Network Activate** and does not require manual activation on each site in your network. You can even install it in mu-plugins: upload the complete /easy-fancybox/ directory to /wp-content/mu-plugins/ and move the file easy-fancybox.php one dir up.

== Screenshots ==

1. Example image with **Overlay** caption. This is the default way Easy FancyBox displays images. Other options are **Inside** and the old **Outside**.

2. Example of a YouTube movie in overlay.

== Upgrade Notice ==

= 1.3.3.5 =
Quick fix for image overlay size in Google Chrome browser issue in FancyBox 1.3.3

== Changelog ==

= 1.3.3.5 =
* Fix for image overlay size in Google Chrome browser issue in FancyBox 1.3.3

= 1.3.3.4 =
* upgraded FancyBox script to version 1.3.3 (2010/11/4 - http://fancybox.net/changelog/)
* Vimeo support
* YouTube Short URL support (disabled by default)
* Auto-recognition and seperate class `fancybox-youtube` for YouTube
* Auto-recognition and seperate class `fancybox-vimeo` for Vimeo

= 1.3.2 =
* upgraded FancyBox script to version 1.3.2 (2010/10/10 - http://fancybox.net/changelog/)

= 1.3.1.3 =
* translation .pot file available
* Dutch translation
* YouTube and Flash movie support
* Iframe support
* added option Auto-enable for...

= 1.3.1.2 =
* added option titlePosition : over / inside / outside
* added option transitionIn : elastic / fade / none
* added option transitionOut : elastic / fade / none

= 1.3.1.1 =
* small jQuery speed improvement by chaining object calls

= 1.3.1 =
* Using FancyBox version 1.3.1
