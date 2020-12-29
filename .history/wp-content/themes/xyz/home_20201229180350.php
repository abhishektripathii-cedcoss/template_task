<?php 
get_header();
?>
<div class="main-banner header-text">
    <?php
$args = array(
    'posts_per_page'   => 3,
    'post_type'        => 'post',
);
// The Query
query_posts( $args );
if(have_posts()):
 
// The Loop
while ( have_posts() ) : the_post();
    echo '
<li>';
    the_title();
    the_content();
    echo '</li>
 
';
endwhile;
endif;
 
// Reset Query
wp_reset_query();

