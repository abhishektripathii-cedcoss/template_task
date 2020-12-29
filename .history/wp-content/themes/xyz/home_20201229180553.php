<?php 
get_header();
?>
<div class="main-banner header-text">
</div>
<section class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-content">
              <div class="row">
                <div class="col-lg-8">
                  <span>Stand Blog HTML5 Template</span>
                  <h4>Creative HTML Template For Bloggers!</h4>
                </div>
                <div class="col-lg-4">
                  <div class="main-button">
                    <a rel="nofollow" href="<?php echo get_template_directory_uri(); ?>/https://templatemo.com/tm-551-stand-blog" target="_parent">Download Now!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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

