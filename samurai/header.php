<?php
/**
 * Header
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */
?><!doctype html>
<!--[if lt IE 9]><html class="no-js oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php Samurai_Snippet::title(); ?></title>

		<meta name="description" content="<?php Samurai_Snippet::meta_description(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>">

		<?php if (! SAMURAI_DEVELOPMENT_MODE) : ?>
		<!-- Google Analytics Code -->
		<?php endif; ?>

		<?php wp_head(); ?>

		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
		<![endif]-->

	</head>

	<body <?php body_class(); ?>>

		<div class="page-wrap container">

			<header class="page-header" role="banner">

				<h1 class="site-heading">
					<a class="header__title site-title" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?> home page link"><?php bloginfo('name'); ?></a>
				</h1>

				<?php if (get_bloginfo('description')) : ?>
				<div class="header__description site-description"><?php bloginfo('description'); ?></div>
				<?php endif; ?>

				<nav class="header__menu main-navigation-menu main-navigation-menu__wrapper" role="navigation">
					<?php global $Main_Navigation_Menu;	$Main_Navigation_Menu->render(); ?>
				</nav>

			</header>

			<main class="page-content" role="main">
