=== Firelight Lightbox ===
Contributors: firelightwp
Tags: lightbox, gallery, image, photo, modal
Requires at least: 5.0
Requires PHP: 7.0
Tested up to: 6.7.1
Stable tag: 2.3.9
License: GPLv3

Formerly Easy Fancybox. The most popular WordPress lightbox plugin. Simple, fast, and responsive. Opens images, videos, PDFs, and custom popups.

== Description ==

**NEWS: Easy Fancybox is now Firelight Lightbox**. [Read about it here.](https://firelightwp.com/big-news-easy-fancybox-is-now-firelight-lightbox/)

Firelight Lightbox is the **most popular lighbox plugin for WordPress**, active on over 200,000 WordPress installations. It adds a lightweight and flexible lightbox for viewing images, video, and other media on your website.

After activation, links to images, galleries, videos, pdfs, maps, modals, etc, will open in a lightbox. Settings will be under 'Lightbox' on your main admin menu.

**QUICK LIGHTBOX DEMOS**

Demos for images, videos, PDFs, maps, and modals/popups:

**[Free Lightbox Demo](https://firelightwp.com/free-lightbox/)**  
**[Pro Lightbox Demo - Light Theme](https://firelightwp.com/pro-lightbox/)**  
**[Pro Lightbox Demo - Dark Theme](https://firelightwp.com/pro-lightbox-dark/)**  

**FREE LIGHTBOX FEATURES**
- Automatic detection of images
- Automatic detection of galleries
- Customize options for Lightbox appearance, style, and behavior
- Opens all common image formats including webp and svg
- Opens WordPress core galleries
- Opens videos from Youtube, Vimeo, and Dailmotion
- Opens PDF files (embed with object tag, iframe, external Google Docs Viewer)
- Opens NextGEN galleries ([instructions](https://firelightwp.com/wordpress-lightbox-docs/nextgen-gallery-and-easy-fancybox/))
- Opens content from external web pages ([instructions](https://firelightwp.com/wordpress-lightbox-docs/#web-pages))
- Create easy modals and popup boxes ([instructions](https://firelightwp.com/wordpress-lightbox-docs/#modal-window))
- Open image maps ([instructions](https://firelightwp.com/wordpress-lightbox-docs/image-maps-and-easy-fancybox/))
- Open lightbox from WordPress menu items ([instructions](https://firelightwp.com/wordpress-lightbox-docs/#menu-item-open))
- Support for Jetpack Infinite Scroll
- Support for WordPress Multsite (see Installation instructions)

Links:  
-> **[Demos](https://firelightwp.com/free-lightbox/)**  
-> **[Docs](https://firelightwp.com/wordpress-lightbox-docs)**  
-> **[Free Support](https://wordpress.org/support/plugin/easy-fancybox)**  

**PRO LIGHTBOX FEATURES**

Firelight Lightbox Pro is an extension for this lightbox plugin that offers:
- Dozens of Pro features for free lightboxes (Fancybox Legacy, Classic, V2)
- *Priority support direct from developers*
- *New and Powerful Pro Lighbox based on Fancybox 5, including:*
- Beautiful, modern full-browser and full-screen ligthbox
- 100+ customizations options
- Thumbnails within the lightbox
- Social sharing for images
- Link direct to images in the lightbox
- "Download image" button
- Toolbar with controls for thumbnails, social sharing, zoom, slideshow, etc
- Open videos
- Open PDFs
- Open popups
- Open inline content and iframes
- Open Google maps
- NextGEN Gallery integration
- Elementor integration
- Perfect on mobile devices
- Optimized lightbox speed

-> **[VIEW PRO LIGHTBOX DEMOS](https://firelightwp.com/pro-lightbox)**  
-> **[GET PRO SUPPORT](https://firelightwp.com/contact)**  

**GDPR / EU Privacy**

This plugin does not collect any data or set any browser cookies. The PRO version offers an option to disable the automatic popup after the first visit, which needs a browser cookie. This cookie stores the visitors first website visit timestamp and path on the client side. It is not shared nor is any data stored server side or elsewhere.

= Contribute =

If you're happy with this plugin, please consider writing a quick [rating](https://wordpress.org/support/plugin/easy-fancybox/reviews/#new-post), helping others in the [forum](https://wordpress.org/support/plugin/easy-fancybox), or [translating](https://translate.wordpress.org/projects/wp-plugins/easy-fancybox/).

= Known conflicts & issues =

See [Firelight Lightbox Troubleshooting](https://firelightwp.com/wordpress-lightbox-docs/troubleshooting-easy-fancybox/).

== Installation ==

Install like any other plugin. Search for 'lightbox' or 'firelight' or 'easy fancybox' from your WordPress admin plugin page. Or download the zip from this page, and upload the zip via your admin plugins page.

= Wordpress Multiste =

The plugin is compatible with multisite. You can enable the plugin network wide, or allow individual sites to activate it.

When activating the plugin per site, each site will have the Images media type activated and Firelight Lightbox will immediately try opening image links in the light box.

When activated network wide with **Network Activate**, each sub-site will _not_ have any media type activated. The options will be there for individual site admins, ready to either activate or leave deactivated.

== Screenshots ==

1. Open an image in the default lightbox.

2. Vimeo video in lightbox.

3. Youtube video in lightbox.

4. Open a modal in lightbox (modal created in block editor).

5. The Firelight Lightbox options panel (with Fancybox Classic selected).

== Changelog ==

= 2.3.9 =
* Fix: PHP notice on widget editor screen
* Add: Black Friday sale notice

= 2.3.8 =
* Fix: Remove translated strings from contructor

= 2.3.7 =
* Fix: Version error

= 2.3.6 =
* New: Github actions for deployment
* Updated: Pro landing and markup

= 2.3.5 =
* Update: Remove load_plugin_textdomain (WP 6.7 compatibility)

= 2.3.4 =
* Update: Improve sanitization of alt tags
* Update: Update minified JS files

= 2.3.3 =
* Update: Pro trial implementation

= 2.3.2 =
* Fix: Compatibility with older Pro versions

= 2.3.1 =
* Revert: Background scrolling fix on mobile IOS devices

= 2.3.0 =
* New: Change plugin name to Firelight Lightbox
* New: Added free trials for pro version
* Updated: Change style & behavior of options page
* Fix: 'nofancybox' not working fully for image blocks
* Fix: Background scrolling on mobile IOS devices

= 2.2.10 =
* Update: Pro landing page
* Update: Small code cleanup

= 2.2.8 =
* Update: Settings screen title
* Update: Refactor/fix how gallery grouping works
* Update: Email opt in for all users
* Fix: Save message on settings screen
* Fix: Vimeo player links for Fancybox2

= 2.2.7 =
* Skipped

= 2.2.6 =
* New: Modal for email opt ins
* Update: Apply code standards to some files
* Fix: "Automattically group images" setting issue

= 2.2.5 =
* New: Options to hide/close lightbox panel in block editor
* Update: Apply coding standards to fancybox-options.php
* Fix: wp_enqueue_script syntax error

= 2.2.4 =
* Fix: Adopt older wp_enqueue_script syntax

= 2.2.3 =
* Updated: Apply code standards to admin class
* Udpated: Raise compatible version of pro to 2.0.0

= 2.2.2 =
* Added: JavaScript build set up with wp-scripts
* Added: Lightbox panel in block editor
* Updated: Coding standard for main plugin file
* Updated: Coding standards for easyFancyBox class

= 2.2.1 =
* Updated: PHP coding standards to all view files
* Updated: Refine admin JS enqueuing
* Updated: Minor markup changes to admin pages

= 2.2.0 =
* Added: Pro landing page for re-launch of Pro
* Added: Optoin to disable core lightbox
* Updated: Refined styling / JS for options screen
* Updated: Default video width and height values
* Fixed: JS console error on admin dashboard
* Fixed: Lightbox buttons not working on mobile

= 2.1.9 =
* Added: Fancybox V2 option for retina displays

= 2.1.8 =
* Update: Check WordPress version before using some functions

= 2.1.7 =
* Update: Automattically open image blocks without links
* Update: Automattically open gallery blocks without links
* Update: Disable core lightbox when active
* Update: WordPress tested version to 6.5.3

= 2.1.6 =
* Update: Allow % width/height for PDFs
* Update: Increase review requests to 50% of users

= 2.1.4 =
* Update: Adjust review request, up to 20% of users
* Update: Update plugin banner and icon

= 2.1.3 =
* Update: Review request on dashboard, 10% of users

= 2.1.2 =
* Update: Review requests to 40% of users

= 2.1.1 =
* Added: Request plugin reviews (10% of users)

= 2.0.6 =
* Added: Fancybox2 transitions

= 2.0.5 =
* Fixed: Iframe width/height

= 2.0.4 =
* Fixed: Issues on new setting page

= 2.0.3 =
* Remove overlay background check

= 2.0.2 =
* Fixed overlay background settings

= 2.0.1 =
* Fixed some PHP errors

= 2.0 =
* Added new options screen
* Consolidate options for lightboxes
* Use Settings API for saving
* Remove unused files

= 1.9.9 =
* Added .jpeg to autodetect extensions
* Added plugin activation timestamp

= 1.9.8 =
* Removed unused scripts and files
* Updated WordPress required version to 5.0

= 1.9.7 =
* First small release by FirelightWP
* Updated author, readme, plugin meta

=1.9.6 =
* Updated author
* Updated links to new site

=1.9.5 =
* FIX: ARIA attributes
* FIX: jQuery.fn.click() shorthand deprecated

= 1.9.4 =
* FIX: Classic large content scroll
* FIX: Classic gallery overflow flicker
* FIX: Legacy float title position
* FIX: upgrade notice
* FIX: overlay opacity ignored (classic)
* FIX: onStart not a function (legacy)
* FIX: Passing event parameters failing
* FIX: Case insesitive selectors failing
* FIX: Admin message display issue

= 1.9 =
* NEW: Swipe support
* NEW: Optional fancyBox 2 or Legacy scripts
* Fixed background
* Dropped IE6-8 support
* Dropped SWF support (only availbale in Legacy)
* Accessibility improvements

= 1.8.19 =
* Admin settings links
* Pro compatibility message for VideoPress
* NEW: Exclude selector option
* FIX: border 0 ignored sometimes

= 1.8.18 =
* FIX: Jetpack Tiled Gallery block compatibility
* Don't include mousewheel script by default
* SECURITY: fixed failing color value sanitization + added inline styles output filter, issue reported by Jakob Hagl sba-research.org

= 1.8.17 =
* Pro compatibility messages
* Support forum link

= 1.8.16 =
* FIX: Trying to get property 'ID' of non-object
* mark WordPress 5.2 compatible

= 1.8.15 =
* FIX: inline wrapper nesting issue
* Revert to file names without version

= 1.8.13 =
* FIX: version constant issue
* Prepare Visual Composer Masonry Grid Gallery compatibility option

= 1.8.11 =
* FIX: Vimeo player direct links breaking

= 1.8.10 =
* Force default autoselector for galleries

= 1.8.9 =
* Prevent gallery next/prev links to show dud target
* FIX: allow youtube url parameters before v=

= 1.8.7 =
* Autoplay Youtube/Vimeo/Dailymotion
* FIX: Exclude Vimeo user pages from autodetect
* FIX: Exclude facebook/twitter share link
* FIX: PDF embed tag

= 1.8.6 =
* Gutenberg file block download button compatibility
* Gutenberg gallery block compatibility
* FIX: Missing argument in easyFancyBox::add_video_wmode_opaque()
* Remove version URL parameters
* FIX: jQuery 3+ e.indexOf is not a function

= 1.8.5 =
* FIX: prevent Inline content title

= 1.8.4 =
* Improved center on scroll behavior with title outside
* FIX: Pro options compatibility

= 1.8.3 =
* FIX: AutoScale option restored
* FIX: outline issue in Firefox
* Prevent SiteGround Optimizer warning about break outside loop

= 1.8.2 =
* FIX: main method not returning true in some cases
* Force all hosted video to https
* FIX: video iframe needs allow="autoplay" on modern browsers
* FIX: default enqueue priority not 10
* FIX: possible infinite loop in prev/next and image preloader
* Move main method (back) to init, position 9
* Introducing easy_fancybox_enqueue_scripts action hook

= 1.8 =
* NEW: Google Docs Viewer for PDF
* NEW: Youtube privacy-enhanced embed
* NEW: Compatibility options: late script inclusion, jquery exclusion, no wp_add_inline_script
* FancyBox: Improved mobile viewport height detection
* FancyBox: now skips subsequent double links in gallery
* FancyBox: new PDF content type
* FancyBox: improved error messages
* Dedicated IE8 stylesheet
* jQuery Easing update to 1.4.1

= 1.7 =
* NEW: Aspect ratio for video frames on smaller screens
* NEW: Global minimum screen size
* NEW: Loading icon for video/iframe content
* NEW: Resize light box on device orientation or browser window size change
* NEW: Modal window class and close button class
* FIX: pre PHP 5.4 compatibility
* FIX: iPhone iframe scrolling
* FIX: Autoptimize compatibility
* Switch to wp_add_inline_script() script printing, thanks @szepeviktor

= 1.6.3 =
* FIX: inline js minification incompatibility, thanks @alexiswilke

= 1.6.2 =
* FIX: line breaks hidden on options media admin page since WP 4.9, thanks @garrett-eclipse

= 1.6.1 =
* Nolightbox class in menu also for other media types than images
* FIX: CSS color code
* Spelling fixes, thanks @garrett-eclipse
* FIX: Pinterest button compatibility
* FIX: Double load plugin text domain

= 1.6 =
* Add webp to default Autodetect image types
* Exclude more rel attribute values from galleries
* BUGFIX: gallery preload
* Update jquery.easing.js and jquery.mousewheel.js

= 1.5.8.2 =
* BUGFIX: use dirname(__FILE__) instead of relying on __DIR__ to be available
* Explicit transparency for gallery navigation links

= 1.5.8 =
* FIX: variable variable php 7 compat
* FIX: obj undefined in minified js
* FIX: nofancybox in menu ignored, thanks Trishah
* Color value sanitize
* NEW: auto popup delay
* NEW: pro extension version compatibility check routine
* NEW: margin option
* NEW: iFrame alow full screen option
* Dropped mu-plugins support
* Added support for universal nolightbox class
* Set focus on iframe after load
* FIX: No center on scroll on touch devices
* FIX: Allow fullscreen videos

= 1.5.7 =
* FIX: Pro extension link update
* NEW: WebP support and class='image' to force image media type
* IE 6-8 css rules optional
* iframe embed for Youtube, Vimeo and Dailymotion
* Croation translation
* HTML5 players allowfullscreen default

= 1.5.6 =
* iPad positioning patch
* Don't unregister scripts that are not ours even for conflict prevention
* box-sizing: border-box issue in Firefox fixed
* Allow mousewheel scrolling page in the background again

= 1.5.5 =
* Prevent mousewheel scrolling page in the background
* New stylesheet IE alphaimageloader path fix approach
* Czech translation added
* Updated Indonesian translation

= 1.5.2 =
* BUGFIX: easy_fancybox_handler() in combo with trigger('click') causes Uncaught Exception script error

= 1.5.1 =
* FIX: jQuery 1.9+ compatibility
* Dropping support for gForms again -- "Cannot convert 'c' to object" error in combination with some older gForms version :(
* NEW: support for Infinite Scroll by Jetpack

= 1.5.0 =
* FIX: CSS3 box-sizing issue (Twenty Thirteen) misplacing close button
* NEW: Added SVG support. Thanks to Simon Maillard.
* Pre WP 3.6: jQuery 1.9+ compatibility
* JQuery Mousewheel extension update to 3.1.3
* NEW: Elegant Themes compatibility
* Some small Touch device compatibility improvement hacks to the 1.3.4 script
* Major plugin overhaul: Class implementation
* NEW: Disable hide on overlay click
* NEW: Allow automatic resizing to large image size set on Settings > Media during media upload via the hidden WordPress function media_upload_max_image_resize()
* NEW Options: iFrame scrolling, autoScale, key navigation/close, cyclic galleries
* Metadata custom parameters and Mousewheel gallery scrolling scripts optional
* Basic RTL languages/text direction support (gallery navigation inversion, title position)
* BUGFIX: https in stylesheet on Windows IIS
* Improved W3TC compatibility: query string issue
* Gravity Forms in ajax mode compatibility
* Use jQuery's bind('ready') for better ajax content compatibility
* Dynamic stylesheet response headers to allow browser caching
* Minified version of jquery.metadata.js
* Auto-detect on image map areas
* nolightbox class for menu items
* SECURITY: Settings sanitization
* BUGFIX: load_textdomain firing after the main settings array is loaded, leaving text strings in it untranslated.
* BUGFIX: missing signs in Youtube url regular expression
* BUGFIX: unquoted rel attribute selectors in jquery.fancybox-1.3.4.js
* BUGFIX: broken url path in IE stylesheet when missing $_SERVER['SERVER_NAME']
* BUGFIX: easing extension not needed on linear easing

= 1.3.4.9 =
* NEW: Lithuanian translation
* NEW: Hindi translation
* NEW: Indonesian translation
* NEW: Romanian translation
* NEW: Polish translation
* NEW: Spanish translation
* NEW: jQuery Metadata support
* NEW: Image map AREA support for all content types
* NEW: new iFrame/HTML5 embed code for YouTube, Vimeo and Dailymotion
* NEW: fix WordPress Dailymotion auto-embed code missing wmode
* Some changes to default settings
* Updated Dutch translation
* BUGFIX: Opening speed

= 1.3.4.8 =
* NEW: Advanced option: Gallery auto-rotation
* NEW: Spotlight effect
* Improved auto-enable and auto-gallery settings
* BIGFIX: CSS IE6 hack
* BIGFIX: PDF object in IE7

= 1.3.4.6 =
* PDF embed compatibility improvement
* NEW: Show/hide title on mouse hover action
* NEW: Auto-gallery modes (Disabled, page/post images only, all)
* NEW: Dailymotion support
* Links with id **fancybox-auto** will be triggered on page load
* Anything with class **fancybox-hidden"** will be hidden
* Support for menu items in iframe
* Added class **nofancybox** for exclusion when auto-enabling

= 1.3.4.5 =
* FancyBox script version 1.3.4 (2010/11/11 - http://fancybox.net/changelog/)
* NEW: Support for PDF
* NEW: Easing options
* YouTube, Vimeo and iFrame options adjustable
* lots and lots of more options!
* BIGFIX: work-around for missing wmode in WordPress (auto-)embedded movies (credits: Crantea Mihaita)

= 1.3.3.4.2 =
* BIGFIX: iframe width
* BIGFIX: image overlay size in Google Chrome browser issue (FancyBox 1.3.3)
* BIGFIX: fancybox-swf

= 1.3.3.4 =
* FancyBox script version 1.3.3 (2010/11/4 - http://fancybox.net/changelog/)
* Vimeo support
* YouTube Short URL support (disabled by default)
* Auto-recognition and seperate class `fancybox-youtube` for YouTube
* Auto-recognition and seperate class `fancybox-vimeo` for Vimeo

= 1.3.2 =
* FancyBox script version 1.3.2 (2010/10/10 - http://fancybox.net/changelog/)

= 1.3.1.3 =
* translation .pot file available
* Dutch translation
* NEW: YouTube and Flash movie support
* NEW: Iframe support
* added option Auto-enable for...

= 1.3.1.2 =
* added option titlePosition : over / inside / outside
* added option transitionIn : elastic / fade / none
* added option transitionOut : elastic / fade / none

= 1.3.1.1 =
* small jQuery speed improvement by chaining object calls

= 1.3.1 =
* Using FancyBox version 1.3.1
