<?php
	if ( class_exists( 'Redux' ) ) {
		global $maruncy_opt;
	}else{
		$maruncy_opt = array();
		$maruncy_opt['post_thumbnail'] = '1';
		$maruncy_opt['post_thumb_size'] = 'large';
		$maruncy_opt['post_author'] = '1';
		$maruncy_opt['post_title'] = '1';
		$maruncy_opt['title_length'] = '15';
		$maruncy_opt['post_desc_format'] = 'excerpt';
		$maruncy_opt['post_desc_lenth'] = '30';
		$maruncy_opt['post_meta'] = '1';
		$maruncy_opt['post_read_more'] = false;
		$maruncy_opt['post_read_more_txt'] = __('Read More','maruncy');
	}	
?>


<div <?php post_class(['post-box',get_post_type()]); ?>>
    <?php 
		if($maruncy_opt['post_thumbnail'] == '1'){
			maruncy_post_thumbnail($maruncy_opt['post_thumb_size']); 
		}
	?>
    <div class="content">
        <?php if($maruncy_opt['post_title'] == '1' && get_the_title()): ?>
            <?php if(!is_single()): ?>
                <h2 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $maruncy_opt['title_length'], '...' ); ?></a></h2>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($maruncy_opt['post_meta'] == '1'): ?>
        <div class="meta_list">
            <ul>
                <?php if(get_the_author()): ?>
                <li class="author">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-user"></use>
                        </svg>
                    </span>
                    <?php echo get_the_author(); ?>
                </li>
                <?php endif; ?>
                <?php if(maruncy_get_post_date()): ?>
                <li class="date">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-clock"></use>
                        </svg>
                    </span>
                    <?php echo maruncy_get_post_date(); ?>
                </li>
                <?php endif; ?>
                <?php if(maruncy_get_comment_count()): ?>
                <li class="comment">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-comment"></use>
                        </svg>
                    </span>
                    <?php echo maruncy_get_comment_count(); ?>
                </li>
                <?php endif; ?>
                <?php if(has_tag() && !is_single()): ?>
                <li class="tag">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-tags"></use>
                        </svg>
                    </span>
                    <?php echo get_the_tag_list( '', ', ' ); ?>
                </li>
                <?php endif; ?>
                <?php if(get_the_category_list()): ?>
                <li class="tag">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-folder"></use>
                        </svg>
                    </span>
                    <?php echo get_the_category_list( ' ', ' ' ); ?>
                </li>
                <?php endif; ?>
                <?php if(current_user_can('edit_posts')): ?>
                <li class="edit">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-edit"></use>
                        </svg>
                    </span>
                    <a href="<?php echo get_edit_post_link(); ?>"><?php esc_html_e('Edit','maruncy'); ?></a>
                </li>
                <?php endif; ?>
                <?php if(function_exists('maruncy_get_post_views')): ?>
                <li class="views">
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-eye"></use>
                        </svg>
                    </span>
                    <?php echo maruncy_get_post_views(get_the_ID()); ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="desc">
            <?php
			   if(is_single()){
				   the_content(
						sprintf(
							esc_html__( 'Continue reading %s', 'maruncy' ),
							the_title( '<span class="screen-reader-text">', '</span>', false )
						)
					);
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'maruncy' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="page-numbers" >',
						'link_after'  => '</span>',
						'next_or_number' => 'number',
						'nextpagelink'     => '<i class="mr-arrow-right-icon"></i>',
						'previouspagelink' => '<i class="mr-arrow-left-icon"></i>',
					) ); 
			   }else {
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
			   }                
           ?>
        </div>
        <?php if($maruncy_opt['post_read_more'] == '1' and !is_single() and !empty($maruncy_opt['post_read_more_txt'])): ?>
        <a href="<?php echo get_the_permalink(); ?>" class="primary_button"><?php echo wp_kses_post($maruncy_opt['post_read_more_txt']); ?> <span class="arrow"><i class="fal fa-arrow-right"></i></span></a>
        <?php endif; ?>
    </div>
</div>