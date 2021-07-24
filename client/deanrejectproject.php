<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
</head>
<body>
<link rel = "stylesheet" href = "style.css">
<div class = "textview">
<?php
echo "<h1>Leave Management System</h1>";
include 'deannavi.php';
include 'connect.php';
//include 'mailer.php';
if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:deanmain.php');
	}
if(isset($_SESSION['user']))
	{
		$sql = "SELECT EmpName FROM employees WHERE username = '".$_SESSION['user']."'";
		$result = $conn->query($sql);
		$row=$result->fetch_assoc();
		$sql4 = "UPDATE deanviewprojects SET STATUS = 'Rejected',dean_name='".$row['EmpName']."' WHERE id='".$id."'";
		$conn->query($sql4);
		echo 'The Request has been rejected';
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
	}
?>
</div>
</body>
</html>