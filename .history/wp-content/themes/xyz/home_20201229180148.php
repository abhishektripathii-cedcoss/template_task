<?php 
$args = array(
    'posts_per_page'   => 3,
    'post_type'        => 'post',
);
// The Query
query_posts( $args );
if(have_post)
 
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

