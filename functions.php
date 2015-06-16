<?php
/**
 * allow loading of extra files
 */

add_action('interface_init', 'mantelzorg_files');

function mantelzorg_files()
{
    require_once(__DIR__ . '/inc/structures/header-extensions.php');
}

/**
 * load dutch translations, put them here so we have them in version control and we will not loose our work
 * when someone presses update for the parent theme
 */

load_theme_textdomain( 'interface', get_stylesheet_directory() . '/languages' );


/**
 * setup styles modifications
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

/**
 * customize the footer info
 */
add_action('interface_before_footer', 'mantelzorger_footer');

function mantelzorger_footer()
{
    remove_action('interface_footer', 'interface_footer_info', 30);
    add_action('interface_footer', 'mantelzorg_footer_info', 30);
}

/**
 * function to show the footer info, copyright information
 */
function mantelzorg_footer_info()
{
    $output = '<div class="copyright">' . __('Copyright &copy;', 'interface') . ' ' . interface_the_year() . ' ' . interface_site_link() . '</div><!-- .copyright -->';
    echo $output;
}


add_action('interface_before_header', 'mantelzorger_header');

/**
 * unfortunately the header isn't really properly split up,
 * so we need to duplicate (code from) the header in order to
 * customize it and add our own logo implementation
 */
function mantelzorger_header()
{
    remove_action('interface_header', 'interface_headercontent_details');
    add_action('interface_header', 'mantelzorger_header_info');
}


