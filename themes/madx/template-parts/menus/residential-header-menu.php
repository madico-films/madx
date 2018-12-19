<header id="page-header" class="site-header" role="banner">
	<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
		<div class="title-bar-left no-print">
			<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
			<span class="site-mobile-title title-bar-title">
				<a href="/residential" rel="home" class="menu-section-home-image"><?php bloginfo( 'template_directory' ); ?></a>
			</span>
		</div>
	</div>

	<nav class="site-navigation top-bar" role="navigation">
		<div class="top-bar-left">
			<div class="site-desktop-title top-bar-title no-print">
				<a href="/residential" rel="home"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/assets/images/l-residential-film.svg" alt="Madico The Clear Choice" class="menu-section-home-image"></a>
			</div>
		</div>
		<div class="top-bar-right">

			<?php foundationpress_residential_nav(); ?>
			
		</div>
	</nav>

</header>

<img src="<?php bloginfo( 'template_directory' ); ?>/dist/assets/images/blog-header-madico.png" alt="Madico The Clear Choice" class="logo-print" style="display:none">