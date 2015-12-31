<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ac_tk
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="search-header">

			<h2 class="page-title"><?php printf( __( 'Resultados de busqueda', 'ac_tk' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

			<div class="search-query">
				<span>cafe</span>
				<span>cafe</span>
				<span>cafe</span>
				<span>cafe</span>
			</div>

			<div class="filter">
				<a href="/"><i class="fa fa-times-circle"></i></a>
				<p>Limpiar filtro de búsqueda</p>
			</div>

		</header><!-- .page-header -->

		<?php // start the loop. ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php ac_tk_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; // end of loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>