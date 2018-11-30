<?php
if (is_active_sidebar('blog')) : ?>
	<div id="secondary" class="secondary">

		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'blog' ); ?>
		</div>

	</div>
<?php endif; ?>
