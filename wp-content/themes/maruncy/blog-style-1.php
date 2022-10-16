<?php
/**
Template Name: Blog Style One
**/
get_header();


if ( class_exists( 'Redux' ) ) {
    global $maruncy_opt;
}else{
    $maruncy_opt = array();
    $maruncy_opt['post_thumbnail'] = '1';
    $maruncy_opt['post_title'] = '1';
    $maruncy_opt['title_length'] = '15';
    $maruncy_opt['post_meta'] = '1';
    $maruncy_opt['post_desc_format'] = 'excerpt';
    $maruncy_opt['post_desc_lenth'] = '30';
    $maruncy_opt['post_read_more'] = false;
    $maruncy_opt['post_read_more_txt'] = __('Read More','maruncy');
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
if( $p_query->have_posts() ){   
?>
    <section class="section_padding page-section blog-style-1">
        <div class="container">
            <div class="row masonrys g-5">                           
               <?php                             
               // Start the loop.
                while($p_query->have_posts()){
                    $p_query->the_post();
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    echo '<div class="col-md-6 box-item">';
                    ?>
                    <div <?php post_class(['post-box',get_post_type()]); ?>>
                        <?php 
                            if($maruncy_opt['post_thumbnail'] == '1'){
                                if(has_post_thumbnail()){
                                    maruncy_post_thumbnail('large');
                                }else{
                                    echo '<figure class="post_media"><a href="'.get_permalink().'"><img src="'.get_theme_file_uri('assets/images/placeholder.jpg').'" alt="'.esc_attr__('Placeholder','maruncy').'"></a></figure>';
                                }
                            }
                        ?>
                        <div class="content">
                            <?php if($maruncy_opt['post_title'] == '1' && get_the_title()): ?>
                              <h2 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $maruncy_opt['title_length'], '...' ); ?></a></h2>
                            <?php endif; ?>
                            <div class="desc">
                                <?php
                                   if($maruncy_opt['post_desc_format'] == 'excerpt'){
                                        echo get_the_excerpt();
                                   }elseif($maruncy_opt['post_desc_format'] == 'full'){
                                       the_content(
                                            sprintf(
                                                esc_html__( 'Continue reading %s', 'maruncy' ),
                                                the_title( '<span class="screen-reader-text">', '</span>', false )
                                            )
                                        );
                                   }elseif($maruncy_opt['post_desc_format'] == 'custom'){
                                       echo wp_trim_words( get_the_content(), $maruncy_opt['post_desc_lenth'], '...' );
                                   }               
                               ?>
                            </div>
                        </div>
                    </div>
                   <?php
                    echo '</div>';
                     // End the loop.
                }                       
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
                            'prev_text' => '<i class="mr-arrow-left-icon"></i>',
                            'next_text' => '<i class="mr-arrow-right-icon"></i>',
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