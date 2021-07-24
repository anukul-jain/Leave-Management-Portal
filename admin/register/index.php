<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
<div class="reg-form">
<center>
<h1>Leave Management System</h1>
<?php
include 'adminnavi.php';?>
<h2>New Employee Registration</h2>
<i><div class = 'error'>*indicates mandatory fields</div></i>
<?php
if(isset($_GET['err']))
	{
		echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
	}
if(isset($_SESSION['adminuser']))
	{
	echo"<form action = 'confirm.php' method = 'post'>
	<table>
	<tr><td><div class = 'error'>*</div> Employee Name : </td><td><input type = 'text' name = 'empname' class = 'reg-form-fields shadow selected' placeholder = 'Employee Name'></td></tr><br>
<tr><td><div class = 'error'>*</div> Username : </td><td><input type = 'text' name = 'uname' class = 'reg-form-fields shadow selected' placeholder = 'Employee Username'></td></tr><br>
<tr><td><div class = 'error'>*</div> Date of joining (dd/mm/yyyy): <td><input type = 'number' name = 'date-join' min = '1' max = '31' class = 'date-of-joining shadow selected' step = '1' placeholder = 'dd' style='width:50px;'><input type = 'number' name = 'month-join' min = '1' max = '12' class = 'date-of-joining shadow selected' step = '1' placeholder = 'mm' style='width:50px;'><input type = 'number' name = 'year-join' min = '1985' max = '".date('Y')."' class = 'date-of-joining shadow selected' step = '1' placeholder = 'yyyy' style='width:100px;'></td></tr><br>
<tr><td><div class = 'error'>*</div> Date of birth (dd/mm/yyyy): <td><input type = 'number' name = 'date-birth' min = '1' max = '31' class = 'date-of-joining shadow selected' step = '1' placeholder = 'dd' style='width:50px;'><input type = 'number' name = 'month-birth' min = '1' max = '12' class = 'date-of-joining shadow selected' step = '1' placeholder = 'mm' style='width:50px;'><input type = 'number' name = 'year-birth' min = '1901' max = '".date('Y')."' class = 'date-of-joining shadow selected' step = '1' placeholder = 'yyyy' style='width:100px;'></td></tr><br>
<tr><td><div class = 'error'>*</div> Employee email id : </td><td><input type = 'text' name = 'mailid' class = 'reg-form-fields shadow selected' placeholder = 'Employee Email ID'></td></tr><br>

<tr><td><input type = 'submit' value = 'Register' class = 'registration shadow'></td></tr>
</form>
</table>
</center>
</div>";
	}
	else
	{
		header('location:../index.php?err='.urlencode('Please Login First To Access This Page !'));
	}
?>
</body>
</html>