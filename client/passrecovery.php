<html>
<head>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class = 'textview'>
<center>
<h1>Leave Management System</h1>
<?php
include 'navi.php';
echo "<h2>Reset Your Password</h2>";
if(isset($_GET['err']))
	{
	echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
	}
?>
<table>
<form action = 'recovery.php' method = 'post'>
<tr><td>Enter email id : </td><td><input type = 'text' name = 'recoverykey' class = 'textbox shadow selected' placeholder = 'your registered email id'></td></tr>
<tr><td><input type = 'submit' value = 'Reset Password' class = 'recovery shadow'></td></tr>
</table>
</form>
</center>
</div>
</body>
</html>