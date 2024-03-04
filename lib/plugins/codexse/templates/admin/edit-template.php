<?php

use Codexse_Addons\Elementor\Theme_Builder;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$types = Theme_Builder::TEMPLATE_TYPE;
$selected = get_query_var('cx_library_type');

?>

<div class="modal micromodal-slide" id="modal-login" aria-hidden="false">
	<div class="modal__overlay" tabindex="-1">
		<div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-login-title">
			<header class="modal__header">
				<h3 class="modal__title" id="modal-2-title">
					Edit <span id="edit-template-type"></span>Template
				</h3>
				<button class="modal__close" aria-label="Close modal" data-micromodal-close=""></button>
			</header>
			<form id="cx-template-edit-form">
				<div class="modal__content" id="modal-2-content">
					<div class="cx-template-form-input-group">
						<div class="cx-template-form-field__switch__wrapper">
							<h2 class="settings_title">
								<label for="cx-template-activate">Activate Template</label>
							</h2>
							<label for="cx-template-activate">
								<div class="cx-dashboard-widgets__item-toggle cx-toggle">
									<input id="cx-template-activate" type="checkbox" class="cx-toggle__check cx-feature" name="template_active" value="active">
									<b class="cx-toggle__switch"></b>
									<b class="cx-toggle__track"></b>
								</div>
							</label>
						</div>
					</div>
					<h2 class="settings_title">Display Conditions</h2>

					<div class="cx-template-form-input-group">
						<div class="cx-template-form-field__select__wrapper">
							<label class="elementor-form-field__label"> </label>
							<select id="template_display_type" name="template_display_type" required>
								<option value="general">Entire Website</option>
								<option value="singular">Sigular (Only Pro)</option>
								<option value="archive">Archive (Only Pro)</option>
							</select>
						</div>
					</div>

					<div class="cx-template-form-input-group">
						<div class="cx-template-form-field__select__wrapper">
							<label class="attr-input-label"></label>
							<select id="condition_singular" name="condition_singular">
								<option value="all">All Singulars (Only Pro)</option>
								<option value="front_page">Front Page (Only Pro)</option>
								<option value="posts">All Posts (Only Pro)</option>
								<option value="pages">All Pages (Only Pro)</option>
								<option value="selective">Selective Singular (Only Pro) </option>
								<option value="404page">404 Page (Only Pro)</option>
							</select>
						</div>
					</div>

					<div class="cx-template-form-input-group">
						<div class="cx-template-form-field__select__wrapper">
							<label class="attr-input-label"></label>
							<select id="cx-template-singular-select2" multiple name="condition_singular_id[]" class="cx-template-form-field__select__wrapper"></select>
						</div>
					</div>
				</div>
			</form>
			<footer class="modal__footer">
				<button id="cx-template-edit" class="modal__btn modal__btn-secondary">Edit Content</button>
				<button id="cx-template-save-data" class="modal__btn modal__btn-primary">Save Settings</button>
			</footer>
		</div>
	</div>
</div>