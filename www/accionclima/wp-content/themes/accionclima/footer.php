<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package ac_tk
 */
?>



<footer id="colophon" class="site-footer" role="contentinfo">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-md-6 col-md-offset-3">

				<?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>

				<div class="widget">
					<h2 class="widget-title">Desea recibir info valiosa?</h2>
					<p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</p>
					<?php 
					$formShorcode = '[contact-form-7 id="34" title="registrar correo"]';
					echo do_shortcode($formShorcode); ?>
				</div>
				<div class="widget">
					<div id="carousel-logos" class="carousel slide">
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <?php 
                           $carousel_query = new WP_Query(array( 
                            'post_type' => 'footerslider',
                            'posts_per_page' => 1
                            )); 
                           while ( $carousel_query->have_posts() ) : 
                           $carousel_query->the_post();
                          ?>
                        <div class="item active">
                            <div class="col-md-4 col-xs-4">
                            		<?php the_post_thumbnail( 'full' ); ?>
                            </div>  
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                        <?php 
                           $carousel_query = new WP_Query(array(
                            'post_type' => 'footerslider', 
                            'offset' => 1 
                            )); 
                           while ( $carousel_query->have_posts() ) : 
                           $carousel_query->the_post();
                          ?>
                          <div class="item">
                            <div class="col-md-4 col-xs-4">
                            		<?php the_post_thumbnail( 'full' ); ?>
                            </div> 
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>

                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-logos" role="button" data-slide="prev">
                        <i class="fa fa-caret-left"></i>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#carousel-logos" role="button" data-slide="next">
                        <i class="fa fa-caret-right"></i>
                        <span class="sr-only">Next</span>
                      </a>
                </div>
				</div>
				<div class="widget">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></span></a>
					<a href="#"><i class="fa fa-youtube-play"></i></span></a>
				</div>

			<?php endif; ?>

			</div>
		</div>
	</div><!-- close .container -->
	<div class="copyright">
		<div class="right">
			<p>Todos los derechos reservados. Accion Clima 2015</p>
		</div>
		<?php wp_nav_menu(
			array(
				'theme_location' 	=> 'footer',
				'depth'             => 1,
				'container'         => 'div',
				'container_class'   => 'left',
				'menu_class' 		=> 'nav navbar-nav',
				'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
				'menu_id'			=> 'foot-menu',
				'walker' 			=> new wp_bootstrap_navwalker()
			)
		); ?>
	</div>
</footer><!-- close #colophon -->
</div><!-- close .main-content -->
<?php wp_footer(); ?>

</body>
</html>
