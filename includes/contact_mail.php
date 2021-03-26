<?php $mail_body .=  '<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>
	
		<table width="394" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
			<tr>
				<td width="350" height="35"></td>
			</tr>
		</table>
		<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" align="center"  style="background-color: #ffffff;  width: 394px; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;"  class="mobile">
			<tr>
				<td colspan="2" style="text-align: left; font-family: sans-serif; font-size: 24px; color: blue;  font-weight: bold; text-align: center; padding-top: 38px; padding-left: 2px; padding-right: 2px; padding-bottom: 15px; color: #0c65c9; font-size:  25px;">New Contact Request</td>
			</tr>
			<tr>
				<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Name:</td>
				<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_name'].'</td>
			</tr>
			<tr>
				<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Email:</td>
				<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_email'].'</td>
			</tr>';
if( isset($_POST['user_phone']) && $_POST['user_phone'] != ''){
	$mail_body .=  '<tr>
				<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Phone:</td>
				<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_phone'].'</td>
			</tr>';
}
if( isset($_POST['user_subject']) && $_POST['user_subject'] != ''){
	$mail_body .=  '<tr>
				<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Subject:</td>
				<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_subject'].'</td>
			</tr>';
}
if( isset($_POST['user_message']) && $_POST['user_message'] != ''){
	$mail_body .= '<tr>
					<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Message:</td>
					<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_message'].'</td>
				</tr>';
}

if( isset($_POST['agent_email']) && $_POST['agent_email'] != ''){
	$mail_body .=' <tr>
					<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">x_for:</td>
					<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['agent_email'].'</td>
				</tr>';
}

$mail_body .= '<tr>
				<td width="350" height="35"></td>
			</tr>
		</table>
		<table width="394" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
			<tr>
				<td width="350" height="35"></td>
			</tr>
		</table>
	</body></html>';


?>