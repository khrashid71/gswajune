

<?php



// 2. Hook the function into the 'wp_footer' action
//add_action( 'wp_footer', 'add_custom_footer_text' );



//testing above codes for hook - should execute when do-action() execute

function gswa_enqueue_styles() {

    // Theme version (fallback)
    $theme_version = wp_get_theme()->get('Version');

    /**
     * 1. Parent Theme (Astra)
     */
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        $theme_version
    );

    /**
     * 2. Child Theme Main Style
     */
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_uri(),
        array('astra-parent-style'),
        $theme_version
    );

    /**
     * 3. Auto-load all CSS files from assets/css (NUMBERED FILES)
     */
    $css_folder = get_stylesheet_directory() . '/assets/css/';
    $css_uri    = get_stylesheet_directory_uri() . '/assets/css/';
   

    // Get all CSS files
    $files = glob($css_folder . '*.css');

    // Sort files (important for numbered order like 01-, 02-, etc.)
    sort($files);

    foreach ($files as $file) {

        // Get filename (e.g. 01-base.css)
        $filename = basename($file);

        // Create clean handle (remove number + .css)
        $handle = 'gswa-' . preg_replace('/^\d+\-/', '', str_replace('.css', '', $filename));

        // Enqueue with cache-busting version
        wp_enqueue_style(
            $handle,
            $css_uri . $filename,
            array('astra-child-style'),
            filemtime($file) // For refresh
        );
    }
}

// Hook into WordPress
add_action('wp_enqueue_scripts', 'gswa_enqueue_styles');


// ===== Shortcodes for GSWA homepage =====
function gswa_homepage_hero_shortcode() {
    ob_start(); ?>
    
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            
            <h2>
                <span>Friendship at Heart.</span>
               <span>Service in Action.</span><br>
               <span>Peace in Society.</span>
               <span>Development for All.</span>
            </h2>

             </div>
    </section>

    <?php
    return ob_get_clean();
}
add_shortcode('gswa_hero', 'gswa_homepage_hero_shortcode');

// gswa-heading shortcode

// ===== Shortcodes for GSWA homepage =====
function gswa_heading_title_shortcode(){
    ob_start(); ?>
    
    <section class="gswa-heading">
      
        <div class="intro-text">
                        
             
                <p> 
                    Gopalganj Social Welfare Association (GSWA) is a completely non-political, 
                    non-sectarian, and non-profit voluntary organization. Our journey began with 
                    the determination to ensure the welfare of the neglected and underprivileged,
                     foster social development, and bring about positive change at all levels of society.  
               
                 <br>We believe that any social crisis can be overcome through collective efforts and mutual unity. With that goal in mind, GSWA works relentlessly for sustainable progress in key sectors
                 such as education, healthcare, environmental protection, and poverty alleviation.</p>

             </div>
    </section>

    <?php
    return ob_get_clean();
}
add_shortcode('gswa_heading','gswa_heading_title_shortcode');

//Header customization
// Remove Astra default header
remove_action('astra_header', 'astra_header_markup');



// modifying inc/blog/blog.php file without touching Astra original file
// set excerpt limit 20 to x(here 40)
//you can remove that filter in your child theme and add your own.

function gswa_change_astra_excerpt_length() {

    remove_filter( 'excerpt_length', 'astra_custom_excerpt_length', 1 );

    add_filter( 'excerpt_length', function ( $length ) {

    $layout = astra_get_blog_layout();

      /*if ( 'blog-layout-4' === $layout || 'blog-layout-6' === $layout ) {
    return 40;
      }*/

       // Or More Clerly

          //wp_die( 'Layout = ' . esc_html( $layout ) );

             if ( in_array( $layout, array( 'blog-layout-4', 'blog-layout-6' ), true ) ) {
               return 40;
        }

        return $length;

    }, 1 );
}

add_action( 'after_setup_theme', 'gswa_change_astra_excerpt_length', 20 );

//Temporary debugging - no longer needed.

//add_action( 'init', function () {
   // error_log( 'INIT TEST ' . date( 'H:i:s' ) );
//} );



require_once get_stylesheet_directory() . '/includes/hooks/footer.php';








