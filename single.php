<?php
// Include header and site header
get_header();
get_template_part('components/layouts/site_header');
?>

<!-- Post List Area Start -->
<section class="post__single section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            // Determine column classes based on sidebar activation
            $col_classes = is_active_sidebar('main_sidebar') ? 'col-lg-8' : '';
            $col_classes_sm = 'col-sm-12 ' . $col_classes;
            $sidebar_classes = is_active_sidebar('main_sidebar') ? 'col-lg-4 mt-5 mt-lg-0' : '';
            ?>

            <div class="<?php echo esc_attr($col_classes_sm); ?>">
                <div class="<?php echo (is_active_sidebar('main_sidebar') ? 'pe-lg-4' : ''); ?>">
                    <div class="single__post">
                        <?php
                        // Loop through posts
                        while (have_posts()) : the_post();

                            // Display post title if it exists
                            if (get_the_title()) :
                                echo '<h2 class="post__title">' . esc_html(get_the_title()) . '</h2>';
                            endif;

                            if (get_the_author() || landshop_get_post_date() || landshop_get_comment_count() || get_the_category_list() || get_the_tag_list()) : ?>
                                <ul class="post__meta">
                                    <?php if (get_the_author()) : ?>
                                        <li class="author"><i class="fa-light fa-user icon"></i><?php the_author(); ?></li>
                                    <?php endif; ?>
                                    <?php if ($post_date = landshop_get_post_date()) : ?>
                                        <li class="date"><i class="fa-light fa-calendar-days icon"></i><?php echo wp_kses_post($post_date); ?></li>
                                    <?php endif; ?>
                                    <?php if ($comment_count = landshop_get_comment_count()) : ?>
                                        <li class="comment"><i class="fa-light fa-comments icon"></i><?php echo wp_kses_post($comment_count); ?></li>
                                    <?php endif; ?>
                                    <?php if (get_the_category_list()) : ?>
                                        <li class="tag"><i class="fa-light fa-folders icon"></i><?php echo get_the_category_list(', &nbsp;', ' '); ?></li>
                                    <?php endif; ?>
                                    <?php if (get_the_tag_list()) : ?>
                                        <li class="tags"><i class="fa-light fa-tags icon"></i><?php echo get_the_tag_list(' ', ', &nbsp;'); ?></li>
                                    <?php endif; ?>

                                </ul>
                            <?php endif; ?>
                            

                            <?php
                            // Display the post content
                            the_content(
                                sprintf(
                                    esc_html__('Continue reading %s', 'landshop'),
                                    the_title('<span class="screen-reader-text">', '</span>', false)
                                )
                            );

                            // Display page links
                            wp_link_pages(array(
                                'before'          => '<div class="pagination"><span class="page-links-title">' . esc_html__('Pages:', 'landshop') . '</span>',
                                'after'           => '</div>',
                                'link_before'     => '<span class="page-numbers" >',
                                'link_after'      => '</span>',
                                'next_or_number'  => 'number',
                                'nextpagelink'    => '<i class="fa-light fa-angle-right"></i>',
                                'previouspagelink' => '<i class="fa-light fa-angle-left"></i>',
                            ));

                            ?>
                            <div class="post__navigation">
                                <div class="nav__prev">
                                    <?php previous_post_link('%link', '<div class="nav__label">' . __('Prev Post', 'landshop') . '</div> <h4 class="post__title">%title</h4>'); ?>
                                </div>
                                <div class="nav__next">
                                    <?php next_post_link('%link', '<div class="nav__label">' . __('Next Post', 'landshop') . '</div> <h4 class="post__title">%title</h4>'); ?>
                                </div>
                            </div>
                            <?php
                            // If comments are open or there are comments, display the comment template
                            if (comments_open() || get_comments_number()) {
                                comments_template();
                            }

                        endwhile; // End the post loop
                        ?>
                    </div>
                </div>
            </div>

            <div class="<?php echo esc_attr($sidebar_classes); ?>">
                <?php
                // Include the sidebar template
                get_sidebar();
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Post List Area End -->

<?php
// Include the footer template
get_footer();
?>
