<?php
layout_page_header(plugin_lang_get('export_page_title'));
layout_page_begin('view_all_bug_page.php');

$g_project = helper_get_current_project();
?>

<br/>

<form action="<?php echo plugin_page('export') ?>" method="post">
	<?php  echo form_security_field( 'plugin_EmailExport_export' )  ?>
	<table class="table table-bordered table-condensed table-striped" width="100%">

		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_theme_title') ?>
			</td>
			<td>
				<input type="text" id="email_theme" name="email_theme" class="form-control"
				       value="<?php echo plugin_config_get('email_theme', null, false, null, $g_project); ?>" required />
			</td>
		</tr>


		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_text_title') ?>
			</td>
			<td>
				<textarea id="email_text" name="email_text" class="form-control" required ><?php echo plugin_config_get('email_text', null, false, null, $g_project); ?></textarea>
			</td>
		</tr>

		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_from_title') ?>
			</td>
			<td>
				<input type="text" id="email_from" name="email_from" class="input-sm"
				       value="<?php echo plugin_config_get('email_from', null, false, null, $g_project); ?>" required />
			</td>
		</tr>
		
		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_to_title') ?>
			</td>
			<td>
				<input type="text" id="email_to" name="email_to" class="input-sm"
				       value="<?php echo plugin_config_get('email_to', null, false, null, $g_project); ?>" required />
			</td>
		</tr>
		
		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_copy_title') ?>
			</td>
			<td>
				<input type="checkbox" id="email_copy" name="email_copy" class="input-sm" checked />
			</td>
		</tr>
	</table>
	
	<input  class="btn btn-primary btn-white btn-round" type="submit"/>
	
</form>

<?php
layout_page_end();

