<?php
get_header();

$page_id = ('page' == get_option('show_on_front')? get_option('page_for_posts') : get_the_ID());

?>

<!-- Page Hero -->
<?php if ( get_field('page_hero_content', $page_id) ) : ?>
	<section class="page-hero">
		<div class="container">

		<?php the_field('page_hero_content', $page_id); ?>

		</div>
	</section>
<?php
	$image = get_field('page_hero_image', $page_id);
	echo get_page_hero_image_css($image);

endif;
?>
<!-- End Page Hero -->

<?php
if ( have_posts() ) : ?>

	<section class="panel -posts-container">
		<div class="container">

				<div class="posts">
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', 'grid-post' );

					endwhile;
				?>
				</div>

				<div class="sidebar -right">
					<?php get_sidebar('blog'); ?>
				</div>

				<div class="navigation">
					<div class="next"><?php next_posts_link('<i class="fa fa-angle-left"></i> Older posts'); ?></div>
					<div class="previous"><?php previous_posts_link('Newer posts <i class="fa fa-angle-right"></i>'); ?></div>
				</div>

		</div>
	</section>

<?php
// If no content, include the "No posts found" template.
else :
	get_template_part( 'content', 'none' );

endif;

get_footer();
?>