<?php
/**
 * @package Academica
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

	<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

	<p class="entry-meta">
		<?php
		if ( 'post' == get_post_type() && ! is_sticky() ) :
			printf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
				esc_url( get_permalink() ),
				esc_attr( sprintf( __( 'Permanent Link to %s', 'academica' ), the_title_attribute( 'echo=0' ) ) ),
				esc_html( get_the_date( get_option( 'date_format' ) . ' ' ) )
			);
			if ( ! post_password_required() && ( comments_open() || 0 != get_comments_number() ) ) :
				echo ' <span class="sep">/ </span> ';
				comments_popup_link( __( 'Leave a comment', 'academica' ) );
			endif;
		endif; ?>
	</p><!-- end .entry-meta -->
	<div class="entry-summary">
		<?php
		$content_display = get_theme_mod( 'academica_post_content_display', 'excerpt' );
		if ( 'full' === $content_display ) {
			// Show content but respect read-more tags/blocks on archive pages
			if ( ! is_single() && ! is_page() ) {
				$content = get_the_content();

				// Use standard the_content() for classic <!--more--> tags
				the_content( '<span class="read-more-link">' . esc_html__( 'Continue Reading', 'academica' ) . ' &rarr;</span>' );
			} else {
				the_content();
			}
		} else {
			// Get excerpt without the automatic "Continue reading" link
			$excerpt = get_the_excerpt();
			if ( $excerpt ) {
				echo '<p>' . $excerpt . '</p>';
			}
			echo '<p><a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'Continue Reading', 'academica' ) . ' &rarr;</a></p>';
		}
		?>
	</div>

</div><!-- end #post-## -->