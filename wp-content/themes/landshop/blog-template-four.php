<?php
/**
Template Name: Blog Right Sidebar
**/
get_header();


if ( class_exists( 'Redux' ) ) {
    global $landshop_opt;
}else{
    $landshop_opt = array();
    $landshop_opt['post_thumbnail'] = '1';
    $landshop_opt['post_title'] = '1';
    $landshop_opt['title_length'] = '15';
    $landshop_opt['post_desc_format'] = 'excerpt';
    $landshop_opt['post_desc_lenth'] = '30';
    $landshop_opt['post_read_more'] = false;
    $landshop_opt['post_read_more_txt'] = esc_html__('Read More','landshop');
}	

get_template_part('components/layouts/site_header'); ?>
    <!-- Post_List_Area-Start -->
    <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type'=> 'post',
            'posts_per_page'=> get_option('posts_per_page'),
            'paged' => $paged,
        );
        $p_query = new WP_Query( $args );
        if( $p_query->have_posts()){      
    ?>
    <section class="posts_list-area section-padding page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-8' : '' ); ?>">
                    <div class="<?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'pe-lg-4' : '' ); ?>">
                        <div class="posts_list">
                           <?php                           
                           // Start the loop.
                            while($p_query->have_posts()){
                                $p_query->the_post();
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */                                
                                get_template_part( 'components/post-formats/post', get_post_format() );
                                // End the loop.
                            }    
                            wp_reset_postdata();                   
                        ?>
                        </div>
                        <?php
                            $total_pages = $p_query->max_num_pages;
                            if ($total_pages > 1 ){
                                $current_page = max(1, get_query_var('paged'));
                                echo '<div class="navigation pagination"><div class="nav-links text-center">';
                                echo paginate_links(array(
                                        'base'          => get_pagenum_link(1) . '%_%',
                                        'format'        => '/page/%#%',
                                        'current'       => $current_page,
                                        'total'         => $total_pages,
                                        'prev_text' => '<i class="fal fa-angle-double-left"></i>',
                                        'next_text' => '<i class="fal fa-angle-double-right"></i>',
                                        'end_size'      => 3,
                                        'mid_size'      => 2,
                                        'prev_next'     => true,
                                        'type'          => 'plain',
                                    ));
                                echo '</div></div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-4 mt-5 mt-lg-0' : '' ); ?>">
                        <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
        <?php
            }else{
                // If no content, include the "No posts found" template.
                get_template_part( 'components/post-formats/post', 'none' );
            } 
        ?>
        <!-- Post_List_Area-End -->
<?php get_footer();