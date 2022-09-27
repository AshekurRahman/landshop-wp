<?php
/**
Template Name: Blog Template One
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
    <section class="section-padding page-section blog-style-5">
        <div class="container">
            <div class="row g-4 load-post">                           
               <?php                           
               // Start the loop.
                while($p_query->have_posts()){
                    $p_query->the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                        ?>
                        <div class="col-lg-4 col-md-6">
                           <div <?php post_class('post-box box-style-2'); ?>>
                                <a href="<?php the_permalink(); ?>" class="thumb">
                                    <?php
                                        the_post_thumbnail('full');
                                    ?>
                                </a>
                                <div class="content"> 
                                    <h4 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="footer_meta_list">
                                        <ul>
                                          <?php if(get_the_category()): ?>
                                           <li class="category">
                                               <a href="<?php echo get_category_link(get_the_category()[0]->cat_ID); ?>"><?php echo get_the_category()[0]->name; ?></a>
                                           </li>
                                           <?php endif; ?>
                                            <?php if(landshop_get_post_date()): ?>
                                            <li class="date">
                                                <?php echo landshop_get_post_date('Y M D'); ?>
                                            </li>
                                            <?php endif; ?>
                                            <li class="link-arrow">
                                                <a href="<?php echo get_permalink(); ?>"><i class="fal fa-arrow-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>                                             
                                </div>
                            </div>
                        </div>
                       <?php
                    // End the loop.
                }  
                wp_reset_postdata();                     
                wp_reset_query();                     
            ?>
            </div>
            <div class="text-center mt-5">
                <button class="primary_button loadmore"><?php esc_html_e('Load More','landshop'); ?></button>
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