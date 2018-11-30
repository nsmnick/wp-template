<?php
	get_header();

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>

<!-- Page Hero -->
<?php if ( get_field('page_hero_content', $page_id) ) : ?>
	<section class="page-hero">
		<div class="container">

		<?php the_field('page_hero_content'); ?>

		</div>
	</section>
<?php
	$image = get_field('page_hero_image');
	echo get_page_hero_image_css($image);

endif;
?>
<!-- End Page Hero -->

<!-- Main content -->
<?php // Normal page content
	if (get_the_content()) : ?>

	<section class="panel -main-content">
		<div class="container">

			<?php the_content(); ?>

		</div>
	</section>

<?php endif; ?>


<?php // ACF repeater fields
	$rows = get_field('page_blocks');
	if ($rows) :
		foreach ($rows as $row) :
			$id = !empty($row['id']) ? 'id="'.$row['id'].'" ' : '';
?>

	<section <?php echo $id; ?>class="panel <?php echo $row['class']; ?>">
		<div class="container">

			<?php echo $row['content']; ?>

		</div>
	</section>

<?php
		endforeach;
	endif;
?>
<!-- End main content -->

<?php
		endwhile;
	endif;

	get_footer();
?>
