<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Food Recipe
 * @since Food Recipe 1.0
 */
get_header(); ?>
	<div class="row">
		<div class="left-content col-sm-9">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<header class="page-header">
						<h1 class="page-title"><?php _e( 'Not Found: Error 404', 'foodrecipe' ); ?></h1>
					</header>
					<div class="page-wrapper">
						<div class="page-content">
							<h2><?php _e( "This is somewhat embarrassing, isn't it?", 'foodrecipe' ); ?></h2>
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'foodrecipe' ); ?></p>
						</div><!-- .page-content -->
					</div><!-- .page-wrapper -->
				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- .left-content -->
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>