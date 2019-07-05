<?php

use PHPMailer\PHPMailer\PHPMailer;

form_security_validate('plugin_EmailExport_export');
access_ensure_global_level(plugin_config_get('export_threshold'));

ob_start();

require_once( 'csv_export.php' );

header_remove();
header('Content-Type:');
$xml = ob_get_contents();
ob_end_clean();

$dirname = __DIR__ . "/../temp/";
if (!file_exists($dirname)) {
	mkdir($dirname, 0777, true);
}

$fname = $dirname . hash("md5", openssl_random_pseudo_bytes(128));
file_put_contents($fname, $xml);

$mail = new PHPMailer();

$mail->CharSet = PHPMailer::CHARSET_UTF8;

$mail->setFrom(gpc_get_string('email_from'));
$mail->addReplyTo(gpc_get_string('email_from'));

$mail->addAddress(gpc_get_string('email_to'));
if(gpc_get_bool("email_copy")) {
	$mail->addCC(gpc_get_string('email_from'));
}

$mail->addAttachment($fname, 'export.csv');

$mail->isHTML(true);
$mail->Subject = gpc_get_string('email_theme');
$mail->Body    = gpc_get_string('email_text');
$mail->AltBody = $mail->html2text($mail->Body);

$result = $mail->send();

unlink($fname);

$t_redirect_url = 'view_all_bug_page.php';
layout_page_header(plugin_lang_get('export_page_title'));
layout_page_begin($t_redirect_url);

if($result) {
	html_operation_successful($t_redirect_url, plugin_lang_get("send_ok"));
}
else {
	html_operation_failure($t_redirect_url, plugin_lang_get("send_error") . $mail->ErrorInfo);
}

form_security_purge('plugin_EmailExport_export');
layout_page_end();
