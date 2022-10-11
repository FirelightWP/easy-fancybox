<style type="text/css">
		div.main {
			width: 68%;
			float: left;
		}
		div.sidebar {
			width: 29%;
			padding: .9em 0 2em 2%;
			border-left: 1px solid #ccc;
			float: right;
			background: linear-gradient(to right, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%);
		}
		@media screen and (max-width: 600px) {
			div.main, div.sidebar {
				width: 100%;
				float: none;
				border: none;
				padding: 0
			}
		}
</style>

<div class="wrap">

	<h2>FancyBox</h2>

	<?php include EASY_FANCYBOX_DIR . '/views/settings-section-intro.php'; ?>

	<nav class="nav-tab-wrapper">
	<?php foreach ( $tabs as $tab => $title ) : if ( empty( $title ) ) continue; ?>
		<a class="nav-tab<?php echo $active_tab === $tab ? ' nav-tab-active' : '" href="?page=easy_fancybox&tab=' . $tab; ?>"><?php echo $title; ?></a>
	<?php endforeach; ?>
	</nav>

	<div class="main">
		<form method="post" action="options.php">

		<?php settings_fields( 'easy_fancybox_'.$active_tab ); ?>

		<?php do_settings_sections( 'easy_fancybox_'.$active_tab ); ?>

		<?php submit_button(); ?>
		</form>
	</div>

	<div class="sidebar"></div>
</div>
