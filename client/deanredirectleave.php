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
$deanremarks = $_POST['deanremarks'];
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
	
	$sql = "SELECT * FROM deanemp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
				$sql2 = "SELECT id,EmpEmail FROM employees WHERE id = '".$empid."'";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0)
					{
						while($row2 = $result2->fetch_assoc())
							{
							$email = $row2['EmpEmail'];
							$sql3 = "UPDATE deanemp_leaves SET Status = 'Redirected' WHERE id = '".$id."'";
							$sql6 = "UPDATE deanemp_leaves SET Dean_Remarks = '".$deanremarks."' WHERE id = '".$id."'";
							$conn->query($sql6);
							if($conn->query($sql3) === TRUE)
									{
									$msg = "Your Leave Has Been Redirected ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
									$status = true;
									if($status === TRUE)
										{
										echo "The Leave Request Status For ".$row['EmpName']." Has been updated !<br/>";
										}
									}	
							}
					}
			}
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