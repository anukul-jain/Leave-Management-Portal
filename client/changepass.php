<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
</head>
<link rel = "stylesheet" type = "text/css" href = "style.css">
<body>
<div class = "textview">
	<?php
	echo "<h1>Leave Management System</h1>";
	include 'clientnavi.php';
	if(isset($_SESSION['user']))
	{
		echo "<h2>Change Password</h2>";
		if(isset($_GET['err']))
		{
		echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div><br/>";
		}
	?>
<center>
<table>
<form action = "password.php" method = "post">
	<tr>
		<td> Your Old Password : </td>
		<td> <input type = "password" name = "oldpass" class = "textbox shadow selected"> </td>
	</tr>
	<tr>
		<td> New Password : </td>
		<td> <input type = "password" name = "newpass" class = "textbox shadow selected"> </td>
	</tr>
	<tr>
		<td> Confirm New Password : </td>
		<td> <input type = "password" name = "cnfnewpass" class = "textbox shadow selected"> </td>
	</tr>
	<tr>
		<td> <input type = "submit" value = "Change" class = "login-button shadow"> </td>
	</tr>
</form>
</table>
</center>
</div>
	<?php
	}
	else
		{
		header("location:index.php?err=".urlencode('Please Login First to access this page !'));
		}
	?>
</body>
</html>