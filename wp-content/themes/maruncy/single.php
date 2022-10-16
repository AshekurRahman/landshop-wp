<?php get_header(); ?>

<?php 
get_template_part('components/layouts/site_header'); 

	if ( class_exists( 'Redux' ) ) {
		global $maruncy_opt;
	}else{
		$maruncy_opt = array();
		$maruncy_opt['single_releted_tag'] = '1';
		$maruncy_opt['single_post_share'] = 'false';
		$maruncy_opt['single_post_nav'] = '1';
		$maruncy_opt['single_author_info'] = '1';
	}	
?>
        <!-- Post_List_Area-Start -->
        <section class="blog-detials section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-8 pr-lg-5' : '' ); ?>">                          
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
                            if( function_exists('maruncy_set_post_views') ){
                                maruncy_set_post_views(get_the_ID());
                            }

                            if( !empty(get_the_author_meta('description')) and $maruncy_opt['single_author_info'] == '1' ): ?>
                            <div class="single_author_info">     
                                <div class="header_info">                                            
                                    <?php 
                                        $user_pic = get_avatar( get_the_author_meta( 'ID' ) , 100 );                            
                                        if(!empty($user_pic)){
                                            printf( '<figure class="author_pic">%s</figure>', $user_pic );  
                                        }
                                    ?>
                                    <div>
                                        <span class="writer"><?php esc_html_e( 'Written By','maruncy' ); ?></span>
                                        <h3 class="author_name"><?php the_author(); ?></h3>
                                    </div>
                                </div>                                        
                                <?php echo wpautop(esc_html(get_the_author_meta('description'))); ?>
                            </div>
                            <?php endif; ?>
                            <div class="single_tags_share">
                                <?php if(has_tag() && $maruncy_opt['single_releted_tag'] == '1'): ?>
                                <div class="post_related-tag">
                                    <?php echo get_the_tag_list( '<div class="tags">',' ','</div>'); ?>
                                </div>
                                <?php endif; ?>
                                <?php 
                                    if(function_exists('maruncy_post_share_social') && $maruncy_opt['single_post_share'] == '1'):
                                        maruncy_post_share_social();
                                    endif;
                                ?>
                            </div>
                            <?php if(get_the_post_navigation() && $maruncy_opt['single_post_nav'] == '1'): ?>
                                <div class="single_navigation">
                                    <?php
                                        // Previous/next post navigation.
                                        the_post_navigation(array(
                                            'prev_text' => '<div class="icon"><i class="fal fa-arrow-left"></i></div><div class="content"><div class="label">'. __('Previous Post','maruncy') .'</div><h5 class="title">%title</h5></div>',
                                            'next_text' => '<div class="icon"><i class="fal fa-arrow-right"></i></div><div class="content"><div class="label">'. __('Next Post','maruncy') .'</div><h5 class="title">%title</h5></div>'
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
                    <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-4 mt-5 mt-lg-0' : '' ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Post_List_Area-End -->
<?php get_footer(); ?>






