<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
echo "<div class = 'textview'>";
echo "<h1>Leave Management System</h1>";
include 'adminnavi.php';
if(isset($_SESSION['adminuser']))
	{
	echo "<div class = 'textview'>";
	echo "<center>";
	echo "<h2>Search for the employee to be deleted</h2>";
	echo "<table>";
	echo "<form method = 'post' action = 'search.php'>";
	echo "<tr><td><input type = 'text' name = 'name' class = 'textbox shadow selected'></td><td><input type = 'submit' name = 'submit' value = 'Search' class = 'login-button shadow'></td></tr>";
	echo "</form>";
	echo "</table>";
	echo "</center>";
	echo "</div>";
	}
else
	{
		header('location:index.php?err='.urlencode('Please login first to access this page !'));
	}
?>
</body>
</html>