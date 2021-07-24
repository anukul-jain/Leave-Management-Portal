<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
if(isset($_SESSION['user']))
	{
	header('location:home.php');
	}
	else
	{	
	echo "<body>";
	echo "<div class='textview'>";
	echo "<center>";
	echo "<h1>Leave Management System</h1>";
	include 'navi.php';
	echo "<h2>Faculty Login</h2>";
	if(isset($_GET['err']))
		{
			echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div><br/>";
		}
	echo "<form name = 'login' action = 'validate.php' method = 'post' onsubmit = 'return valid()'>";
	echo "<table>";
	echo "<tr><td>Username : </td><td><input type = 'text' name = 'uname' class = 'textbox shadow selected' placeholder = 'Your Username'></td></tr><br/>";
	echo "<tr><td>Password : </td><td><input type = 'password' name = 'pass' class = 'textbox shadow selected' placeholder = 'Your Password'></td></tr><br/>";
	echo "<tr><td><input type = 'submit' value = 'Login' class = 'login-button shadow'></td>";
	//echo "<td><a href = 'passrecovery.php'>Forgot Your password ?</a></td></tr>";
	echo "</table>";
	echo "</form>";
	echo "<p>Your default Password is your Username</p>";
	echo "</center>";
	echo "</div>";
	echo "</body>";
	}
?>
<html>
<head>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png">
<script type = "text/javascript">
function valid()
{
	var user = document.login.uname.value;
	var user = user.trim();
	var pass = document.login.pass.value;
	if (user == '')
		{
			alert("Please Enter Username !");
			return false;
		}
	else if (pass == '')
		{
			alert("Please Enter Password !");
			return false;
		}
	else
		{
			return true;
		}
}
</script>

</head>
</html>
