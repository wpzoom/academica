<?php
/**
 * @package Academica
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="screen-reader-text"><?php _e( 'Search for:', 'academica' ); ?></label>
	<input id="s" type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'academica' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'academica' ); ?>">
	<button id="searchsubmit" name="submit" type="submit" aria-label="<?php esc_attr_e( 'Submit search', 'academica' ); ?>"><?php _e( 'Search', 'academica' ); ?></button>
</form>