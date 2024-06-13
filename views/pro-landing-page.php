<?php
/**
 * View: Easy Fancybox Pro landing page.
 *
 * @package Easy_FancyBox
 * @author FirelightWP
 * @copyright Copyright (c) 2023, FirelightWP
 * @license GPL-2.0+
 *
 * This file generates the landing page for the Pro version of the plugin.
 *
 * @version 1.0.1
 */

?>

<div class="sale-banner">
	<p><?php esc_html_e( '40% off sale this week! Use code LAUNCH at checkout.', 'easy-fancybox' ); ?></p>
</div>
<img class="firelight-logo" src="<?php echo esc_url( easyFancyBox::$plugin_url ); ?>images/firelight-logo.png">
<div class="hero-section">
	<div class="hero-section-copy">
		<div>
			<p class="hero-section-copy-tag"><?php esc_html_e( 'Easy Fancybox Pro', 'easy-fancybox' ); ?></p>
		</div>
		<h1 class="hero-section-copy-title"><?php esc_html_e( 'Make your media a highlight of your website.', 'easy-fancybox' ); ?></h1>
		<p class="hero-section-copy-text"><?php esc_html_e( 'Add Pro features for free lightboxes - Legacy, Reloaded, V2. Or level up with the brilliant new FancyBox 5 Pro Lightbox. Supports images, pdfs, video, maps, modals with custom content, and more.', 'easy-fancybox' ); ?></p>
		<div class="hero-section-actions">
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox/" target="_blank"><?php esc_html_e( 'Learn More', 'easy-fancybox' ); ?></a>
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox" target="_blank"><?php esc_html_e( 'See Demos', 'easy-fancybox' ); ?></a>
		</div>
		<p class="hero-section-copy-under-button"><?php esc_html_e( 'Or buy directly from the WordPress dashboard below!', 'easy-fancybox' ); ?></p>
	</div>
	<div class="hero-section-image">
		<figure>
			<picture><img src="<?php echo esc_url( easyFancyBox::$plugin_url ); ?>images/device-mock.jpg" alt="Lightbox display across devices."></picture>
		</figure>
	</div>
</div>
<div class="pricing-section">
	<div class="pricing-table">
		<div class="plan">
			<h3 class="plan-title">Basic</h3>
			<div class="plan-cost"><span class="plan-price">$59</span></div>
			<ul class="plan-features">
			<li class="strong"><?php esc_html_e( 'Basic Lightboxes', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Legacy - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Reloaded - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'FancyBox2 - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="strong excluded"><?php esc_html_e( 'PRO LIGHTBOX', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'All Customization Options', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Thumbnails in Lightbox', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Toolbar Controls', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Slidesshow & Transitions', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Fullscreen', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Image Zooming', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Video', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open PDFs', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Create Modals/Popups', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Inline Content', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Iframes', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Maps', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Performance Optimizations', 'easy-fancybox' ); ?></li>
			<li class="strong excluded"><?php esc_html_e( 'UNLIMITED', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Unlimited Site License', 'easy-fancybox' ); ?></li>
			</ul>
			<div class="plan-select">
			<div class="plan-select-dropdown">
				<select id="basic-licenses">
				<option value="1"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($49)'</option>
				<option value="5" selected="selected"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($59)</option>
				<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($139)</option>
				</select>
			</div>
			<button id="basic-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
			</div>
		</div>
		<div class="plan featured">
			<h3 class="plan-title">Pro<span class="most-popular"><?php esc_html_e( 'Most Popular!', 'easy-fancybox' ); ?></span></h3>
			<div class="plan-cost"><span class="plan-price">$99</span></div>
			<ul class="plan-features">
			<li class="strong"><?php esc_html_e( 'All Features', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Legacy - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Reloaded - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'FancyBox2 - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO LIGHTBOX', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'All Customization Options', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Thumbnails in Lightbox', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Toolbar Controls', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Slidesshow & Transitions', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Fullscreen', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Image Zooming', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Video', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open PDFs', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Create Modals/Popups', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Inline Content', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Iframes', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Maps', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Performance Optimizations', 'easy-fancybox' ); ?></li>
			<li class="strong excluded"><?php esc_html_e( 'UNLIMITED', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Unlimited Site License', 'easy-fancybox' ); ?></li>
			</ul>
			<div class="plan-select">
			<div class="plan-select-dropdown">
				<select id="pro-licenses">
				<option value="1"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($79)</option>
				<option value="5" selected="selected"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($99)</option>
				<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($179)</option>
				</select>
			</div>
			<button id="pro-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
			</div>
		</div>
		<div class="plan">
			<h3 class="plan-title">Enterprise</h3>
			<div class="plan-cost"><span class="plan-price">$499</span></div>
			<ul class="plan-features">
			<li class="strong"><?php esc_html_e( 'Unlimited Sites', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Legacy - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Reloaded - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'FancyBox2 - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO LIGHTBOX', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'All Customization Options', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Thumbnails in Lightbox', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Toolbar Controls', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Slidesshow & Transitions', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Fullscreen', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Image Zooming', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Video', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open PDFs', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Create Modals/Popups', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Inline Content', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Iframes', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Maps', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Performance Optimizations', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'UNLIMITED', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Unlimited Site License', 'easy-fancybox' ); ?></li>
			</ul>
			<div class="plan-select">
			<div class="plan-select-dropdown">
				<select id="enterprise-licenses">
				<option value="unlimited"><?php esc_html_e( 'Unlimited Sites', 'easy-fancybox' ); ?> ($499)</option>
				</select>
			</div>
			<button id="enterprise-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>`
</div>
			