<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Academica
 * @since Academica 1.2.2-wpcom
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 *
 * @uses academica_header_style()
 * @uses academica_admin_header_style()
 * @uses academica_admin_header_image()
 *
 * @package Academica
 */
function academica_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1600,
		'height'                 => 300,
		'flex-height'            => true,
		'wp-head-callback'       => 'academica_header_style',
		'admin-head-callback'    => 'academica_admin_header_style',
		'admin-preview-callback' => 'academica_admin_header_image',
	);

	$args = apply_filters( 'academica_custom_header_args', $args );

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'academica_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @todo Remove this function when WordPress 3.6 is released.
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Academica
 * @since Academica 1.2.2-wpcom
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}


if ( ! function_exists( 'academica_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see academica_custom_header_setup().
 *
 * @since Academica 1.2.2-wpcom
 */
function academica_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		max-width:960px;
	}
	#headimg h1,
	#desc {
		font-family: Georgia, serif;
		font-weight: normal;
		text-transform: uppercase;
	}
	#headimg h1 {
		font-size: 24pt;
		line-height: 1.2;
		margin: 0;
	}
	#headimg h1 a {
		color: #0c5390;
		text-decoration: none;
	}
	#headimg h1 a:hover {
		color: #f99734 !important;
	}
	#desc {
		color: #0c5390;
		font-size: 16pt;
		margin: 0;
	}
	#headimg img {
		border-bottom: solid 1px #f99734;
		border-top: solid 1px #f99734;
		margin-top: 30px;
		padding: 1px 0;
	}
	</style>
<?php
}
endif; // academica_admin_header_style

if ( ! function_exists( 'academica_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see academica_custom_header_setup().
 *
 * @since Academica 1.2.2-wpcom
 */
function academica_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // academica_admin_header_image

if ( ! function_exists( 'academica_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see academica_custom_header_setup().
 *
 * @since Academica 1.2.2-wpcom
 */
function academica_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		#site-title,
		#site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		#site-title,
		#site-title a,
		#site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // academica_header_style