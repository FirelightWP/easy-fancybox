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
<div class="hero-section short">
	<div class="hero-section-copy">
		<div>
			<p class="hero-section-copy-tag"><?php esc_html_e( 'Easy Fancybox Pro', 'easy-fancybox' ); ?></p>
		</div>
		<h1 class="hero-section-copy-title"><?php esc_html_e( 'Level up your lightbox.', 'easy-fancybox' ); ?></h1>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'Brilliant new Pro Lightbox.', 'easy-fancybox' ); ?></p>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'All Pro addons for free lightboxes.', 'easy-fancybox' ); ?></p>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'Rockstar Pro support.', 'easy-fancybox' ); ?></p>
		<p class="hero-section-copy-text"><span class="dashicons dashicons-arrow-right-alt"></span><?php esc_html_e( 'More engagement with your images and media.', 'easy-fancybox' ); ?></p>
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

<div class="pricing-section short">
	<img class="firelight-arrow" src="<?php echo esc_url( easyFancyBox::$plugin_url ); ?>images/arrow.png">
	<div class="pricing-header">
		<h2 class="pricing-headline"><?php esc_html_e( 'Simple Pricing – $79', 'easy-fancybox' ); ?></h2>
		<h4 class="pricing-guarantee-1"><?php esc_html_e( 'Plus 60-Day No-Questions-Asked Guarantee!', 'easy-fancybox' ); ?></h4>
		<h4 class="pricing-guarantee-2"><?php esc_html_e( 'Zero Risk! Just give it a try. If you’re not thrilled, let us know and get an immediate, full refund!', 'easy-fancybox' ); ?></h4>
	</div>
	<div class="plan-select">
		<div class="plan-select-dropdown">
			<select id="pro-licenses">
			<option value="1" selected="selected"><?php esc_html_e( '1 Site License', 'easy-fancybox' ); ?> ($79)</option>
			<option value="5"><?php esc_html_e( '5 Site License', 'easy-fancybox' ); ?> ($99)</option>
			<option value="25"><?php esc_html_e( '25 Site License', 'easy-fancybox' ); ?> ($179)</option>
			</select>
		</div>
		<button id="pro-purchase" class="pro-action-button"><?php esc_html_e( 'Buy Now', 'easy-fancybox' ); ?></button>
	</div>
	<p class="after-plan-sale"><?php esc_html_e( 'SALE: 30% OFF! ENDS THIS WEEK.', 'easy-fancybox' ); ?>
	<p class="after-plan-sale"><?php esc_html_e( 'Use Coupon Code PRO During Checkout.', 'easy-fancybox' ); ?>
	</p>
	<div style="clear:both;"></div>`
</div>
			