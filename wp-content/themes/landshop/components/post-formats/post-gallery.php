<?php
	if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt = array();
		$landshop_opt['post_thumbnail'] = '1';
		$landshop_opt['post_thumb_size'] = 'full';
		$landshop_opt['post_author'] = '1';
		$landshop_opt['post_title'] = '1';
		$landshop_opt['title_length'] = '15';
		$landshop_opt['post_desc_format'] = 'excerpt';
		$landshop_opt['post_desc_lenth'] = '30';
		$landshop_opt['post_meta'] = '1';
		$landshop_opt['post_meta_author'] = '1';
		$landshop_opt['post_meta_date'] = '1';
		$landshop_opt['post_meta_comment'] = '1';
		$landshop_opt['post_meta_tag'] = '1';
		$landshop_opt['post_meta_cat'] = '1';
		$landshop_opt['post_meta_view'] = '1';
		$landshop_opt['post_read_more'] = true;
		$landshop_opt['post_read_more_txt'] = esc_html__('Read More','landshop');
	}	
?>


<div <?php post_class([ (!is_single() ? 'post-box' : 'post-single-box'), 'gallery_post' ,get_post_type()]); ?>>
	<?php 
		if($landshop_opt['post_thumbnail'] == '1'){			
            if(get_post_meta( get_the_ID(), '_codexse_image_gallery_id', true )){
                $gallery_images = get_post_meta( get_the_ID(), '_codexse_image_gallery_id', true );
            }else{
                $gallery_images = array();
            }
            if(function_exists('codexse_gallery_embed')): 
                // Gallery Post Content Function
                echo codexse_gallery_embed( $gallery_images, $landshop_opt['post_thumb_size'] );    
            else:
                landshop_post_thumbnail($landshop_opt['post_thumb_size']); 
            endif;
		}
	?>
	<div class="content">     
		<?php if($landshop_opt['post_meta'] == '1' and get_post_type() !== 'product'): ?>
		<div class="meta_list">
			<ul>
				<?php if(get_the_author() && $landshop_opt['post_meta_author'] == '1'): ?>
				<li class="author">
					<svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-profile"></use></svg>
					<?php echo get_the_author(); ?>
				</li>
				<?php endif; ?>
				<?php if(landshop_get_post_date() && $landshop_opt['post_meta_date'] == '1'): ?>
				<li class="date">
					<svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-calander"></use></svg>
					<?php echo landshop_get_post_date(); ?>
				</li>
				<?php endif; ?>
				<?php if(landshop_get_comment_count() && $landshop_opt['post_meta_comment'] == '1'): ?>
				<li class="comment">
					<svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-comment"></use></svg>
					<?php echo landshop_get_comment_count(); ?>
				</li>
				<?php endif; ?>
				<?php if(has_tag() && !is_single() && $landshop_opt['post_meta_tag'] == '1'): ?>
				<li class="tag">
					<svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-tag"></use></svg>
					<?php echo get_the_tag_list( '', ', ' ); ?>
				</li>
				<?php endif; ?>
				<?php if(get_the_category_list() && $landshop_opt['post_meta_cat'] == '1'): ?>
				<li class="tag">
					<svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-folder"></use></svg>
					<?php echo get_the_category_list( ', ', ' ' ); ?>
				</li>
				<?php endif; ?>
				<?php if(function_exists('codexse_get_post_views') && $landshop_opt['post_meta_view'] == '1'): ?>
				<li class="views">
					<svg class="svg-icon icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg' ); ?>#ic-eye"></use></svg>
					<?php echo codexse_get_post_views(get_the_ID()); ?>
				</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
        <?php if($landshop_opt['post_title'] == '1' && get_the_title() && !is_single()): ?>
        <h2 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $landshop_opt['title_length'], '...' ); ?></a></h2>
        <?php endif; ?>
		<div class="desc">
			<?php
			   if(is_single()){
				   the_content(
						sprintf(
							esc_html__( 'Continue reading %s', 'landshop' ),
							the_title( '<span class="screen-reader-text">', '</span>', false )
						)
					);
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'landshop' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="page-numbers" >',
						'link_after'  => '</span>',
						'next_or_number' => 'number',
						'nextpagelink'     => '<i class="fal fa-angle-double-right"></i>',
						'previouspagelink' => '<i class="fal fa-angle-double-left"></i>',
					) ); 
			   }else {
				   if($landshop_opt['post_desc_format'] == 'excerpt'){
				   		echo get_the_excerpt();
				   }elseif($landshop_opt['post_desc_format'] == 'full'){
					   the_content(
							sprintf(
								esc_html__( 'Continue reading %s', 'landshop' ),
								the_title( '<span class="screen-reader-text">', '</span>', false )
							)
						);
				   }elseif($landshop_opt['post_desc_format'] == 'custom'){
					   echo wp_trim_words( get_the_content(), $landshop_opt['post_desc_lenth'], '...' );
				   }
			   }                
           ?>
		</div>
        <?php if($landshop_opt['post_read_more'] == '1' and !is_single() and !empty($landshop_opt['post_read_more_txt']) and get_post_type() !== 'product' ): ?>
        <a href="<?php echo get_the_permalink(); ?>" class="read-more-button"><?php echo wp_kses_post($landshop_opt['post_read_more_txt']); ?></a>
        <?php endif; ?>
	</div>
</div>