<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xyz
 */

get_header();
?>
<!-- Banner Starts Here -->
<div class="heading-page ">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <!-- <div class="col-lg-12"> -->
              <div class="text-content">


<!-- edit from me -->
			  <main id="primary" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();
					
					the_title( '<h4 class="entry-title">', '</h4>' );
					// the_sub_title( '<h2 class="entry-title">', '</h2>' );
					
					
					
					
					// get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

</main><!-- #main -->
                <!-- <h4>about us</h4> -->
                <!-- <h2>more about us!</h2> -->
              </div>
            <!-- </div> -->
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->


    <section class="about-us">
      <div class="container">
      	
	   <?php 
	   
	   xyz_post_thumbnail();
	   the_content();
	 ?>
	 
        
        
      </div>
    </section>

	

<?php
//get_sidebar();
get_footer();
