<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ac_tk
 */

get_header(); ?>

	

		<header class="search-header">
			<h2 class="page-title"><?php printf( __( 'Resultados de busqueda', 'ac_tk' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

			<div class="search-query">
				
			</div>

			<div class="filter">
				<a href="/"><i class="fa fa-times-circle"></i></a>
				<p>Limpiar filtro de búsqueda</p>
			</div>

		</header><!-- .page-header -->
		<div class="search-template container">
			<div class="row">
				<div class="col-md-6">
				<?php if ( have_posts() ) : ?>
				<?php // start the loop. ?>
					<?php while ( have_posts() ) : the_post(); ?>							
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="featured-image">
									<?php the_post_thumbnail( 'medium' ); ?>
								</div>
								<header>
									<h2 class="page-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><i class="fa fa-caret-right"></i> <?php the_title(); ?></a></h2>
									</header><!-- .entry-header -->
									<div class="entry-summary">
										<?php the_excerpt(); ?>
									</div><!-- .entry-summary -->
									<footer class="entry-meta">
											<p>
											<?php
												/* translators: used between list items, there is a space after the comma */
												$tags_list = get_the_tag_list( '', __( ', ', 'ac_tk' ) );
												if ( $tags_list ) :
											?>
											
											<span class="tags-links">
												<?php printf( __( 'Tags: %1$s', 'ac_tk' ), $tags_list ); ?>
											</span>
											<?php endif; // End if $tags_list ?>
											</p>

										
									</footer><!-- .entry-meta -->
								</article><!-- #post-## -->
					<?php endwhile; ?>
					<?php ac_tk_content_nav( 'nav-below' ); ?>
				<?php else : ?>
					<?php get_template_part( 'no-results', 'search' ); ?>
				<?php endif; // end of loop. ?>
				</div>
				<div class="col-md-6">
					<article id="post-70" class="clima type-clima hentry biggy">
								<div class="featured-image">
									<img width="300" height="200" src="/wp-content/uploads/2015/12/coffe-300x200.jpg" class="attachment-medium size-medium wp-post-image" alt="Fresh coffee beans on branch of coffee plant - Arabica coffee" srcset="/wp-content/uploads/2015/12/coffe-300x200.jpg 300w, /wp-content/uploads/2015/12/coffe-768x512.jpg 768w, /wp-content/uploads/2015/12/coffe-1024x683.jpg 1024w" sizes="(max-width: 300px) 100vw, 300px">
									<footer class="entry-meta">
											<span class="tags-links">
												Tags: <a href="#" rel="tag">panama</a>, <a href="#" rel="tag">costa rica</a>, <a href="#" rel="tag">cafe</a>											</span>										
									</footer><!-- .entry-meta -->			
								</div>
								<header>
									<h2 class="page-title"><a href="#" rel="bookmark"><i class="fa fa-caret-right"></i> Mundo Hola</a></h2>
									</header><!-- .entry-header -->
									<div class="entry-summary">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mattis tempor nunc non malesuada. Nam sollicitudin tellus purus, nec egestas ante ultrices id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mattis tempor nunc non malesuada.
										</p>
										<p>consectetur adipiscing elit. Morbi mattis tempor nunc non malesuada. Nam sollicitudin tellus purus, nec egestas ante ultrices id.consectetur adipiscing elit. Morbi mattis tempor nunc non malesuada. Nam sollicitudin tellus purus, nec egestas ante ultrices id. Morbi mattis tempor nunc non malesuada. Nam sollicitudin tellus purus, nec egestas ante ultrices id.</p>
									</div><!-- .entry-summary -->
									
								</article>
				</div>
			</div>
		</div>

<?php get_footer(); ?>