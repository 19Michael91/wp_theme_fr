<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Food Recipe
 * @since Food Recipe 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="row">
	<div id="comments" class="comments-area col-sm-12">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					echo 'COMMENTS <span class="comments-count">(' . get_comments_number() . ')</span>';
				?>
			</h2>
			<ol class="comment-list">
				<?php 
				//Вывод комментариев
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 90,
					'callback'    => 'foodrecipe_comment',
				) ); 
				?>
				</ul>						
			</ol><!-- .comment-list -->
			<?php  
			the_comments_pagination($defaults = array(
				'screen_reader_text' => 'Comments navigation',
				// из функции paginate_comments_links():
				'base'    => add_query_arg( 'cpage', '%#%' ),
				'format'  => '',
				//'total'   => $max_page,
				//'current' => $page,
				'echo'    => true,
				'add_fragment' => '#comments', 'prev_text' => '&laquo;', 'next_text' => '&raquo;'
				//'prev_text' => '&laquo;', 'next_text' => '&raquo;'
			) );
    endif; // have_comments() ?>
		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() &&  post_type_supports( get_post_type(), 'comments' ) ) : 
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'foodrecipe' ); ?></p>
		<?php endif; ?>

		<?php $defaults = array(
							'fields'               => array(
														'author' => '<p class="comment-form-author" style="display: inline-block; float: left;"> 
														                <input id="author" placeholder="Username" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
														            </p>',
														'email'  => '<p class="comment-form-email" style="display: inline-block; float: left;"><label for="email">
														                <input id="email" placeholder="Your email*" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes" />
														            </p>',
														'url'    => '<p class="comment-form-url" style="display: inline-block; float: left;"><label for="url">
														                <input id="url" placeholder="Your website" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
														            </p>',
													),
							'comment_field'        => '<p class="comment-form-comment">
							                               <textarea placeholder="Your message" id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea>
							                           </p>',
							'comment_notes_before' => '',
							'comment_notes_after'  => '',
							'id_form'              => 'commentform',
							'id_submit'            => 'submit',
							'class_form'           => 'comment-form',
							'class_submit'         => 'submit',
							'name_submit'          => 'submit',
							'title_reply'          => 'Leave a comment',
							'title_reply_to'       => 'Leave a comment to %s',
							'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
							'title_reply_after'    => '</h3>',
							'cancel_reply_before'  => ' <small>',
							'cancel_reply_after'   => '</small>',
							'cancel_reply_link'    => 'Cancel reply',
							'label_submit'         => 'Post Comment',
							'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="leave a comment" />',
							'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
							'format'               => 'xhtml',
							'logged_in_as'         => ''
						);

		comment_form( $defaults ); ?>
	</div><!-- .comments-area -->
</div>