<!DOCTYPE html> 
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Sunflower:300" rel="stylesheet">
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">
		<header id="header">
			<?php if (has_nav_menu('topbar')): ?>
			<nav class="nav-container group" id="nav-topbar" style="background-color:#5b5b5b">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>

				<div class="container">
					<div class="container-inner">
						<div class="toggle-search"><i class="fa fa-search"></i></div>
						<div class="search-expand">
							<div class="search-expand-inner">
								<?php get_search_form(); ?>
							</div>
						</div>

						<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
						<div id="header-widget-area" class="hw-widget widget-area" role="complementary">
							<?php dynamic_sidebar( 'header-widget' ); ?>
						</div>
						<?php endif; ?>
					</div><!--/.container-inner-->
				</div><!--/.container-->
			</nav><!--/#nav-topbar-->
			<?php endif; ?>

			<div class=" group" id="before-navbar">
				<div class="container-inner">
					<div class="group pad">
						<?php echo alx_site_title(); ?>
						<?php if ( ot_get_option('site-description') != 'off' ): ?><p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>
						<!--<h1 class="site-title titlepad">Megatron ITB - under construction</h1>
						<h2>Institut Teknologi Bandung</h2>-->
					</div>
				</div>
			</div>

			<div class="container group" id="after-navbar">
				<div class="container-inner">
					<?php if (has_nav_menu('header')): ?>
						<nav class="nav-container group" id="nav-header">
							<div class="nav-toggle"><i class="fa fa-bars"></i></div>
							<div class="nav-text"><!-- put your mobile menu text here --></div>
							<div class="nav-wrap" style="text-align: center;"><?php wp_nav_menu(array('theme_location'=>'header','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
						</nav><!--/#nav-header-->
						<?php endif; ?>
				</div><!--/.container-inner-->
			</div>

			<?php if (is_page('Home')): ?>
			<div class="container group" id="after-navbar-slider" style="padding-top: 2.5rem !important; padding-bottom: 3rem !important;">
				<div class="container-inner">
					<?php echo do_shortcode('[wonderplugin_slider id=2]'); ?>
				</div><!--/.container-inner-->
			</div><!--/.container-->
			<?php endif; ?>
		</header><!--/#header-->

		<?php if (!is_page('Home')): ?>
		<div class="containerall cd-fixed-bg cd-fixed-bg--2" id="page">
			<div class="container-inner">
				<div class="main" ><!-- 
					<div class="main-inner group"> -->
		<?php endif; ?>