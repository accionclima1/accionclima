<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ac_tk
 */
?>

<div class="proyect-module">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="title-module">Proyecto</h1>
			</div>
		</div>
	</div>
	<div class="proyect-grid container-fluid">
		<div class="row">
		<?php 
             $proyect_query = new WP_Query(array( 
              'post_type' => 'project',
              )); 
             while ( $proyect_query->have_posts() ) : 
             $proyect_query->the_post();
        ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
			<div class="col-md-3 col-sm-6 proyect-item" style="background-image: url('<?php echo $image[0]; ?>')">
				<h6><?php the_title();?> </h6>
				<?php the_excerpt(); ?>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</div>