<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>OTP verification Email</title>
</head>

<body>
	<div class="container">
		<table>
			<tr class="emailHeader">
				<th class="emailImg" style="text-align: center;">
					<img class="emailLogo" style="width: 80px;" src="<?php echo base_url()?>assets/images/logo.png"> 
				</th>
			</tr>
			<tr>
				<td class="forgotPass" style="font-size: 22px;"><hr/></td>
			</tr>
			<tr>
				<td class="user" style="font-size: 18px;">
					Welcome, <br /><?php echo $name;?>
				</td>
			</tr>
			<tr>
				<td class="emailpara" style="font-size: 18px;">
					OTP is <strong><?php echo $otp;?></strong>
				</td>
			</tr>
			<tr>
				<td style="font-size: 18px;">
					Regards, <br/>IION Team
				</td>
			</tr>			
		</table>
	</div>
</body>

</html>
