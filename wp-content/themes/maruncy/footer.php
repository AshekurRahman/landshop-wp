<?php
	if( class_exists('Redux') ){
		global $maruncy_opt;
	}else{
		$maruncy_opt = array();
		$maruncy_opt['is_scroll_up'] = '1';
		$maruncy_opt['footer_template'] = '';
		$maruncy_opt['copyright_text'] = __('Copyright &copy; 2022  by name. All Rights Reserved.','maruncy');
	}
    $remove_widget = get_post_meta( get_the_ID(), '_maruncy_footer_widget', true );
	$footer_template = '';
	if(!empty($maruncy_opt['footer_template'])) {
		$footer_template = new WP_Query(array(
			'post_type' => 'elementor_library',
			'posts_per_page'=> -1,
			'p' => $maruncy_opt['footer_template'],
		));
	}
?>
<?php if( $remove_widget != 'on' ): ?>
<!--Footer_Area-Start-->
<footer class="footer_wrapper">
	<?php if($footer_template && $footer_template->have_posts()): ?>
        <?php while($footer_template->have_posts()): $footer_template->the_post() ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
	<?php else: ?>
	<div class="footer_area">
		<?php  if ( is_active_sidebar( 'footer_sidebar' )  ) : ?>
		<div class="footer_middle">
			<div class="container">
				<div class="row masonrys footer_widgets">
					<?php dynamic_sidebar( 'footer_sidebar' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if(!empty($maruncy_opt['copyright_text']) || !empty($maruncy_opt['conditions_text'])): ?>
		<div class="container">
			<div class="footer_bottom">
				<div class="row align-items-center justify-content-center">
					<?php if(!empty($maruncy_opt['copyright_text'])): ?>
						<div class="col-lg-12 text-center mb-3 mb-lg-0">
							<div class="footer_text">
								<p><?php echo wp_kses_post($maruncy_opt['copyright_text']); ?></p>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>    
<?php endif; ?>
</footer>
<!--Footer_Area-End-->
<?php endif; ?>
</div>
</main>
<?php if($maruncy_opt['is_scroll_up'] == '1'): ?>
<div class="progress-wrap">
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
	</svg>
	<span class="icon"><i class="far fa-long-arrow-up"></i></span>
</div>
<?php endif; ?>
<?php 
	if(class_exists('GTranslate')){
		$data_gt = get_option('GTranslate');	
		if(!empty($data_gt['widget_code'])){
			echo '<div class="tr-globe">'.do_shortcode('[gtranslate]').'</div>';
		}
	}		
?>
<?php wp_footer(); ?>

</body>

</html>