<?php
    $elementor_template = get_theme_mod('footer_elementor_template_setting', 'default');
?>

			</div>
		</main>
		<?php if ($elementor_template === 'default'): ?>
		<footer class="footer__section">
			<div class="container">
				<div class="text-center">
					<?php
					$copyrights_text = get_theme_mod('landshop_copyrights_text', __('&copy;2024 All rights reserved. Powered by <b>Themectg</b>', 'landshop'));
					echo wp_kses_post($copyrights_text);
					?>
				</div>
			</div>
		</footer>
		<?php else: ?>
			<footer class="footer__elementor__section">
				<?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($elementor_template); ?>
			</footer>
		<?php endif; ?>
		<div class="progress__wrap">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
			</svg>
			<span class="icon"><i class="fa-light fa-arrow-up"></i></span>
		</div>
	<?php wp_footer(); ?>
	</body>
</html>