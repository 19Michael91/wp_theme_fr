<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="body-container">
		<div class="header">
			<div class="top-header">
				<div class="container">
					<div class="wrapper">
						<div class="row">
						<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							if ( has_custom_logo() ) {
								echo '<a href="' . get_home_url() . '" class="logo col-lg-3 col-sm-5 col-xs-12">';
						        echo '<img src="'. esc_url( $logo[0] ) .'" class="logo-img">';
						        echo '<h1 class="logo-text">' . get_bloginfo( 'name' ) . '</h1></a><!-- .logo -->';
							} else {
						        echo '<a href="#" class="logo col-lg-3 col-sm-5 col-xs-12"><h1 class="logo-text">'. get_bloginfo( 'name' ) .'</h1></a>';
							}
							wp_nav_menu( array(
    							'theme_location' => 'primary',
    							'container_class' => 'top-menu col-lg-6 hidden-md hidden-sm hidden-xs') );
							?>
							<div class="buttons-top-menu col-lg-3 col-sm-6 col-xs-12">
								<button class="btn-top-menu-1">REGISTER</button>
								<button class="btn-top-menu-2">LOGIN</button>
								
							</div><!-- .buttons-top-menu -->
								<nav class="navbar navbar-default hidden-lg col-sm-1">
								  	<div class="container-fluid">
								    	<div class="navbar-header">
								      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
								        		<span class="icon-bar"></span>
								        		<span class="icon-bar"></span>
								        		<span class="icon-bar"></span>
								      		</button>
								    	</div>
								    	<div class="collapse navbar-collapse" id="navbar-main">
								    			<span class="glyphicon glyphicon-remove fooderecipe-menu-close"></span>
								    		<?php
								    		wp_nav_menu( array(
    											'theme_location' => 'primary',
    											'container_class' => 'top-menu') ); ?>
								    	</div><!-- .navbar-collapse -->
								  </div><!-- .container-fluid -->
								</nav><!-- .navbar-default -->
								<!--  -->
						</div><!-- .row -->	
					</div><!-- .wrapper -->
				</div><!-- .container -->
			</div><!-- .top-header -->
			<div class="slider">
				<div class="wrapper">
					<div id="myCarousel" class="carousel slide" data-interval="0" data-ride="carousel">
						<div class="carousel-inner">
					    	<div class="active item">
					    		<div class="carousel-caption" style="background-image: url(<?php echo get_template_directory_uri().'/images/header/slider/slider_image_1.jpg'; ?>);">
					        		<h1 class="slider-title">LOREM IPSUM DOLOR</h1>
										<h4 class="slider-h4-1 container">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</h4>
										<a class="ghost-button-rounded-corners" href="#">READ MORE</a>
					    		</div><!-- carousel-caption -->
					    	</div><!-- .active item -->
					    	<div class="item">
					    		<div class="carousel-caption" style="background-image: url(<?php echo get_template_directory_uri().'/images/header/slider/slider_image_2.jpg'; ?>);">
					        		<h1 class="slider-title">LOREM IPSUM DOLOR</h1>
										<h4 class="slider-h4-1 container">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</h4>
										<a class="ghost-button-rounded-corners" href="#">READ MORE</a>
					    		</div><!-- .carousel-caption -->
					    	</div><!-- .item -->
					    	<div class="item">
					    		<div class="carousel-caption" style="background-image: url(<?php echo get_template_directory_uri().'/images/header/slider/slider_image_3.jpg'; ?>);">
					        		<h1 class="slider-title">LOREM  IPSUM  DOLOR</h1>
										<h4 class="slider-h4-1 container">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</h4>
										<a class="ghost-button-rounded-corners" href="#">READ MORE</a>
					    		</div><!-- .carousel-caption -->
					    	</div><!-- .item -->
						</div><!-- .carousel-inner -->
							<div class="slider-btn-box">
							  	<a class="carousel-control left slider-btn-back" href="#myCarousel" data-slide="prev">
							    	<span class="glyphicon glyphicon-chevron-left"></span>
							  	</a>
							  	<a class="carousel-control right slider-btn-next" href="#myCarousel" data-slide="next">
							    	<span class="glyphicon glyphicon-chevron-right"></span>
							  	</a>
							</div>
					</div><!-- carousel slide -->
				</div><!-- .wrapper -->
			</div><!-- .slider -->
		</div><!-- .header -->
		<div class="content">
			<div class="wrapper container">
