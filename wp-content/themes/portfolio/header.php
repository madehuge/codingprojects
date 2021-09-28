<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage galussothemes
 * @since galussothemes 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<?php endif; ?>
	<?php wp_head(); 	?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<!-- Head Top -->
	<div class='top-head'>
		<div class='container'>
			<?php
				 if ( is_active_sidebar( 'header-top-left' ) ) : ?>
				 <div id="header-widget-area" class="head-left chw-widget-area widget-area" role="complementary">
						<?php dynamic_sidebar( 'header-top-left' ); ?>
				 </div>
			<?php endif; ?>
			<?php
				 if ( is_active_sidebar( 'header-top-right' ) ) : ?>
				 <div id="header-widget-area" class="head-right chw-widget-area widget-area" role="complementary">
						<?php dynamic_sidebar( 'header-top-right' ); ?>
				 </div>
			<?php endif; ?>
		</div><!-- End container -->
	</div>
	<!-- End Head Top -->
    

	
	<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				<div class='container'>
					<div class="site-branding">
						<?php galussothemes_the_custom_logo();  ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						 ?>
					</div><!-- .site-branding -->
					<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) { ?>
						<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'galussothemes' ); ?></button>
						<div id="site-header-menu" class="site-header-menu">
							<div class="title-canvas-menu">
								<?php galussothemes_the_custom_logo(); ?>
								<div class="close-canvas"></div>
							</div>
							<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'galussothemes' ); ?>">
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'primary',
												'menu_class' => 'primary-menu',
											)
										);
									?>
								</nav><!-- .main-navigation -->
							<?php endif; ?>
							<?php if ( has_nav_menu( 'social' ) ) : ?>
								<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'galussothemes' ); ?>">
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'social',
												'menu_class'  => 'social-links-menu',
												'depth'       => 1,
												'link_before' => '<span class="screen-reader-text">',
												'link_after'  => '</span>',
											)
										);
									?>
								</nav><!-- .social-navigation -->
							<?php endif; ?>
							<div class="canvas-bg">
								
							</div><!-- canvas-background -->
						</div><!-- .site-header-menu -->
					<?php  }
	 				else {
							wp_list_pages( array(
								'container' => '',
								'title_li' 	=> '',
							) );
						}
					?>
				</div><!-- .end container -->	
			</div><!-- .site-header-main -->
		</header><!-- .site-header -->
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'galussothemes' ); ?></a>

			<div id="content" class="site-content">


