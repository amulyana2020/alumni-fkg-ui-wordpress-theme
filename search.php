<?php
/**
 * Search results page
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

<div data-bss-parallax-bg="true" style="height: 300px;background-image: url(<?php echo get_theme_file_uri('images/header.jpeg'); ?>);background-position: center;background-size: cover;">
</div>

<div class="container">
<?php if ( have_posts() ): ?>
	<div class="content">
		<h3 class="my-4"><?php echo __('Search Results for', 'wp_babobski'); ?> '<?php echo get_search_query(); ?>'</h3>
		<ul class="list-unstyled">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="card my-4 p-4">
				<li class="media">
					<div class="media-body">
						<h2>
						<a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
						</h2>
						<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
							<?php the_date(); ?> ?>
						</time>
						<?php the_content(); ?>
					</div>
				</li>
			</div>
			
			<?php endwhile; ?>
		</ul>
	</div>
<?php else: ?>
	<h1>
		<?php echo __('No results found for', 'wp_babobski'); ?> '<?php echo get_search_query(); ?>'
	</h1>
<?php endif; ?>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>