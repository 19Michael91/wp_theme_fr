<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Food_Recipe
 * @since Food Recipe 1.0
 */
get_header(); ?>
<div class="row">
	<div class="left-content col-sm-9">	
	    <header class="page-header">
			<?php $archive_title = explode( ':', get_the_archive_title() );
                $taxonomy = $archive_title[0];
                $taxonomy_value = $archive_title[1];
                if ( $taxonomy == 'Tag'){
					echo "<div class='foodrecipe-archive-title'>
					    <span class='archive-taxonomy'>" . $taxonomy . "</span> : <span class='archive-taxonomy-value' style='text-transform : none;'>" . $taxonomy_value . '</span>
					</div>';
				} else {
					echo "<div class='foodrecipe-archive-title'>
					    <span class='archive-taxonomy'>" . $taxonomy . "</span> : <span class='archive-taxonomy-value'>" . $taxonomy_value . '</span>
					</div>';
				} ?>
		</header><!-- .page-header -->
		<div class="foodrecipe-content-meta row">
			<div class="col-sm-5">
				<?php global $wp_query;
				if ( $wp_query->post_count == 1 ) {
				    echo "<h2 class='count-post'>" . $wp_query->post_count . " post found"; 
                } else { 
                	echo "<h2 class='count-post'>" . $wp_query->post_count . " posts found";
                } ?>
			</div>
			<!-- Start the Loop. -->	
			<?php if ( have_posts() ) { ?>
				<!-- <div class="col-sm-6 select-line"> -->
				<div class="col-sm-7 select-line">
					<div class="count-display">
					    <?php $current_count = isset ( $_SESSION['foodrecipe_count_post'] ) && $_SESSION['foodrecipe_count_post'] > 0 ? $_SESSION['foodrecipe_count_post'] : '' ; ?>
						<form action="" method="post">
							<select>
								<option value="">Show <?php echo '' != $current_count ? $current_count . ' items' : '...' ?></option>
								<option value="1">Show 1 items</option>
								<option value="10">Show 10 items</option>
								<option value="20">Show 20 items</option>
								<option value="30">Show 30 items</option>
							</select>
						</form>
					</div>
					<div class="sort-display">
					    <?php $current_sort = isset ( $_SESSION['foodrecipe_sort_post'] ) && $_SESSION['foodrecipe_sort_post'] != '' ? $_SESSION['foodrecipe_sort_post'] : '' ; ?>
						<form action="" method="post">
							<select>
								<option value="">Sort By <?php echo '' != $current_sort ? ucfirst( $current_sort )  : '...' ?></option>
								<option value="title">Sort By Title</option>
								<option value="author">Sort By Author</option>
								<option value="date">Sort By Date</option>
								<option value="rand">Sort By Random</option>								
							</select>
						</form>
					</div>
					<span class="btn-info" data-toggle="modal" data-target="#foodrecipeloader"></span>
					<div id="foodrecipeloader" class="modal fade" role="dialog">
						<div class="loader"></div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$format = get_post_format(); ?>
				<div <?php post_class(); ?>>
					<h2><a class="foodrecipe-post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'foodrecipe' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<span class="foodrecipe-post-info"> POSTED BY <?php the_author_posts_link(); ?> / <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> 
																									/ LIKES 
																									/ COMMENTS 
																									/ <?php echo $edit_post = is_user_logged_in() ? edit_post_link( $link = 'EDIT', 
																																								    $before = '',
																																								    $after = '',
																																								    $id = get_the_ID() , 
																																								    $class = 'edit_post_link' ) : '';?> </span>
		            <div class="foodrecipe-post-categories">
		                <?php the_category(" / "); ?>
		            </div>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php } ?>
					<div class="entry">
						<?php if ( 'gallery' == get_post_format() ) {
							$gallery = get_post_gallery( get_the_ID(), false );
                            if ( isset( $gallery['ids'] ) ) {
								$gallery_ids = explode(',', $gallery['ids']); ?>
								<div class="gal-imgs row"> 
									<?php foreach ($gallery_ids as $image) { ?>
									  	<div class="gal-img-chld col-sm-6"> 
											<?php echo wp_get_attachment_image( $image, 'foodrecipe-gallery' ); ?>
										</div>
									<?php } ?>
								</div> <!-- End .gal-imgs -->
                            <?php } else { 
                            	$gallery = get_post_gallery( get_the_ID(), true ); 
                                echo $gallery;
                            } ?>
							<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
							<div class="foodrecipe-read-more"><a class="ghost-button-rounded-corners-2 foodrecipe-gal-bottom" href="<?php the_permalink(); ?>">VIEW MORE</a></div>
						<?php } else if ( 'image' == get_post_format() ) {
							the_content(); ?>
							<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
							<div class="foodrecipe-read-more"><a class="ghost-button-rounded-corners-2 image-post-button" href="<?php the_permalink(); ?>">VIEW MORE</a></div>
						<?php } else if ( 'video' == get_post_format() ) { 
							the_content(); ?>
							<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
						<?php } else { 
							the_content(); ?>
							<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
							<div class="foodrecipe-read-more"><a class="ghost-button-rounded-corners-2" href=" <?php the_permalink(); ?>">READ MORE</a></div>
					<?php } ?>
					</div> <!-- .entry -->
				</div> <!-- closes the first div box -->
			<?php }
			$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
			$big = 9999;
			global $wp_query;
			$args = array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'             => '?paged=%#%',
				'total' => $wp_query->max_num_pages,
				'current' => max( 1, get_query_var('paged') ),
				'show_all'           => false,
				'end_size'           => 1,
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
				'next_text'          => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
				'type'               => 'plain',
				'add_args'           => false,
				'add_fragment'       => '',
				'before_page_number' => '',
				'after_page_number'  => ''
			); ?>
			<div class="foodrecipe-pagination">
				<?php echo paginate_links( $args ); ?>
			</div>
		 <?php } else { ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'foodrecipe' ); ?></p>
		<?php 
		}; ?>
	</div><!-- .left-content -->
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>

