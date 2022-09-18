<?php
/**
Template Name: Blog Template Two
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
            <div class="row justify-content-center">
            <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-8' : '' ); ?>">
                <div class="<?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'pe-lg-4' : '' ); ?>">            
                        <div class="row g-4 masonrys">                           
                           <?php                           
                           // Start the loop.
                            while($p_query->have_posts()){
                                $p_query->the_post();
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                echo '<div class="'.(is_active_sidebar( 'main_sidebar' ) ? 'col-md-6'  : 'col-lg-4 col-md-6' ).'">';
                                    ?>
                                       <div <?php post_class('post-box box-style-2'); ?>>
                                            <a href="<?php the_permalink(); ?>" class="thumb">
                                                <?php
                                                    the_post_thumbnail('landshop_370x266');
                                                ?>
                                            </a>
                                            <div class="content">                                               
                                                <div class="meta_list">
                                                    <ul>
                                                        <?php if(landshop_get_post_date()): ?>
                                                        <li class="date">
                                                            <svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-calander"></use></svg>
                                                            <?php echo landshop_get_post_date('j F, Y'); ?>
                                                        </li>
                                                        <?php endif; ?>
                                                        <?php if(get_the_author()): ?>
                                                        <li class="author">
                                                            <svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-profile"></use></svg>
                                                            <?php echo get_the_author(); ?>
                                                        </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <?php if($landshop_opt['post_title'] == '1' && get_the_title() && !is_single()): ?>
                                                <h4 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $landshop_opt['title_length'], '...' ); ?></a></h4>
                                                <?php endif; ?>  
                                                <a href="<?php echo get_the_permalink(); ?>" class="read-more-button"><?php echo wp_kses_post($landshop_opt['post_read_more_txt']); ?></a>
                                            </div>
                                        </div>
                                   <?php
                                echo '</div>';
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