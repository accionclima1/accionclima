<?php
/**
 * Template Name: Homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package ac_tk
 */

get_header(); ?>
<!-- hero module -->	
	<div class="home-hero">
		<div class="content-layer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<img src="/wp-content/uploads/2015/12/logo-white.png" alt="">
						<form role="search" method="get" class="search-form" action="http://local.accionclima.org/">
							<label>
								<input type="search" class="search-field form-control" placeholder="Realizar búsqueda" value="" name="s" title="Search for:">
								<input type="hidden" name="post_type" value="clima" />
							</label>
							<button type="submit" class="btn btn-default submit"><i class="fa fa-search"></i></button>
							
						</form>

						<div class="hero-login">
							
									<?php if ( is_user_logged_in() ) { ?>
								
							<?php } else { ?>
								
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php" class="btn btn-primary">Iniciar Sesion</a>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-signup.php" class="btn btn-primary">Registrarse</a>
								
							<?php } ?>
							
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="background-layer">
		</div>
	</div>

	

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="tabbed-module">
			<div class="container">
				<!-- Nav tabs -->
				  <ul class="row nav nav-tabs" role="tablist">
				    <li role="presentation" class="active col-md-3 col-sm-3 col-xs-6"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php the_field('tab_button_1'); ?></a></li>
				    <li role="presentation" class="col-md-3 col-sm-3 col-xs-6"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php the_field('tab_button_2'); ?></a></li>
				    <li role="presentation" class="col-md-3 col-sm-3 col-xs-6"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?php the_field('tab_button_3'); ?></a></li>
				    <li role="presentation" class="col-md-3 col-sm-3 col-xs-6"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><?php the_field('tab_button_4'); ?></a></li>
				  </ul>
			</div>
			  <!-- Tab panes -->
		<div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home">
			    	<div class="tabmenu">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_menu_1'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="tabbed-cont">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_content_1'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
					<div class="tabmenu">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_menu_2'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="tabbed-cont">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_content_2'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="messages">
			    	<div class="tabmenu">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_menu_3'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="tabbed-cont">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_content_3'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="settings">
			    	<div class="tabmenu">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_menu_4'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="tabbed-cont">
			    		<div class="container">
			    			<div class="row">
			    				<div class="col-lg-12">
			    					<?php the_field('tab_content_3'); ?>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
		    </div>
		</div>
	</div>

		<?php get_template_part( 'proyects', 'module' ); ?>


	<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
