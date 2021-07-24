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
//$deanrem=$_POST['deanremarks'];
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
		$flag=0;
	$sql = "SELECT * FROM deanviewprojects WHERE id='".$id."' and STATUS <> 'Rejected' ";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	if($row['ManPowerType']=='01'){
		if($row['ManPmonths']*31000<=$row['Totalbudgetleft']){
			$diff1=$row['Totalbudgetleft']-$row['ManPmonths']*31000;
			$sql3 = "UPDATE projects SET Totalbudgetleft = '".$diff1."' WHERE PI = '".$row['PI']."' and ProjectName = '".$row['Pname']."'";
			$conn->query($sql3);
			$sql5 = "SELECT EmpName FROM employees WHERE username = '".$_SESSION['user']."'";
			$result5 = $conn->query($sql5);
			$row5=$result5->fetch_assoc();
			$sql4 = "UPDATE deanviewprojects SET STATUS = 'Granted',dean_name='".$row5['EmpName']."' WHERE id='".$id."'";
			$conn->query($sql4);
		}
		else{
			$flag=1;
		}
	}
	else{
		if($row['ManPmonths']*40000<=$row['Totalbudgetleft']){
			$diff1=$row['Totalbudgetleft']-$row['ManPmonths']*40000;
			$sql3 = "UPDATE projects SET Totalbudgetleft = '".$diff1."' WHERE PI = '".$row['PI']."'and ProjectName = '".$row['Pname']."'";
			$conn->query($sql3);
			$sql5 = "SELECT EmpName FROM employees WHERE username = '".$_SESSION['user']."'";
			$result5 = $conn->query($sql5);
			$row5=$result5->fetch_assoc();
			$sql4 = "UPDATE deanviewprojects SET STATUS = 'Granted',dean_name='".$row5['EmpName']."' WHERE id='".$id."'";
			$conn->query($sql4);
		}
		else{
			$flag=1;
		}
	}
	if($flag==0){
		echo 'The Request has been accepted';
	}
	else{
		header('location:deanrejectproject.php?err='.urlencode('Budget Insufficient.....Request rejected !'));
	}
	}
	else
		{
			header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>