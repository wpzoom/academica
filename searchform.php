<?php
/**
 * @package Academica
 */
$unique_id = wp_unique_id( 'search-form-' );
?>
<form method="get" id="<?php echo $unique_id; ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="<?php echo $unique_id; ?>-input" class="screen-reader-text"><?php _e( 'Search for:', 'academica' ); ?></label>
	<input id="<?php echo $unique_id; ?>-input" type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'academica' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'academica' ); ?>">
	<button id="<?php echo $unique_id; ?>-submit" name="submit" type="submit" aria-label="<?php esc_attr_e( 'Submit search', 'academica' ); ?>"><?php _e( 'Search', 'academica' ); ?></button>
</form>
