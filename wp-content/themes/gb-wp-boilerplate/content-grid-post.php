<article id="post-<?php the_ID(); ?>" <?php post_class('grid-post'); ?>>

	<div class="__info">
		<header class="__header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>

		<div class="__meta">
			<?php entry_meta(); ?>
		</div>

		<div class="__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>

</article>