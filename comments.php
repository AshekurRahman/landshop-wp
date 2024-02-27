<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package landshop
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

<div class="comment-section-area">    
    <?php
    /*---------------------------------------------------------------------------------------
    If comments are closed and there are comments, let's leave a little note, shall we?
    ----------------------------------------------------------------------------------------*/
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'landshop' ); ?></p>
    <?php endif; ?>
    <?php if ( have_comments() ) : ?>
    <div class="comment_list_area">
        <h3 class="comments_title">
            <?php
                $comments_number = get_comments_number();
                if ( '1' === $comments_number ) {
                    /* translators: %s: post title */
                    printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'landshop' ), get_the_title() );
                } else {
                    printf(
                        /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s Comment',
                            '%1$s Comments',
                            $comments_number,
                            'comments title',
                            'landshop'
                        ),
                        number_format_i18n( $comments_number ),
                        get_the_title()
                    );
                }
            ?>
        </h3>
        <ol class="comments_list">
            <?php
                wp_list_comments(
                    array(
                        'style'       => 'ul+',
                        'short_ping'  => true,
                        'avatar_size' => 100
                    )
                );
            ?>
        </ol>
        <?php 
            $paginet = array(
                'prev_text' => '<i class="fa-light fa-angle-left"></i>',
                'next_text' => '<i class="fa-light fa-angle-right"></i>',
                'screen_reader_text' => ' ',
                'type' => 'array',
                'show_all' => true,
            );
            the_comments_pagination( $paginet );
        ?>
    </div>     
          
    <?php endif; 
    
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $landshop_comment_fields =  array(        
        'author' => '<div class="col-lg-6"><p class="comment-form-field"><input id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ).'" size="30" '. $aria_req .' '. $aria_req .' placeholder="'.esc_attr__('Type your name...','landshop').'"></p></div>',

        'email' => '<div class="col-lg-6"><p class="comment-form-field"><input id="email" name="email" type="email" size="30" value="'.esc_attr( $commenter['comment_author_email'] ).'" '. $aria_req .' placeholder="'.esc_attr__('Type your email...','landshop').'" ></p></div>',

        'url' => '<div class="col-lg-12"><p class="comment-form-field"><input id="url" name="url" type="url" value="'.esc_attr( $commenter['comment_author_url'] ).'" placeholder="'.esc_attr__('Type your url...','landshop').'" ></p></div>',   

        'cookies' => '<div class="col-lg-12"><p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . ' <label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'landshop' ) . '</label></p></div>'        
        
    );            
    comment_form( array(
        'fields' => apply_filters( 'comment_form_default_fields', $landshop_comment_fields ),
        'comment_field' => '<div class="col-lg-12"><p class="comment-form-field"><textarea id="comment" name="comment" cols="45" rows="8" required="required" placeholder="'.esc_attr__('Type your comment...','landshop').'"></textarea></p></div>',
        'class_submit' => 'primary_button',
        'class_form' => 'comment-form row g-3',
        'logged_in_as' => '<div class="col-lg-12"><p class="logged-in-as">'. esc_html__( 'Logged in as ','landshop' ) .sprintf( '<a href="%1$s">%2$s</a>. <a href="%3$s" title="'.esc_attr__('Log out of this account','landshop').'">'.esc_html__( 'Log out?','landshop' ).'</a>' ,admin_url( 'profile.php' ),$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( )))) . '</p></div>',
        'title_reply' => esc_html__( 'Post Comment', 'landshop' )
    ) );
    
    ?>
</div>