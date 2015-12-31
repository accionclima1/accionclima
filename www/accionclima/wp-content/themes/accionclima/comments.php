<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ac_tk_comment() which is
 * located in the includes/template-tags.php file.
 *
 * @package ac_tk
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<header>
			<h3 class="comments-title">
				Comentarios
			</h3>
		</header>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h5 class="screen-reader-text"><?php _e( 'Comment navigation', 'ac_tk' ); ?></h5>
			<ul class="pager">
				<li class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ac_tk' ) ); ?></li>
				<li class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ac_tk' ) ); ?></li>
			</ul>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list media-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use ac_tk_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define ac_tk_comment() and that will be used instead.
				 * See ac_tk_comment() in includes/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'ac_tk_comment', 'avatar_size' => 130 ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'ac_tk' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ac_tk' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ac_tk' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'ac_tk' ); ?></p>
	<?php endif; ?>

	<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(

		  'author' =>
		    '<div class="comment-form-author form-group"> ' .
		    ( $req ? '' : '' ) .
		    '<input id="author" class="form-control" placeholder="Nombre" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' /></div>',

		  'email' =>
		    '<div class="comment-form-email form-group"> ' .
		    ( $req ? '' : '' ) .
		    '<input id="email" class="form-control" name="email" placeholder="Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' /></div>',

		  'url' =>
		    '',
		);
	comment_form( $args = array(
			  'id_form'           => 'commentform',  // that's the wordpress default value! delete it or edit it ;)
			  'class_form'      => 'form-inline',
			  'id_submit'         => 'commentsubmit',
			  'title_reply'       => __( '', 'ac_tk' ),  // that's the wordpress default value! delete it or edit it ;)
			  'title_reply_to'    => __( '', 'ac_tk' ),  // that's the wordpress default value! delete it or edit it ;)
			  'cancel_reply_link' => __( 'Cancel Reply', 'ac_tk' ),  // that's the wordpress default value! delete it or edit it ;)
			  'label_submit'      => __( 'Enviar', 'ac_tk' ),  // that's the wordpress default value! delete it or edit it ;)
			  'comment_notes_before' => '',

			  'fields' => apply_filters( 'comment_form_default_fields', $fields ),

			  'comment_field' =>  '<div><textarea placeholder="Comentario" id="comment" class="form-control" name="comment" cols="45" rows="4" aria-required="true"></textarea></div>',

			  'comment_notes_after' => ''

			  // So, that was the needed stuff to have bootstrap basic styles for the form elements and buttons

			  // Basically you can edit everything here!
			  // Checkout the docs for more: http://codex.wordpress.org/Function_Reference/comment_form
			  // Another note: some classes are added in the bootstrap-wp.js - ckeck from line 1

	));

	?>

</div><!-- #comments -->
