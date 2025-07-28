<?php
/**
 * @package Academica
 */

require_once get_template_directory() . '/inc/customizer/header.php';

/**
 * Load Customizer files.
 */
function academica_customizer_init() {
    require_once get_template_directory() . '/inc/customizer/logo.php';
}
add_action( 'after_setup_theme', 'academica_customizer_init' );

/**
 * Add sections and controls to the customizer.
 */
function academica_customizer_add_sections_and_options( $wp_customize ) {
    $wp_customize->add_section( 'academica_logo', array(
        'title'    => __( 'Logo', 'academica' ),
        'priority' => 20,
    ) );

    $wp_customize->add_setting( 'logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'logo',
        array(
            'label'    => __( 'Logo', 'academica' ),
            'context'  => 'academica_logo',
            'section'  => 'academica_logo',
            'settings' => 'logo',
        )
    ) );

    $wp_customize->add_setting( 'logo-retina-ready', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'logo-retina-ready', array(
        'type'     => 'checkbox',
        'label'    => __( 'Retina Ready?', 'academica' ),
        'section'  => 'academica_logo',
        'settings' => 'logo-retina-ready',
    ) );

    $wp_customize->add_setting( 'logo-position', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'logo-position', array(
        'type'     => 'radio',
        'choices'  => array(
            __( 'Left', 'academica' ),
            __( 'Center', 'academica' ),
            __( 'Right', 'academica' ),
        ),
        'label'    => __( 'Logo Position', 'academica' ),
        'section'  => 'academica_logo',
        'settings' => 'logo-position',
    ) );

    $wp_customize->add_setting( 'header-background-color', array(
        'default' => '#0a5794',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'header-background-color',
        array(
            'label' => __( 'Header Background Color', 'academica' ),
            'priority' => 0,
            'section' => 'colors',
            'settings' => 'header-background-color'
        )
    ) );

    // Add Accent Color Setting
    $wp_customize->add_setting( 'academica-accent-color', array(
        'default' => '#0A5794',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'academica-accent-color',
        array(
            'label' => __( 'Accent Color', 'academica' ),
            'description' => __( 'Used for links, buttons, and highlights throughout the site.', 'academica' ),
            'priority' => 1,
            'section' => 'colors',
            'settings' => 'academica-accent-color'
        )
    ) );

    // Add Body Text Color Setting
    $wp_customize->add_setting( 'academica-body-text-color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'academica-body-text-color',
        array(
            'label' => __( 'Body Text Color', 'academica' ),
            'description' => __( 'Main text color for content and paragraphs.', 'academica' ),
            'priority' => 2,
            'section' => 'colors',
            'settings' => 'academica-body-text-color'
        )
    ) );

    // Add Typography Section
    $wp_customize->add_section( 'academica_typography', array(
        'title'    => __( 'Typography', 'academica' ),
        'priority' => 30,
    ) );

    // Add Font Stack Setting
    $wp_customize->add_setting( 'academica_font_stack', array(
        'default'           => 'system-ui',
        'sanitize_callback' => 'academica_sanitize_font_stack',
    ) );

    $wp_customize->add_control( 'academica_font_stack', array(
        'type'     => 'select',
        'label'    => __( 'Font Family', 'academica' ),
        'description' => __( 'Choose a font stack for your site. System fonts load faster and provide excellent readability.', 'academica' ),
        'section'  => 'academica_typography',
        'choices'  => array(
            'system-ui'     => __( 'System UI (Recommended)', 'academica' ),
            'humanist'      => __( 'Humanist (Friendly & Readable)', 'academica' ),
            'neo-grotesque' => __( 'Neo-Grotesque (Clean & Modern)', 'academica' ),
            'transitional'  => __( 'Transitional (Academic Serif)', 'academica' ),
            'geometric'     => __( 'Geometric (Contemporary)', 'academica' ),
            'classical'     => __( 'Classical (Elegant)', 'academica' ),
            'monospace'     => __( 'Monospace (Code & Technical)', 'academica' ),
            'industrial'    => __( 'Industrial (Bold & Strong)', 'academica' ),
            'rounded'       => __( 'Rounded (Friendly & Soft)', 'academica' ),
            'slab-serif'    => __( 'Slab Serif (Strong Serifs)', 'academica' ),
        ),
    ) );

    // Add Blog Options Section
    $wp_customize->add_section( 'academica_blog_options', array(
        'title'    => __( 'Blog Options', 'academica' ),
        'priority' => 25,
    ) );

    // Add Post Content Display Setting
    $wp_customize->add_setting( 'academica_post_content_display', array(
        'default'           => 'excerpt',
        'sanitize_callback' => 'academica_sanitize_content_display',
    ) );

    $wp_customize->add_control( 'academica_post_content_display', array(
        'type'     => 'radio',
        'label'    => __( 'Post Content Display on Archives', 'academica' ),
        'description' => __( 'Choose how to display post content on blog pages, archives, and search results.', 'academica' ),
        'section'  => 'academica_blog_options',
        'choices'  => array(
            'excerpt' => __( 'Show Excerpts (Recommended)', 'academica' ),
            'full'    => __( 'Show Full Content', 'academica' ),
        ),
    ) );
}
add_action( 'customize_register', 'academica_customizer_add_sections_and_options' );

/**
 * Print customizer css.
 */
function acedemica_customizer_display_css() {
    $styles = array();

    if ( '#0a5794' != ( $header_background_color = get_theme_mod( 'header-background-color', '#0a5794' ) ) ) {
        $styles[] = array(
            'selectors' => '#header, .navbar-nav ul',
            'declarations' => array(
                'background-color' => $header_background_color
            )
        );
    }

    // Header Text Color
    $header_text_color = get_header_textcolor();
    if ( ! empty( $header_text_color ) && 'blank' != $header_text_color && 'ffffff' != $header_text_color ) {
        $styles[] = array(
            'selectors' => '#site-title, #site-title a, #site-description',
            'declarations' => array(
                'color' => '#' . $header_text_color
            )
        );
    }

    // Hide header text if set to blank
    if ( 'blank' == $header_text_color ) {
        $styles[] = array(
            'selectors' => '#site-title, #site-description',
            'declarations' => array(
                'display' => 'none'
            )
        );
    }

    // Body Text Color
    if ( '#333333' != ( $body_text_color = get_theme_mod( 'academica-body-text-color', '#333333' ) ) ) {
        $styles[] = array(
            'selectors' => 'body, p',
            'declarations' => array(
                'color' => $body_text_color
            )
        );
    }

    // Typography - Font Stack
    $font_stack = get_theme_mod( 'academica_font_stack', 'system-ui' );
    if ( 'system-ui' != $font_stack ) {
        $font_families = academica_get_font_stacks();
        if ( isset( $font_families[ $font_stack ] ) ) {
            $styles[] = array(
                'selectors' => 'html, body',
                'declarations' => array(
                    'font-family' => $font_families[ $font_stack ]
                )
            );
        }
    }

    if ( '#0A5794' != ( $accent_color = get_theme_mod( 'academica-accent-color', '#0A5794' ) ) ) {
        $styles[] = array(
            'selectors' => 'a, .read-more, .read-more-link, .has-primary-blue-color',
            'declarations' => array(
                'color' => $accent_color
            )
        );

        $styles[] = array(
            'selectors' => '.pagination .page-numbers:hover, .has-primary-blue-background-color, .skip-link, button, html input[type="button"], input[type="reset"], input[type="submit"]',
            'declarations' => array(
                'background-color' => $accent_color
            )
        );

        $styles[] = array(
            'selectors' => '.wp-block-pullquote',
            'declarations' => array(
                'border-left-color' => $accent_color
            )
        );
    }

    if ( empty( $styles ) ) return;
    ?>

    <style type="text/css">

        <?php
        foreach ( $styles as $rule ) {
            echo $rule['selectors'] . ' {';

            foreach ( $rule['declarations'] as $property => $value ) {
                echo "{$property}:{$value};\n";
            }

            echo '}';
        }
        ?>

    </style>

    <?php
}
add_action( 'wp_head', 'acedemica_customizer_display_css', 20 );
