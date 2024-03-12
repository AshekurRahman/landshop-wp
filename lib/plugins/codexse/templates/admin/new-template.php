<?php

use Codexse_Addons\Elementor\Theme_Builder;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$types    = Theme_Builder::TEMPLATE_TYPE;
$selected = get_query_var( 'cx_library_type' );

?>
<script type="text/template" id="tmpl-elementor-new-template">
	<div id="elementor-new-template__description">
		<div id="elementor-new-template__description__title">
			<?php
			printf(
				esc_html__( '%1$s Codexse Addon %2$s Theme Builder Helps You %3$sWork Efficiently%4$s', 'codexse-elementor-addons' ),
				'<span>',
				'</span>',
				'<span>',
				'</span>'
			);
			?>
	    </div>
		<div id="elementor-new-template__description__content"><?php echo esc_html__( 'Create various bits and pieces (e.g: Header, Footer etc) of your site and then later reuse them when needed.', 'codexse-elementor-addons' ); ?></div>
	</div>
	<form id="elementor-new-template__form" action="<?php esc_url( admin_url( '/edit.php' ) );?>">
		<input type="hidden" name="post_type" value="cx_library">
		<input type="hidden" name="action" value="cx_library_new_post">
		<?php // PHPCS - a nonce doesn't have to be escaped. ?>
		<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'cx_library_new_post_action' ); ?>">

		<div id="newViewGroup" x-data="newTemplateForm()" x-init="
			$watch('selectedSingular', value => {
				if(value == 'selective'){
					jQuery('#elementor-new-template__display_type_selected').select2({
						dropdownParent: jQuery('#elementor-new-template-modal')
					});
				}
			});
		">

			<div x-show="step == 1">
				<div>
					<div id="elementor-new-template__form__title"><?php echo esc_html__( 'Choose Template Type', 'codexse-elementor-addons' ); ?></div>
					<div id="elementor-new-template__form__template-type__wrapper" class="elementor-form-field">
						<label for="elementor-new-template__form__template-type" class="elementor-form-field__label"><?php echo esc_html__( 'Select the type of template you want to work on', 'codexse-elementor-addons' ); ?></label>
						<div class="elementor-form-field__select__wrapper">
							<select id="elementor-new-template__form__template-type" class="elementor-form-field__select" x-model="templateType" name="template_type" required>
								<option value=""><?php echo esc_html__( 'Select', 'codexse-elementor-addons' ); ?>...</option>
								<?php
foreach ( $types as $value => $type_title ) {
	printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $value ), selected( $selected, $value, false ), esc_html( $type_title ) );
}
?>
							</select>
						</div>
					</div>

					<div id="elementor-new-template__form__post-title__wrapper" class="elementor-form-field">
						<label for="elementor-new-template__form__post-title" class="elementor-form-field__label">
							<?php echo esc_html__( 'Name your template', 'codexse-elementor-addons' ); ?>
						</label>
						<div class="elementor-form-field__text__wrapper">
							<input type="text" x-model="postTitle" placeholder="<?php echo esc_attr__( 'Enter template name (optional)', 'codexse-elementor-addons' ); ?>" id="elementor-new-template__form__post-title" class="elementor-form-field__text" name="post_data[post_title]">
						</div>
					</div>

					<button @click.prevent="step = 2" x-bind:disabled="buttonDisabled()" id="elementor-new-template__form__submit" class="elementor-button cx-btn cx-btn-primary"><?php echo esc_html__( 'Next', 'codexse-elementor-addons' ); ?></button>
				</div>
			</div>

			<div x-show="step == 2">
				<div>
					<div id="elementor-new-template__form__title"><?php echo esc_html__( 'Choose Display Condition', 'codexse-elementor-addons' ); ?></div>
					<div id="elementor-new-template__form__post-title__wrapper" class="elementor-form-field">
						<div class="elementor-form-field__select__wrapper">
							<label class="elementor-form-field__label"> </label>
							<select id="elementor-new-template__display_type" x-model="selectedType" class="elementor-form-field__select" name="template_display_type" required>
								<template x-if="templateType != 'single'">
									<template x-for="[key,value] in Object.entries(conditionType)">
										<option
											x-bind:value="key"
											x-text="value"
											x-bind:selected="key === selectedType"
										></option>
									</template>
								</template>
								<template x-if="templateType == 'single'">
									<template x-for="[key,value] in Object.entries(singularData)">
										<option
											x-bind:value="key"
											x-text="value"
											x-bind:selected="key === selectedType"
										></option>
									</template>
								</template>
							</select>
						</div>
					</div>
					<div x-show="selectedType === 'singular'">
						<div id="elementor-new-template__form__post-title__wrapper" class="elementor-form-field">
							<div class="elementor-form-field__select__wrapper">
							<label class="elementor-form-field__label"> </label>
								<select x-model="selectedSingular" @change="getSelective()" id="elementor-new-template__display_type_singular" class="elementor-form-field__select" name="template_display_type_singular">
									<template x-for="[key,value] in Object.entries(singularData)">
										<option
											x-bind:value="key"
											x-text="value"
											x-bind:selected="key === selectedSingular"
										></option>
									</template>
								</select>
							</div>
						</div>
					</div>
					<div x-show="selectedSingular == 'selective'">
						<div id="elementor-new-template__form__post-title__wrapper" class="elementor-form-field">
							<div class="elementor-form-field__select__wrapper">
							<label class="elementor-form-field__label"> </label>
								<select id="elementor-new-template__display_type_selected" class="elementor-form-field__select" name="template_display_type_selected[]" multiple>
								<?php
									$pages = get_pages();
									foreach ( $pages as $page ) {
										$option = '<option value="' . $page->ID . '">';
										$option .= $page->post_title;
										$option .= '</option>';
										echo $option;
									}
								?>
								</select>
							</div>
						</div>
					</div>
					<button id="elementor-new-template__form__submit" class="elementor-button cx-btn cx-btn-primary"><?php echo esc_html__( 'Create Template', 'codexse-elementor-addons' ); ?></button>
				</div>
			</div>
		</div>
	</form>
</script>

<script type="text/template" id="tmpl-cx-templates-modal__header__logo">
	<span class="elementor-templates-modal__header__logo__icon-wrapper cx-logo-wrapper">
		<!-- <i class="eicon-elementor"></i> -->
		<svg viewBox="0 0 140 165" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M139.81 142.199C124.97 156.018 104.979 164.482 83.0053 164.482C37.1542 164.482 0 127.659 0 82.2412C0 36.8231 37.1542 0 83.0053 0C104.351 0 123.825 7.98416 138.522 21.1057L97.4707 64.1896L73.1746 38.6664H41.5797L81.9815 81.6413L39.9614 126.667H70.2683L97.4707 98.155L138.72 142.199H139.81Z" fill="white"/>
		</svg>
	</span>
	<span class="elementor-templates-modal__header__logo__title">{{{ title }}}</span>
</script>


<script type="text/template" id="tmpl-modal-new-template">
    <div class="modal micromodal-slide modal-template-condition cx-template-element-modal" id="modal-new-template" aria-hidden="false">
        <div class="modal__overlay" tabindex="-1">
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-login-title">
                <header class="modal__header">
                    <h3 class="modal__title" id="modal-2-title">
                        <svg width="26" height="31" viewBox="0 0 26 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26 26.7331C23.2403 29.3311 19.5225 30.9223 15.4362 30.9223C6.90945 30.9223 0 23.9997 0 15.4612C0 6.92267 6.90945 0 15.4362 0C19.4058 0 23.0274 1.501 25.7605 3.96782L18.1263 12.0675L13.608 7.26921H7.73244L15.2458 15.3484L7.4315 23.8131H13.0676L18.1263 18.4529L25.7973 26.7331H26Z" fill="#27B59E"/>
                        </svg>
                        <span>Template Elements Condition</span>
                    </h3>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close=""></button>
                </header>
                <div class="modal__content new-template" id="modal-2-content">
					<div class="modal__information">
						<div class="info-title">CodexseAddons Theme Builder helps you work efficiently</div>
                        <div class="info-message">Create various bits and pieces (e.g: Header, Footer etc) of your site and then later reuse them when needed.</div>
					</div>
					<form id="cx-new-template-form" action="<?php esc_url( admin_url( '/edit.php' ) );?>">
						<input type="hidden" name="post_type" value="cx_library">
						<input type="hidden" name="action" value="cx_library_new_post">
						<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'cx_library_new_post_action' ); ?>">
						<div id="cx-new-template-form__title"><?php echo esc_html__( 'Choose Template Type', 'codexse-elementor-addons' ); ?></div>
							<div id="cx-new-template-form__template-type__wrapper" class="elementor-form-field">
								<div class="cx-new-template-form__select__wrapper">
									<select id="cx-new-template-form__template-type" class="elementor-form-field__select" name="template_type" required>
										<option value=""><?php echo esc_html__( 'Select', 'codexse-elementor-addons' ); ?>...</option>
										<?php
											foreach ( $types as $value => $type_title ) {
												printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $value ), selected( $selected, $value, false ), esc_html( $type_title ) );
											}
										?>
									</select>
								</div>
							</div>

							<div id="cx-new-template-form__post-title__wrapper" class="elementor-form-field">
								<div class="cx-new-template-form__text__wrapper">
									<input type="text" placeholder="<?php echo esc_attr__( 'Enter template name', 'codexse-elementor-addons' ); ?>" id="cx-new-template-form__post-title" class="cx-new-template-form__field__text" name="post_data[post_title]" required>
								</div>
							</div>

							<button id="cx-new-template-form__submit" class="cx-btn cx-btn-primary" disabled><?php echo esc_html__( 'Create Template', 'codexse-elementor-addons' ); ?></button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</script>