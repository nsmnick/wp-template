<?php
get_header(); ?>

<!-- Page Hero -->
	<section class="page-hero -post">
		<div class="container">

		<?php the_title('<h1>', '</h1>'); ?>

		</div>
	</section>
	<?php
		echo get_post_hero_image_css();
	?>
<!-- End Page Hero -->

<?php
while ( have_posts() ) : the_post(); ?>

	<section class="panel -posts-container">
		<div class="container">

			<?php get_template_part( 'content', get_post_format() ); ?>

		</div>
	</section>

	<section class="panel -comments">
		<div class="container">

			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		</div>
	</section>

<?php
endwhile;

get_footer();
?>
