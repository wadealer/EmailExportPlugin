<?php

/**
 * MantisBT - A PHP based bugtracking system
 *
 * MantisBT is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * MantisBT is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @copyright Copyright 2002  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 */

/**
 * Export Issues in XML Format
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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

//Server settings
//$mail->SMTPDebug = 2; // Enable verbose debug output	
//$mail->isSMTP(); // Set mailer to use SMTP
/*
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;				   // Enable SMTP authentication
$mail->Username = 'user@example.com';		     // SMTP username
$mail->Password = 'secret';			       // SMTP password
$mail->SMTPSecure = 'tls';				  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;				    // TCP port to connect to
*/

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
