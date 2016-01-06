<?php
/**
 * The Template for displaying all single posts.
 *
 * @package ac_tk
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- hero module -->	
		<div class="home-hero single">
			<div class="content-layer">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<img src="/wp-content/uploads/2015/12/logo-white.png" alt="">
							<h2><?php the_title(); ?></h2>
							<?php $url = site_url(); ?>

						<form role="search" method="get" class="search-form" action="<?php echo $url; ?>">
								<label>
									<input type="search" class="search-field form-control" placeholder="Realizar búsqueda" value="" name="s" title="Search for:">
									<input type="hidden" name="post_type" value="clima" />
								</label>
								<button type="submit" class="btn btn-default submit"><i class="fa fa-search"></i></button>
								
							</form>
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
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					  <div class="row">
					    <div class="col-md-3 col-sm-3 col-xs-6"><?php the_field('tab_button_1'); ?></div>
					    <div class="col-md-3 col-sm-3 col-xs-6"><?php the_field('tab_button_2'); ?></div>
					    <div class="col-md-3 col-sm-3 col-xs-6"><?php the_field('tab_button_3'); ?></div>
					    <div class="col-md-3 col-sm-3 col-xs-6"><?php the_field('tab_button_4'); ?></div>
					  </div>
				</div>
			</div>
		</div>
		<!-- single clima content -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="title-module">Resultados de la busqueda</h2>
				</div>
			</div>
			<div class="row the-content">
				<div class="col-md-10 col-md-offset-1">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ac_tk' ) ); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="the-map">
						<?php the_field('map_field'); ?>	

						<div class="row">
								<div class="col-md-7 map-links">
									<?php $download = get_field('descargar_shp'); 

										if( !empty($download) ) :	
									?>
									<a href="<?php echo $download; ?>"><i class="fa fa-download"></i> Descargar SHP</a> | 
									<?php endif; 
										$visualize = get_field('visualizar');

										if( !empty($visualize) ) :
									?>
									<a href="<?php echo $visualize; ?>"><i class="fa fa-expand"></i> Visualizar</a> | 
									<?php endif; 
										$metaData = get_field('meta_data');

										if( !empty($metaData) ) :
									?>
									<a href="<?php echo $metaData; ?>"><i class="fa fa-database"></i> Metadata</a> 
									<?php endif; ?>
								</div>
								<div class="col-md-5 map-countries">
									
									<?php 

										$field = get_field_object('paises');
										$value = $field['value'];
										$choices = $field['choices'];

										if( $value ): ?>
										
											<?php foreach( $value as $v ): ?>
											
											<img src="/wp-content/themes/accionclima/includes/icons/<?php echo  $v ; ?>.png" alt="<?php echo $choices[ $v ]; ?>">
												
											
											<?php endforeach; ?>
										
										<?php endif; ?>

								</div>
						</div>				
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<div class="col-md-6">
							<h3>Info del productor</h3>
							<div class="info-producer">
								
								<?php the_field('info_productor'); ?>
							</div>
							<div class="keyword-tags">
								<h3>Keywords</h3>
								<?php
												/* translators: used between list items, there is a space after the comma */
												$tags_list = get_the_tag_list( '', __( ' ', 'ac_tk' ) );
												if ( $tags_list ) :
											?>
											
											<span class="tags-links">
												<?php printf( __( '%1$s', 'ac_tk' ), $tags_list ); ?>
											</span>
											<?php endif; // End if $tags_list ?>	
							</div>
						</div>
						<div class="col-md-6 video-holder">
							<h3>video</h3>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('cvideo'); ?>" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="bordered"></div>
				</div>
			</div>
		
		
			<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								comments_template();
						?>
					</div>
			</div>
		</div>

	<?php endwhile; // end of the loop. ?>
	<div class="container">
		<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="relatedposts">
						    <h3>Informacion Relacionada</h3>
						    <div class="row">
						    <?php
						        $orig_post = $post;
						        global $post;
						        $tags = wp_get_post_tags($post->ID);
						 
						        if ($tags) {
						            $tag_ids = array();
						        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
						            $args=array(
						                'tag__in' => $tag_ids,
						                'post__not_in' => array($post->ID),
						                'posts_per_page'=>4, // Number of related posts to display.
						                'ignore_sticky_posts'=>1,
						                'post_type' => 'clima',
						            );
						 
						        $my_query = new wp_query( $args );
						 
						        while( $my_query->have_posts() ) {
						            $my_query->the_post();
						        ?>
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
							        
						 
						        <?php }
						        }
						        $post = $orig_post;
						        wp_reset_query();
						        ?>
						        </div>
						    </div>

					</div>
				</div>
		</div>
<?php get_template_part( 'proyects', 'module' ); ?>
<?php get_footer(); ?>