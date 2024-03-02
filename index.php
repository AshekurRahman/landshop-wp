<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php get_template_part('components/layouts/site_header'); ?>
    <section class="posts__section section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 <?php echo (is_active_sidebar('main_sidebar') ? 'col-lg-8' : ''); ?>">
                    <div class="<?php echo (is_active_sidebar('main_sidebar') ? 'pe-lg-4' : ''); ?>">
                        <div class="posts_list">
                            <?php while (have_posts()) : the_post(); ?>
                                <?php get_template_part('components/post-formats/post', get_post_format()); ?>
                            <?php endwhile; ?>
                        </div>
                        <div class="pagination">
                            <?php echo paginate_links(array(
                                'prev_text' => '<i class="fa-light fa-angle-left"></i>',
                                'next_text' => '<i class="fa-light fa-angle-right"></i>',
                                'screen_reader_text' => ' '
                            )); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 <?php echo (is_active_sidebar('main_sidebar') ? 'col-lg-4 mt-5 mt-lg-0' : ''); ?>">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <?php get_template_part('components/post-formats/post', 'none'); ?>
<?php endif; ?>
<?php get_footer();