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
include 'hodnavi.php';
include 'connect.php';
//include 'mailer.php';
$hodremarks = $_POST['hodremarks'];
if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:hodmain.php');
	}
if(isset($_SESSION['user']))
	{
	
	$sql = "SELECT * FROM emp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	$sql7 = "SELECT Dept, EmpName FROM employees WHERE username = '".$_SESSION['user']."'";
	$result7 = $conn->query($sql7);
	$row7=$result7->fetch_assoc();
	$hodname=$row7['EmpName'];
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
							$sql3 = "UPDATE emp_leaves SET Status = 'Rejected', hod_name='".$hodname."' WHERE id = '".$id."'";
							$sql6 = "UPDATE emp_leaves SET HOD_Remarks = '".$hodremarks."' WHERE id = '".$id."'";
							$conn->query($sql6);
							if($conn->query($sql3) === TRUE)
									{
									$msg = "Your Leave Has Been Rejected ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
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