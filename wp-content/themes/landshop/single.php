<?php get_header(); ?>

<?php 
get_template_part('components/layouts/site_header'); 

	if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt = array();
		$landshop_opt['single_releted_tag'] = '1';
		$landshop_opt['single_post_share'] = 'false';
		$landshop_opt['single_post_nav'] = '1';
		$landshop_opt['single_author_info'] = '1';
	}	
?>
<!-- Post_List_Area-Start -->
<section class="blog-detials section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-8' : '' ); ?>">
                <div class="<?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'pe-lg-4' : '' ); ?>">
                    <div class="single_post-box">
                        <?php 
                        while(have_posts()):
                        the_post();
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'components/post-formats/post', get_post_format() );
                         // End the loop.

                        //Populer post view count function
                        if( function_exists('landshop_set_post_views') ){
                            landshop_set_post_views(get_the_ID());
                        }
                    ?>
                        <div class="single_tags_share">
                            <?php if(has_tag() && $landshop_opt['single_releted_tag'] == '1'): ?>
                            <div class="post_related-tag">
                                <?php echo get_the_tag_list( '<div class="tags">',' ','</div>'); ?>
                            </div>
                            <?php endif; ?>
                            <?php 
                            if(function_exists('landshop_post_share_social') && $landshop_opt['single_post_share'] == '1'):
                                landshop_post_share_social();
                            endif;
                        ?>
                        </div>
                        <?php
                        if( !empty(get_the_author_meta('description')) and $landshop_opt['single_author_info'] == '1' ): ?>
                        <div class="single_author_info">
                            <?php 
                                $user_pic = get_avatar_url(get_the_author_meta('ID'), array('size' => 450));
                                if(!empty($user_pic)){
                                    printf( '<figure class="author_pic" style="background-image: url(%s);"></figure>', esc_url($user_pic) );  
                                }
                            ?>
                            <div class="author_content">
                                <h4 class="author_name"><?php esc_html_e('About','landshop'); echo ' '; echo str_replace('_',' ', get_the_author()); ?></h4>
                                <div class="author_desc">
                                    <?php echo wpautop(esc_html(get_the_author_meta('description'))); ?>
                                </div>
                                <div class="social-link">
                                    <?php if(!empty(get_the_author_meta('_landshop_user_twitter'))): ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('_landshop_user_twitter')); ?>"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty(get_the_author_meta('_landshop_user_facebook'))): ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('_landshop_user_facebook')); ?>"><i class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty(get_the_author_meta('_landshop_user_linkedin'))): ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('_landshop_user_linkedin')); ?>"><i class="fab fa-linkedin-in"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty(get_the_author_meta('_landshop_user_instagram'))): ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('_landshop_user_instagram')); ?>"><i class="fab fa-instagram"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty(get_the_author_meta('_landshop_user_pinterest'))): ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('_landshop_user_pinterest')); ?>"><i class="fab fa-pinterest-p"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(get_the_post_navigation() && $landshop_opt['single_post_nav'] == '1'): ?>
                        <div class="post_nav">
                            <?php
                            // Previous/next post navigation.
                            the_post_navigation(array(                                            
                                'prev_text' => '                                            
                                <div class="post_nav_item">
                                    <span class="post_nav_arrow"><i class="fal fa-long-arrow-left"></i></span>
                                    '.( get_previous_post() && get_the_post_thumbnail(get_previous_post()->ID, 'thumbnail') ? '<div class="post_image"><figure>'.get_the_post_thumbnail(get_previous_post()->ID, 'thumbnail').'</figure></div>' : '' ).'
                                    <div class="post_nav_text">
                                        <span class="post_nav_label">'.esc_attr__('Previous Story','landshop').'</span>
                                        <br>
                                        <span class="post_nav_title">%title</span>
                                    </div>
                                </div>',
                                'next_text' => '                                            
                                <div class="post_nav_item">
                                    <span class="post_nav_arrow"><i class="fal fa-long-arrow-right"></i></span>
                                    '.( get_next_post() && get_the_post_thumbnail(get_next_post()->ID, 'thumbnail') ? '<div class="post_image"><figure>'.get_the_post_thumbnail(get_next_post()->ID, 'thumbnail').'</figure></div>' : '' ).'
                                    <div class="post_nav_text">
                                        <span class="post_nav_label">'.esc_attr__('Next Story','landshop').'</span>
                                        <br>
                                        <span class="post_nav_title">%title</span>
                                    </div>
                                </div>',          
                            ));
                        ?>
                        </div>
                        <?php endif; ?>
                        <?php                                                      
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }  
                    endwhile; 
                    ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-4 mt-5 mt-lg-0' : '' ); ?>">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>
<!-- Post_List_Area-End -->
<?php get_footer(); ?>