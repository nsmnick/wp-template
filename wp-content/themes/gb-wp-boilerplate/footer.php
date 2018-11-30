	<footer class="page-footer">
		<div class="container">

			<div class="footer-col">
				<ul class="footer-menu footer-main-menu">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu'
								, 'container' => ''
								, 'items_wrap' => '%3$s'
							)
						);
					?>
				</ul>
			</div>

			<div class="footer-col">
				<ul class="footer-menu">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu'
								, 'container' => ''
								, 'items_wrap' => '%3$s'
							)
						);
					?>
				</ul>
			</div>

			<div class="copyright">
				<p>&copy; Groupbrand <?php echo date("Y"); ?>.</p>
				<p>Site by <a href="http://www.groupbrand.com">Groupbrand</a>.</p>
			</div>

		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
