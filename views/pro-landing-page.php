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
	<p><?php esc_html_e( 'Easy Fancybox Pro is launched! Take 30% off this week - use code PRO at checkout.', 'easy-fancybox' ); ?></p>
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
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox/?utm_source=pro-landing&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank"><?php esc_html_e( 'Learn More', 'easy-fancybox' ); ?></a>
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox/?utm_source=pro-landing&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank"><?php esc_html_e( 'See Demos', 'easy-fancybox' ); ?></a>
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
    <div class="pricing-header">
		<h2 class="pricing-headline"><?php esc_html_e( 'Pricing', 'easy-fancybox' ); ?></h2>
		<h4 class="pricing-guarantee-1"><?php esc_html_e( '60-Day No-Questions-Asked Guarantee!', 'easy-fancybox' ); ?></h4>
		<h4 class="pricing-guarantee-2"><?php esc_html_e( 'Give it a try. If you’re not happy, let us know and get an immediate, full refund.', 'easy-fancybox' ); ?></h4>
	</div>
	<div class="pricing-table">
		<div class="plan">
			<h3 class="plan-title">Basic</h3>
			<div class="plan-cost"><span class="plan-price">$39</span></div>
			<ul class="plan-features">
			<li class="strong"><?php esc_html_e( 'Basic Lightboxes', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Legacy - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Reloaded - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'FancyBox2 - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="strong excluded"><?php esc_html_e( 'PRO LIGHTBOX', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( '100+ Customization Options', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Thumbnails in Lightbox', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Social Sharing for Images', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Deep Linking for Images', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Toolbar Controls', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Slideshow & Transitions', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Fullscreen Display', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Image Zooming', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Videos', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open PDFs', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Create Popups/Modals', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Inline Content', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Iframes', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Open Maps', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'NextGEN Gallery Integration', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Elementor Integration', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Perfect on Mobile Devices', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Performance Optimizations', 'easy-fancybox' ); ?></li>
			<li class="strong excluded"><?php esc_html_e( 'UNLIMITED SITES', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Unlimited Site License', 'easy-fancybox' ); ?></li>
			</ul>
			<div class="plan-select">
			<div class="plan-select-dropdown">
				<select id="basic-licenses">
				<option value="1" selected="selected"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($39)</option>
				<option value="5"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($49)</option>
				<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($99)</option>
				</select>
			</div>
			<button id="basic-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
			</div>
		</div>
		<div class="plan featured">
			<h3 class="plan-title">Pro<span class="most-popular"><?php esc_html_e( 'Most Popular!', 'easy-fancybox' ); ?></span></h3>
			<div class="plan-cost"><span class="plan-price">$69</span></div>
			<ul class="plan-features">
			<li class="strong"><?php esc_html_e( 'All Features', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Legacy - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Reloaded - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'FancyBox2 - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO LIGHTBOX', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( '100+ Customization Options', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Thumbnails in Lightbox', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Social Sharing for Images', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Deep Linking for Images', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Toolbar Controls', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Slideshow & Transitions', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Fullscreen Display', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Image Zooming', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Videos', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open PDFs', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Create Popups/Modals', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Inline Content', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Iframes', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Maps', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'NextGEN Gallery Integration', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Elementor Integration', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Perfect on Mobile Devices', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Performance Optimizations', 'easy-fancybox' ); ?></li>
			<li class="strong excluded"><?php esc_html_e( 'UNLIMITED SITES', 'easy-fancybox' ); ?></li>
			<li class="excluded"><?php esc_html_e( 'Unlimited Site License', 'easy-fancybox' ); ?></li>
			</ul>
			<div class="plan-select">
			<div class="plan-select-dropdown">
				<select id="pro-licenses">
				<option value="1" selected="selected"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($69)</option>
				<option value="5"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($79)</option>
				<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($149)</option>
				</select>
			</div>
			<button id="pro-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
			</div>
		</div>
		<div class="plan">
			<h3 class="plan-title">Enterprise</h3>
			<div class="plan-cost"><span class="plan-price">$399</span></div>
			<ul class="plan-features">
			<li class="strong"><?php esc_html_e( 'Unlimited Sites', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Legacy - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Reloaded - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'FancyBox2 - Pro Features', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PRO LIGHTBOX', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( '100+ Customization Options', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Thumbnails in Lightbox', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Social Sharing for Images', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Deep Linking for Images', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Toolbar Controls', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Slideshow & Transitions', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Fullscreen Display', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Image Zooming', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Videos', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open PDFs', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Create Popups/Modals', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Inline Content', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Iframes', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Open Maps', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'NextGEN Gallery Integration', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Elementor Integration', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Perfect on Mobile Devices', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Performance Optimizations', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'UNLIMITED SITES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( 'Unlimited Site License', 'easy-fancybox' ); ?></li>
			</ul>
			<div class="plan-select">
			<div class="plan-select-dropdown">
				<select id="enterprise-licenses">
				<option value="unlimited"><?php esc_html_e( 'Unlimited Sites', 'easy-fancybox' ); ?> ($399)</option>
				</select>
			</div>
			<button id="enterprise-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>`
</div>
			