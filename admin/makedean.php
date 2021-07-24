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
include 'adminnavi.php';
include 'connect.php';
//include 'mailer.php';

if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:home.php');
	}
if(isset($_SESSION['adminuser']))
	{
		$sql = "SELECT UserName, EmpPass,EmpName, Dept, SickLeave, CasualLeave, EarnLeave from employees where id = '".$id."' ";
		$result = $conn->query($sql);
		while($row2 = $result->fetch_assoc())
					{
						$uname = $row2['UserName'];
						$pass = $row2['EmpPass'];
						$ename = $row2['EmpName'];
						$dept=$row2['Dept'];
						$sl=$row2['SickLeave'];
						$el=$row2['EarnLeave'];
						$cl=$row2['CasualLeave'];
					}
		$sql3="SELECT prevDept from dean ";
		$result2 = $conn->query($sql3);
		if($result2->num_rows > 0){
			$sql4= "DELETE FROM dean ";
			$conn->query($sql4);
		}
		
		$sql2 = "INSERT INTO dean (id, username, password , prevDept, SetSickLeave, SetCasualLeave, SetEarnLeave) VALUES "."('".$id."','".$uname."','".$pass."','".$dept."','".$sl."','".$cl."','".$el."')";
		$conn->query($sql2);
		echo "<h1>Changes Made</h1>";
	}
	else
		{
			header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>