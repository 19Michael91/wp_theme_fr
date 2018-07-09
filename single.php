<?php get_header(); ?>
<div class="row">
	<div class="single-left-content col-sm-9">
		<!-- Start the Loop. -->
		<?php $defaults = array(
			'before'           => '<p  id="single-post-pagination"><span class="single-post-paginationspan">' . __( 'Pages:', 'foodrecipe' ) . '</span>&emsp;',
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => '&emsp; <span class="single-post-paginationspan">|</span> &emsp;',
			'nextpagelink'     => __( 'Next page', 'foodrecipe'),
			'previouspagelink' => __( 'Previous page', 'foodrecipe' ),
			'pagelink'         => '%',
			'echo'             => 1
	    );
		if ( have_posts() ) { 
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
					<div class="single-post-thumbnail post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php } ?>
				<div class="entry">
					<?php if ( 'gallery' == get_post_format() ) {
                            the_content();  ?>
						<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
					<?php } else if ( 'image' == get_post_format() ) {
						the_content(); ?>
						<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
					<?php } else if ( 'video' == get_post_format() ) { 
						the_content(); ?>
						<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
					<?php } else { 
						the_content(); ?>
						<div class="foodrecipe-post-tags"><?php the_tags('tags : ','&nbsp;,&nbsp;'); ?></div>
				<?php } ?>
				</div> <!-- .entry -->
			</div> <!-- closes the first div box -->
		 <?php wp_link_pages($defaults); } else { ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'foodrecipe' ); ?></p>
		<?php }
		comments_template();; ?>
	</div><!-- .left-content -->
	<?php get_sidebar(); ?>
</div>
<?php //comments_template( '/comments.php', true );

get_footer(); ?>