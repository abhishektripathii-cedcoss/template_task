<?php 
get_header();
?>
<div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-01.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Fashion</span>
                </div>
                <a href="post-details.html"><h4>Morbi dapibus condimentum</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 12, 2020</a></li>
                  <li><a href="#">12 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-02.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Nature</span>
                </div>
                <a href="post-details.html"><h4>Donec porttitor augue at velit</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 14, 2020</a></li>
                  <li><a href="#">24 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-03.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Lifestyle</span>
                </div>
                <a href="post-details.html"><h4>Best HTML Templates on TemplateMo</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 16, 2020</a></li>
                  <li><a href="#">36 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-04.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Fashion</span>
                </div>
                <a href="post-details.html"><h4>Responsive and Mobile Ready Layouts</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 18, 2020</a></li>
                  <li><a href="#">48 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-05.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Nature</span>
                </div>
                <a href="post-details.html"><h4>Cras congue sed augue id ullamcorper</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 24, 2020</a></li>
                  <li><a href="#">64 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-06.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Lifestyle</span>
                </div>
                <a href="post-details.html"><h4>Suspendisse nec aliquet ligula</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 26, 2020</a></li>
                  <li><a href="#">72 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- Banner Ends Here -->
     <section class="blog-posts">
      <div class="container">
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
          ;
          ?>
          <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                        <?php
                            if ( has_post_thumbnail() ) { 
                                the_post_thumbnail(get_the_ID(),'full');
                                }
                                the_title();
                                the_content();
                        ?>
                    </div>            
                <?php    
                    endwhile;
                    endif;
            
            // Reset Query
            wp_reset_query();
            ?>

            <?php

            get_footer();