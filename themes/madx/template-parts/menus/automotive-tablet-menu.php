<header id="page-header" class="site-header" role="banner">
	<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
		<div class="title-bar-left no-print">
			<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
			<span class="site-mobile-title title-bar-title">
				<a href="/automotive" rel="home" class="menu-section-home-image"><?php bloginfo( 'template_directory' ); ?></a>
			</span>
		</div>
	</div>

	<nav class="site-navigation top-bar" role="navigation">
		<div class="top-bar-left">
			<div class="site-desktop-title top-bar-title no-print">
				<a href="/automotive" class="no-print" rel="home"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/assets/images/l-automotive.svg" alt="Madico The Clear Choice" class="no-print menu-section-home-image"></a>
			</div>
		</div>
		<div class="top-bar-right tablet no-print">
			<ul class="dropdown menu" v-dropdown>
	      <li>
	        <a id="nav-drop">Menu &nbsp;<i class="fas fa-chevron-down"></i></a>
	        <?php foundationpress_auto_nav(); ?>
	      </li>
	    </ul>
		</div>
	</nav>

</header>