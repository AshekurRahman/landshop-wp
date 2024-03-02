<div <?php post_class('post__box'); ?>>
    <?php landshop_post_thumbnail('large'); ?>
    <div class="post__content"> 
        <?php if(get_the_title()): ?>
            <!-- Post Title -->
            <h2 class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php endif; ?>
        <ul class="post__meta">
            <?php if(get_the_author()): ?>
                <!-- Author -->
                <li class="author"><i class="fa-light fa-user icon"></i><?php the_author(); ?></li>
            <?php endif; ?>
            <?php if($post_date = landshop_get_post_date()): ?>
                <!-- Post Date -->
                <li class="date"><i class="fa-light fa-calendar-days icon"></i><?php echo $post_date; ?></li>
            <?php endif; ?>
            <?php if($comment_count = landshop_get_comment_count()): ?>
                <!-- Comment Count -->
                <li class="comment"><i class="fa-light fa-comments icon"></i><?php echo $comment_count; ?></li>
            <?php endif; ?>
        </ul>
        <!-- Post Description -->
        <div class="post__desc"><?php echo get_the_excerpt(); ?></div>
        <!-- Read More Link -->
        <a href="<?php the_permalink(); ?>" class="read__more"><?php _e('Read more','landshop'); ?></a>
    </div>
</div>
