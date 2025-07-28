<?php
/**
 * @package Academica
 */
?>
			<footer id="footer" class="clearfix" role="contentinfo">
				<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>

				    <section class="site-widgetized-section">
				        <div class="widgets clearfix <?php echo academica_widgets_count_class( 'sidebar-3' ); ?>">

				            <?php dynamic_sidebar( 'sidebar-3' ); ?>

				        </div>
				    </section><!-- .site-widgetized-section -->

				<?php endif; ?>

				<?php wp_nav_menu( array( 
					'container' => 'nav', 
					'container_class' => 'footer-navigation',
					'container_role' => 'navigation',
					'container_aria_label' => esc_attr__( 'Footer Menu', 'academica' ),
					'depth' => 1, 
					'theme_location' => 'footer', 
					'fallback_cb' => false 
				) ); ?>
				<p class="copy">
 					<?php academica_the_footer_text( 'two' ); ?>
				</p>
			</footer><!-- end #footer -->
		</main><!-- end #main -->
		</div><!-- end #wrap -->

		<?php wp_footer(); ?>
	</body>
</html>