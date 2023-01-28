<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * Please see /external/bootstrap-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.2.3
 * @autor 		Babobski
 */

 
get_header();
?>

<section>
        <div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
        </div>
    </section>

<?php if ( have_posts() ): ?>
	<section>
      <div class="container">
          <div class="card my-4 p-4">
            <h3>News</h3>
          </div>
		      
		<?php while ( have_posts() ) : the_post(); ?>

		<article class="card my-4 p-4">

              <h2>
                <a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
              </h2>

              <div>
                <ul>
                  <time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_date(); ?> <?php the_time(); ?></time>
                </ul>
              </div>

              <div>
                <p><?php the_excerpt();  ?>
                </p>
                <div>
                  <a href="<?php esc_url( the_permalink() ); ?>" class="btn btn-primary">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
		<?php endwhile; ?>
</section>

<?php else: ?>
	<h1>
		<?php echo __('Nothing to show yet.', 'wp_babobski')?>
	</h1>
<?php endif; ?>

<?php 
get_footer();
?>