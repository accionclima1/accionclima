<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package ac_tk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

<!-- AC navigation -->

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) { ?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
		<?php } // end if ( ! empty( $header_image ) ) ?>
    </div>

    <!-- Stepped Menus -->
    <div class="steped-nav">
		
		<!-- Main site menu -->
		<?php wp_nav_menu(
			array(
				'theme_location' 	=> 'primary',
				'depth'             => 2,
				'container'         => 'div',
				'container_class'   => 'main-nav',
				'menu_class' 		=> 'nav navbar-nav',
				'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
				'menu_id'			=> 'main-menu',
				'walker' 			=> new wp_bootstrap_navwalker()
			)
		); ?>
		<!-- Secundary menu -->
		<?php wp_nav_menu(
			array(
				'theme_location' 	=> 'secondary',
				'depth'             => 2,
				'container'         => 'div',
				'container_class'   => 'secundary-nav',
				'menu_class' 		=> 'nav navbar-nav',
				'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
				'menu_id'			=> 'secundary-menu',
				'walker' 			=> new wp_bootstrap_navwalker()
			)
		); ?>
    </div><!-- /.navbar-collapse -->
	<?php $url = site_url(); ?>

	<form role="search" method="get" class="navbar-form" action="<?php echo $url; ?>">
	
        <div class="form-group">
          <input type="search" class="search-field form-control" class="form-control" placeholder="Buscar">
          <input type="hidden" name="post_type" value="clima" />
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
	<div class="user-menu navbar-right">
	   <?php if ( is_user_logged_in() ) { ?>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/profile.php">Perfil</a> | 
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php?action=logout">Cerrar Sesion</a>
			
		<?php } else { ?>
			
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php">Iniciar sesion</a>
				| 
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-signup.php">Registrarse</a>
			
		<?php } ?>
	</div>
	<button type="button" class="navbar-toggle">
		<span class="sr-only"><?php _e('Toggle navigation','ac_tk') ?> </span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>

  </div><!-- /.container-fluid -->
</nav>





<div class="main-content">

