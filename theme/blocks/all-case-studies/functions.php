<?php
if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">plugins page</a></p></div>';
    } );
    return;
}

$context['case_studies'] = Timber::get_posts(array(
    'post_type' => 'case_study',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
));
// $context['example'] = 'Hello from the example block!';
