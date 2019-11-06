<?php
$mail_body = '<table align="center" border="0" cellpadding="0" cellspacing="0" class="full" width="394">
	<tbody>
		<tr>
			<td height="35" width="350">&nbsp;</td>
		</tr>
	</tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" class="mobile" style="background-color: #ffffff;  width: 394px; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;" width="100%">
	<tbody>
		<tr>
			<td style="text-align: left; font-family: sans-serif; font-size: 24px; color: rgb(45, 45, 45);  font-weight: bold; text-align: center; padding-top: 38px; padding-left: 2px; padding-right: 2px; padding-bottom: 35px; color: #0c65c9; font-size:  25px;">Dear, '.$res->user.'!</td>
		</tr>
		<tr>
			<td style="color: rgb(175, 179, 187); padding-left: 35px; padding-right: 35px; ">Here is your password :</td>
		</tr>
		<tr>
			<td style="color: rgb(175, 179, 187); padding-left: 50px; padding-right: 50px; font-size: 14px;">'.$_POST['user_password'].'</td>
		</tr>
		<tr>
			<td height="35" width="350">&nbsp;</td>
		</tr>
	</tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" class="full" width="394">
	<tbody>
		<tr>
			<td height="35" width="350">&nbsp;</td>
		</tr>
	</tbody>
</table>
';


?>