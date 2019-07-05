<?php
layout_page_header(plugin_lang_get('export_page_title'));
layout_page_begin();
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
				       value="<?php echo plugin_config_get('email_theme'); ?>" required />
			</td>
		</tr>


		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_text_title') ?>
			</td>
			<td>
				<textarea id="email_text" name="email_text" class="form-control" required ><?php echo plugin_config_get('email_text'); ?></textarea>
			</td>
		</tr>

		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_from_title') ?>
			</td>
			<td>
				<input type="text" id="email_from" name="email_from" class="input-sm"
				       value="<?php echo plugin_config_get('email_from'); ?>" required />
			</td>
		</tr>
		
		<tr>
			<td class="category" width="15%">
				<?php echo plugin_lang_get('email_to_title') ?>
			</td>
			<td>
				<input type="text" id="email_to" name="email_to" class="input-sm"
				       value="<?php echo plugin_config_get('email_to'); ?>" required />
			</td>
		</tr>
	</table>
	
	<input  class="btn btn-primary btn-white btn-round" type="submit"/>
	
</form>

<?php
layout_page_end();

