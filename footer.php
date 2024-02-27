<?php
if (class_exists('Redux')) {
	global $landshop_opt;
} else {
	$landshop_opt = array(
		'is_scroll_up' => '1',
		'footer_template' => '',
		'copyright_text' => esc_html__('&copy; 2023 landshop - IT Solution Company. All Rights Reserved.', 'landshop')
	);
}
$remove_widget = get_post_meta(get_the_ID(), '_codexse_remove_page_footer', true);
$footer_template = '';
if (!empty($landshop_opt['footer_template'])) {
	$footer_template = new WP_Query(array(
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
		'p' => $landshop_opt['footer_template'],
	));
}
?>
<?php if ($remove_widget !== 'yes') : ?>
<footer class="footer_wrapper">
	<?php if ($footer_template && $footer_template->have_posts()) : ?>
		<?php while ($footer_template->have_posts()) : $footer_template->the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<div class="footer_area">
			<?php if (is_active_sidebar('footer_sidebar')) : ?>
				<div class="footer_middle">
					<div class="container">
						<div class="row g-3 g-sm-4 masonrys footer_widgets">
							<?php dynamic_sidebar('footer_sidebar'); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if (!empty($landshop_opt['copyright_text']) || !empty($landshop_opt['conditions_text'])) : ?>
				<div class="container">
					<div class="footer_bottom">
						<div class="row align-items-center justify-content-center">
							<?php if (!empty($landshop_opt['copyright_text'])) : ?>
								<div class="col-lg-12 text-center mb-3 mb-lg-0">
									<div class="footer_text">
										<p><?php echo wp_kses_post($landshop_opt['copyright_text']); ?></p>
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
<?php endif; ?>
</div>
</main>
<?php if ($landshop_opt['is_scroll_up'] == '1') : ?>
<div class="progress-wrap">
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
	</svg>
	<span class="icon"><i class="fa-light fa-arrow-up"></i></span>
</div>
<?php endif; 
wp_footer();
?>
</body>
</html>
