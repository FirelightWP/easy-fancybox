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
	<p>
		<?php
			esc_html_e( 'BLACK FRIDAY SALE! 40% OFF Firelight Pro. Use coupon BF2024 at checkout!', 'easy-fancybox' );
			echo ' <a href="https://firelightwp.com/pro-lightbox?utm_source=pro-settings&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank" class="banner-button">' . esc_html__( 'Demos', 'easy-fancybox' ) . '</a>';
			echo ' <a href="https://firelightwp.com/pro-lightbox/pricing?utm_source=pro-settings&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank" class="banner-button">' . esc_html__( 'See Pricing', 'easy-fancybox' ) . '</a>';
		?>
	</p>
</div>

<img class="firelight-logo" src="<?php echo esc_url( easyFancyBox::$plugin_url ); ?>images/firelight-logo.png">
<div class="hero-section">
	<div class="hero-section-copy">
		<div>
			<p class="hero-section-copy-tag">
				<?php
					$has_lite_plan
						? esc_html_e( 'Upgrade to Pro!', 'easy-fancybox' )
						: esc_html_e( 'Firelight Pro - Free 7-Day Trial', 'easy-fancybox' )
				?>
			</p>
		</div>
		<h1 class="hero-section-copy-title"><?php esc_html_e( 'Make your website better.', 'easy-fancybox' ); ?></h1>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'New mobile-first Pro Lightbox with 100+ features!', 'easy-fancybox' ); ?></p>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'Social sharing, video galleries, EXIF display', 'easy-fancybox' ); ?></p>
		<?php if ( ! $has_lite_plan ) : ?>
			<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( '50+ more features for free lightboxes', 'easy-fancybox' ); ?></p>
			<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'Rockstar Pro support direct from devs', 'easy-fancybox' ); ?></p>
		<?php endif; ?>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'Better user experience = more engagement', 'easy-fancybox' ); ?></p>
		<div class="hero-section-actions">
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox/?utm_source=pro-landing&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank"><?php esc_html_e( 'See Demos', 'easy-fancybox' ); ?></a>
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox/pricing?utm_source=pro-landing&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank"><?php $has_lite_plan ? esc_html_e( 'Upgrade', 'easy-fancybox' ) : esc_html_e( 'Try It Free!', 'easy-fancybox' ); ?></a>
		</div>
		<?php if ( ! $has_lite_plan ) : ?>
			<p class="hero-section-copy-under-button"><?php esc_html_e( 'You can start your trial directly below!', 'easy-fancybox' ); ?></p>
		<?php endif; ?>
	</div>
	<div class="hero-section-image">
		<figure>
			<picture><img src="<?php echo esc_url( easyFancyBox::$plugin_url ); ?>images/device-mock.jpg" alt="Lightbox display across devices."></picture>
		</figure>
	</div>
</div>
<div class="pricing-section">
	<div class="pricing-header">
		<h2 class="pricing-headline"><?php $has_lite_plan ? esc_html_e( 'Upgrade to Pro!', 'easy-fancybox' ) : esc_html_e( '40% Off Black Friday Sale!', 'easy-fancybox' ); ?></h2>
		<?php if ( ! $has_lite_plan ) : ?>
			<h4 class="pricing-guarantee-2"><?php esc_html_e( 'Yes, all plans start with a 7-day free trial!', 'easy-fancybox' ); ?></h4>
			<h4 class="pricing-guarantee-2"><strong><?php esc_html_e( 'Lock in 40% OFF for Black Friday with coupon BF2024!', 'easy-fancybox' ); ?></strong></h4>
		<?php endif; ?>
	</div>
	<div class="pricing-table">
		<div class="plan <?php $has_lite_plan ? esc_attr_e( 'active', 'easy-fancybox' ) : ''; ?>">
			<h3 class="plan-title"><?php $has_lite_plan ? esc_html_e( 'Your Plan', 'easy-fancybox' ) : esc_html_e( 'Lite', 'easy-fancybox' ); ?></h3>
			<div class="plan-cost"><span class="plan-price">$39</span></div>
			<?php if ( ! $has_lite_plan ) : ?>
				<p class="sale"><?php esc_html_e( '7-day trial!', 'easy-fancybox' ); ?><br>
				<?php esc_html_e( 'No charge today.', 'easy-fancybox' ); ?></p>
			<?php endif; ?>
			<ul class="plan-features">
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BETTER BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( '50+ New Pro Features', 'easy-fancybox' ); ?></li>
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
			<?php if ( ! $has_lite_plan ) : ?>
				<div class="plan-select-dropdown">
					<select id="basic-licenses">
					<option value="1" selected="selected"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($39)</option>
					<option value="5"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($49)</option>
					<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($99)</option>
					</select>
				</div>
				<button id="basic-purchase" class="pro-action-button"><?php esc_html_e( 'Try It Free!', 'easy-fancybox' ); ?></button>
			<?php endif; ?>
			</div>
		</div>
		<div class="plan featured">
			<h3 class="plan-title">Pro +<span class="most-popular"><?php esc_html_e( 'Most Popular!', 'easy-fancybox' ); ?></span></h3>
			<div class="plan-cost"><span class="plan-price">$59</span></div>
			<?php if ( ! $has_lite_plan ) : ?>
				<p class="sale"><?php esc_html_e( '7-day trial!', 'easy-fancybox' ); ?><br>
				<?php esc_html_e( 'No charge today.', 'easy-fancybox' ); ?></p>
			<?php endif; ?>
			<ul class="plan-features">
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BETTER BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( '50+ New Pro Features', 'easy-fancybox' ); ?></li>
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
				<option value="1" selected="selected"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($59)</option>
				<option value="5"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($69)</option>
				<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($129)</option>
				</select>
			</div>
			<button id="pro-purchase" class="pro-action-button"><?php $has_lite_plan ? esc_html_e( 'Upgrade', 'easy-fancybox' ) : esc_html_e( 'Try It Free!', 'easy-fancybox' ); ?></button>
			</div>
		</div>
		<div class="plan">
			<h3 class="plan-title">Enterprise</h3>
			<div class="plan-cost"><span class="plan-price">$199</span></div>
			<?php if ( ! $has_lite_plan ) : ?>
				<p class="sale"><?php esc_html_e( '7-day trial!', 'easy-fancybox' ); ?><br>
				<?php esc_html_e( 'No charge today.', 'easy-fancybox' ); ?></p>
			<?php endif; ?>
			<ul class="plan-features">
			<li class="strong included"><?php esc_html_e( 'PRO SUPPORT', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'PLUGIN UPDATES', 'easy-fancybox' ); ?></li>
			<li class="strong included"><?php esc_html_e( 'BETTER BASIC LIGHTBOXES', 'easy-fancybox' ); ?></li>
			<li class="included"><?php esc_html_e( '50+ New Pro Features', 'easy-fancybox' ); ?></li>
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
				<option value="unlimited"><?php esc_html_e( 'Unlimited Sites', 'easy-fancybox' ); ?> ($199)</option>
				</select>
			</div>
			<button id="enterprise-purchase" class="pro-action-button"><?php $has_lite_plan ? esc_html_e( 'Upgrade', 'easy-fancybox' ) : esc_html_e( 'Try It Free!', 'easy-fancybox' ); ?></button>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<h4 class="lifetime-tip"><strong><?php esc_html_e( 'Tip: Click TRY IT FREE button to see lifetime plans.', 'easy-fancybox' ); ?></strong></h4>
</div>
			