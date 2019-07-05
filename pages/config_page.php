<?php
# Copyright (c) 2014  MantisBT Team - mantisbt-dev@lists.sourceforge.net
# Licensed under the MIT license

access_ensure_global_level(config_get('manage_plugin_threshold'));

layout_page_header(plugin_lang_get('config_title'));

layout_page_begin('manage_overview_page.php');

print_manage_menu('manage_plugin_page.php');
?>

<div class="col-md-12 col-xs-12">
	<div class="space-10"></div>
	<div class="form-container">
		<form action="<?php echo plugin_page('config') ?>" method="post">
			<fieldset>
				<div class="widget-box widget-color-blue2">
					<div class="widget-header widget-header-small">
						<h4 class="widget-title lighter">
							<i class="ace-icon fa fa-exchange"></i>
							<?php echo plugin_lang_get('config_title') ?>
						</h4>
					</div>

					<?php echo form_security_field('plugin_EmailExport_config') ?>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="table-responsive">
								<table class="table table-bordered table-condensed table-striped">

									<!-- Export Access Level  -->
									<tr>
										<td class="category" width="15%">
											<?php echo plugin_lang_get('config_export_threshold_title') ?>
										</td>
										<td>
											<select id="export_threshold" name="export_threshold" class="input-sm"><?php
												print_enum_string_option_list(
													'access_levels',
													plugin_config_get('export_threshold')
												);
												?></select>
										</td>
									</tr>

									<tr>
										<td class="category" width="15%">
											<?php echo plugin_lang_get('config_email_theme_title') ?>
										</td>
										<td>
											<input type="text" id="email_theme" name="email_theme" class="form-control"
											       value="<?php echo plugin_config_get('email_theme'); ?>" />
										</td>
									</tr>


									<tr>
										<td class="category" width="15%">
											<?php echo plugin_lang_get('config_email_text_title') ?>
										</td>
										<td>
											<textarea id="email_text" name="email_text" class="form-control" ><?php echo plugin_config_get('email_text'); ?></textarea>
										</td>
									</tr>

									<tr>
										<td class="category" width="15%">
											<?php echo plugin_lang_get('config_email_from_title') ?>
										</td>
										<td>
											<input type="text" id="email_theme" name="email_from" class="form-control"
											       value="<?php echo plugin_config_get('email_from'); ?>" />
										</td>
									</tr>

								</table>
							</div>
						</div>
						<div class="widget-toolbox padding-8 clearfix">
							<input type="submit" class="btn btn-primary btn-white btn-round" value="<?php echo plugin_lang_get('action_update') ?>" />
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<?php
layout_page_end();
