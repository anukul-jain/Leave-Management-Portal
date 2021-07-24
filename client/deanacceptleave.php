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
$deanrem=$_POST['deanremarks'];
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
	$sql = "SELECT id,EmpName,LeaveType,RequestDate,Status,LeaveDays,StartDate,EndDate,Retro FROM deanemp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	$sql7 = "SELECT Dept, EmpName FROM employees WHERE username = '".$_SESSION['user']."'";
	$result7 = $conn->query($sql7);
	$row7=$result7->fetch_assoc();
	$deanname=$row7['EmpName'];
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			$leavedays = $row["LeaveDays"];
			$sql2 = "SELECT id,EarnLeave,SickLeave,CasualLeave,EmpEmail,Dept FROM employees WHERE id = '".$empid."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
				if($row['Retro']==NULL){
				while($row2 = $result2->fetch_assoc())
					{
					$earnleave = $row2["EarnLeave"];
					$diff1 = $earnleave-$leavedays;
					$sickleave = $row2["SickLeave"];
					$diff2 = $sickleave-$leavedays;
					$casualleave = $row2["CasualLeave"];
					$diff3 = $casualleave-$leavedays;
					$email = $row2["EmpEmail"];
					
					if($row["LeaveType"] == "Earn Leave")
						{
						if($diff1 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET EarnLeave = '".$diff1."' WHERE id = '".$empid."'";
						}
					else if($row["LeaveType"] == "Sick Leave")
						{
						if($diff2 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET SickLeave = '".$diff2."' WHERE id = '".$empid."'";
						}
					else if($row["LeaveType"] == "Casual Leave")
						{
						if($diff3 < 0)
							echo "Processing Error !";
						else
							$sql3 = "UPDATE employees SET CasualLeave = '".$diff3."' WHERE id = '".$empid."'";
						}
					if($conn->query($sql3) === TRUE)
							{
							$sql4 = "UPDATE deanemp_leaves SET Status = 'Granted', dean_name='".$deanname."' WHERE id = '".$id."'";
							$sql6 = "UPDATE deanemp_leaves SET Dean_Remarks = '".$deanrem."' WHERE id = '".$id."'";
							$conn->query($sql6);
							if($conn->query($sql4) === TRUE)
								{
								$msg = "Your Leave Has Been Granted Successfully ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
								$status = true;
								if($status === TRUE)
									{
										echo "The Leave Request Status For ".$row['EmpName']." Has been updated !<br/>";
									}
								}
							}
					}
				}
				else{
					while($row2 = $result2->fetch_assoc())
					{
					$earnleave = $row2["EarnLeave"];
					$diff1 = $earnleave-$leavedays;
					$sickleave = $row2["SickLeave"];
					$diff2 = $sickleave-$leavedays;
					$casualleave = $row2["CasualLeave"];
					$diff3 = $casualleave-$leavedays;
					$email = $row2["EmpEmail"];
					$check=true;
					if($check === TRUE)
							{
							$sql4 = "UPDATE deanemp_leaves SET Status = 'Granted', dean_name='".$deanname."' WHERE id = '".$id."'";
							$sql6 = "UPDATE deanemp_leaves SET Dean_Remarks = '".$deanrem."' WHERE id = '".$id."'";
							$conn->query($sql6);
							if($conn->query($sql4) === TRUE )
								{
								$msg = "This Leave request has been sent to director Successfully ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
								$empname = $row["EmpName"];
								$leavetype=$row["LeaveType"];
								$leavedate=$row["StartDate"];
								$end=$row["EndDate"];
								$ret=$row["Retro"];
								if($row["Retro"]==1)
									$sql5 = "INSERT INTO dirview_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept,Retro) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row2['Dept']."','".$ret."')";
								else
									$sql5 = "INSERT INTO dirview_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row2['Dept']."')";
								
									$conn->query($sql5);
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