<?php 
$args
// The Query
query_posts( $args );
 
// The Loop
while ( have_posts() ) : the_post();
    echo '
<li>';
    the_title();
    the_content();
    echo '</li>
 
';
endwhile;
 
// Reset Query
wp_reset_query();

