<?php
/**
Template Name: Case Studies One
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
            'post_type'=> 'case-studie',
            'posts_per_page'=> get_option('posts_per_page'),
            'paged' => $paged,
        );
        $p_query = new WP_Query( $args );
        if( $p_query->have_posts()){      
    ?>
<section class="section-padding page-section">
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
            <div class="col-md-6">
                <div class="case_studie_box box-1">
                    <?php if(has_post_thumbnail()): ?>
                    <figure class="photo">
                        <?php the_post_thumbnail('landshop_540x430'); ?>
                    </figure>
                    <?php endif; ?>
                    <div class="case_studie_content">
                        <a href="<?php the_permalink(); ?>" class="link-arrow">
                            <svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-external"></use></svg>
                        </a>
                        <div class="w-100">
                            <?php echo get_the_term_list( get_the_ID(), 'case-studie-category', '<div class="cats">', ' ', '</div>' ); ?>
                            <?php if(get_the_title()): ?>
                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <?php endif; ?>
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
</section>
<?php
        }else{
            // If no content, include the "No posts found" template.
            get_template_part( 'components/post-formats/post', 'none' );
        } 
    ?>
<!-- Post_List_Area-End -->
<?php get_footer();