<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.2.3
 * @autor 		Babobski
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header', 
	'parts/shared/header'
]);
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div class="container">
		
		<div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
		</div>

		<div class="card my-4 p-4">
			<h2>
				<?php the_title(); ?>
			</h2>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
				<?php the_date(); ?> <?php the_time(); ?>
			</time>
			<?php comments_popup_link(__('Leave a Comment', 'wp_babobski'), __('1 Comment', 'wp_babobski'), __('% Comments', 'wp_babobski')); ?>
			<?php the_content(); ?>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
				<h3>
					<?php echo __('About', 'wp_babobski'); ?> <?php echo get_the_author() ; ?>
				</h3>
				<?php the_author_meta( 'description' ); ?>
			<?php endif; ?>

			<?php comments_template( '', true ); ?>

		</div>
		
	</div>

<?php endwhile; ?>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>
