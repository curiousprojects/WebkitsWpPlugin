<?php $mail_body =  '<html>
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
				<td colspan="2" style="text-align: left; font-family: sans-serif; font-size: 24px; color: blue;  font-weight: bold; text-align: center; padding-top: 38px; padding-left: 2px; padding-right: 2px; padding-bottom: 15px; color: #0c65c9; font-size:  25px;">NEW VOW REGISTRATION</td>
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
			if( isset($_POST['user_city']) && $_POST['user_city'] != ''){
			$mail_body .=  '<tr>
				<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">City:</td>
				<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_city'].'</td>
			</tr>';
			}
			if( isset($_POST['user_creatria']) && $_POST['user_creatria'] != ''){
				$mail_body .= '<tr>
					<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Are you looking to buy, sell or rent?:</td>
					<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_creatria'].'</td>
				</tr>';
			 }

			if( isset($_POST['user_relator']) && $_POST['user_relator'] != ''){
                $mail_body .=' <tr>
					<td width="45%" style="padding:10px 5px; font-weight:bold;font-family:inherit;text-align: right">Are you currently under contract with a REALTOR<sup>®</sup>?:</td>
					<td width="55%" style="padding:10px 5px;text-align: left">'.$_POST['user_relator'].'</td>
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

$user_mail_body = '<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><table align="center" border="0" cellpadding="0" cellspacing="0" class="full" width="394">
    <tbody>
    <tr>
        <td height="35" width="350"> </td>
    </tr>
    </tbody>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="mobile" style="background-color: #ffffff;   width: 394px; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;" width="100%">
    <tbody>
    <tr>
        <td class="wlc-title" style="text-align: left; font-family: sans-serif; font-size: 24px; color: rgb(45, 45, 45);   font-weight: bold; text-align: center; padding-top: 38px; padding-left: 2px; padding-right: 2px; padding-bottom: 35px; color: #0062CC; font-size:   25px;">Welcome, '.$_POST['user_name'].'!</td>
    </tr>
    <tr>
        <td style="color: rgb(175, 179, 187); padding-left: 35px; padding-right: 35px; ">Thank you for signing up with '.get_bloginfo( 'name' ).'</td>
    </tr>
    <tr>
        <td style="padding-top:30px;font-weight:bold;font-family:inherit;">Please activate your account using below link:</td>
    </tr>
    <tr>
        <td style="color:rgb(175, 179, 187);padding-left:50px;padding-right:50px;font-size:14px;"><a href="'.$ActivationLink.'">ACTIVATE YOUR ACCOUNT</a><br/><span>Once your account is activated you will receive an email with your account password.</span></td>
    </tr>
    
     </tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" class="full" width="394">
    <tbody>
    <tr>
        <td height="35" width="350"> </td>
    </tr>
    </tbody>
</table></body></html>';

			?>

