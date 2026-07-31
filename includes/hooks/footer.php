
<?php



if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

//echo '<div style="background:red;color:white;padding:10px;">
//Footer.php is loaded
//</div>';

//Another Add action hook test
// functions.php

// 1. Define the custom callback function-Testing Action Hook


function display_custom_footer_text() {
    echo '<div class="custom-footer-text">';
   
    echo '<p>&copy; ' . date('Y') . ' Gopalganj Social Welfare Association(GSWA).</p>';
    echo '<p>' . 'All Rights Reserved.</p>';
    echo '<p>
    
            Website Developed &amp; Maintained by
            <br>
             <strong>Kazi Harunar Rashid</strong>,
          
            <a href="https://roceanit.com" target="_blank" rel="noopener noreferrer">
            RoceanIT
            </a>
            </p>';
    

       
    
    echo '</div>';
   
}

// 2. Hook the function into the 'wp_footer' action
// Without calling do_action it will execute -'wp_footer' works as do_action
//add_action( 'wp_footer', 'display_custom_footer_text' ); 

add_action( 'my_custom_footer_hook', 'display_custom_footer_text' );










 






