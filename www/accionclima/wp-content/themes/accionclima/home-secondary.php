<?php
/**
 * Template Name: Homepage Secondary
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
<?php while ( have_posts() ) : the_post(); ?>	
	<style>
		li.active a .icon-wrap, li:hover a .icon-wrap {
		    border-color: <?php the_field('color_primario'); ?>;
		    background-color: <?php the_field('color_primario'); ?>;
		}

	</style>

	<div class="home-hero secondary">
		<div class="content-layer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<img src="/wp-content/uploads/2015/12/logo-white.png" alt="">
						<h2><?php the_title(); ?></h2>
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
		<?php $imageBg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
			<div class="background-layer" style="background-image:url('<?php echo $imageBg[0]; ?>')">
		</div>
	</div>

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
	</div>
	<?php endwhile; // end of the loop. ?>
<div class="home-post-listing container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="title-module">noticias</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
						    <?php
						    	$args = array(
								    
								      'posts_per_page' => '5'
								);

						        $my_query = new WP_Query( $args );
						 
						        while( $my_query->have_posts() ) {
						            $my_query->the_post();
						        ?>
						        
								<?php if( get_post_format() == false ) : ?>

								<div class="col-md-3">
						 			<div class="default-post-listing">
						 				<?php $imageBgR = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						 				<div class="widescreen" style="background-image:url('<?php echo $imageBgR[0]; ?>')">
						 				</div>
						 				<h3><a href="<?php the_permalink()?>">
							            <?php the_title(); ?><i class="fa fa-caret-right"></i>
							            </a></h3>
							            <?php the_excerpt(); ?>
							        </div>
						 		</div>
						 		
								<?php endif; ?>
						        <?php }
						        wp_reset_query();
						        ?>
						        </div>

						        <div class="row">
							    	<?php
							    	$args = array(
									    
									      'posts_per_page' => '5'
									);

							        $my_query = new WP_Query( $args );
							 
							        while( $my_query->have_posts() ) {
							            $my_query->the_post();
							        ?>
							        <?php if( get_post_format() == 'video' ) : ?>

									<div class="col-md-12">
							 			<div class="default-post-listing video">
							 				<div class="row">
							 					<div class="col-md-3">
							 						<h3><a href="<?php the_permalink()?>">
										            <?php the_title(); ?><i class="fa fa-caret-right"></i>
										            </a></h3>
										            <?php the_excerpt(); ?>
							 					</div>
							 					<div class="col-md-9">
							 						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('video_id'); ?>" frameborder="0" allowfullscreen></iframe>
							 						
							 						<?php the_field('video_desc'); ?>
							 					</div>
							 				</div>
								        </div>
							 		</div>
							 		
										<?php endif; ?>
							 		<?php }
							        wp_reset_query();
							        ?>
						        </div>
						    
			</div>
		</div>
	</div>

	<?php get_template_part( 'proyects', 'module' ); ?>
<?php get_footer(); ?>
