<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title(' - ', TRUE, 'right'); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" type="image/png" href="<?php echo IMAGES; ?>/favicon.png">

	<script>(function(){document.documentElement.className='js'})();</script>

	<!-- Scripts to enable modern CSS support to IE8. Remove if IE8 support isn't required! -->
	<!--[if lt IE 9]>
		<script src="<?php echo THEMEROOT; ?>/js/ie/pseudo-refresh.js"></script>
		<script src="<?php echo THEMEROOT; ?>/js/ie/html5.js"></script>
		<script src="<?php echo THEMEROOT; ?>/js/ie/selectivizr.js"></script>
		<script src="<?php echo THEMEROOT; ?>/js/ie/respond.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="page-header">
		<div class="container">

			<a href="<?php echo site_url(); ?>/" class="logo">
				<img src="<?php echo IMAGES; ?>/logo.svg" alt="Groupbrand">
			</a>

			<a href="#" class="nav-toggle"></a>
			<nav class="nav-collapse">
				<ul class="page-nav">
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
			</nav>

		</div>
	</header>
