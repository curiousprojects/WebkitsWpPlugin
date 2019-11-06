<?php
$mail_body = '<table align="center" border="0" cellpadding="0" cellspacing="0" class="full" width="394">
    <tbody>
    <tr>
        <td height="35" width="350"> </td>
    </tr>
    </tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" class="mobile" style="background-color: #ffffff;   width: 394px; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;" width="100%">
    <tbody>
    <tr>
        <td style="color: rgb(175, 179, 187); padding-left: 35px; padding-right: 35px; ">Your account is successfully activated, Account details are as given below: </td>
    </tr>
    <tr>
        <td style="padding-top:30px;font-weight:bold;font-family:inherit;">UserName:</td>
    </tr>
    <tr>
        <td style="color:rgb(175, 179, 187);padding-left:50px;padding-right:50px;font-size:14px;">'.$POST['user_email'].'</td>
    </tr>
    <tr>
        <td style=" font-weight:bold; padding-top: 11px;">Password:</td>
    </tr>
    <tr>
        <td style="color: rgb(175, 179, 187); padding-left: 50px; padding-right: 50px; font-size: 14px;">'.$POST['user_password'].'</td>
    </tr>
    <tr> 
        <td style="padding-top: 40px; padding-bottom: 50px;"><a href="'.$login_url.'" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; padding: 10px; font-weight: 600; font-family: sans-serif; color: rgb(255, 255, 255); background-color:#0c65c9; text-decoration: none; padding-left: 20px; padding-right: 20px; font-weight: normal; font-size: 14px;">Click here to login</a></td> 
    </tr>
    </tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" class="full" width="394">
    <tbody>
    <tr>
        <td height="35" width="350"> </td>
    </tr>
    </tbody>
</table>';
?>