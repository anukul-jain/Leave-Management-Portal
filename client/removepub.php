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
require 'vendor/autoload.php';
$client = new MongoDB\Client(
    'mongodb+srv://civil:civil@cs301b.un6q7.mongodb.net/phase_b?retryWrites=true&w=majority');
	$db = $client->test;
	$companydb= $client->phase_b; 
	$empcollection=$companydb->phase_b_collection;

echo "<h1>Remove Publication</h1>";
include 'clientnavi.php';
include 'connect.php';
//include 'mailer.php';
$index = $_GET['index'];
//$cname = $_POST['cname'];
/*if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:home.php');
	}*/
if(isset($_SESSION['user']))
	{
		$cursor = $empcollection->find(array("user"=>$_SESSION['user']));
		$itr = new IteratorIterator($cursor); // (1)
		$itr -> rewind();
		$cursor = $itr->current();
		//echo $cursor['ccode'][$index];
		$code=$cursor['pubname'][$index];
		$cname=$cursor['pubdesc'][$index];
		$companydb->phase_b_collection->updateOne(array("user" => $_SESSION['user']),array( '$pull' =>array("pubname" => $code )));
		$companydb->phase_b_collection->updateOne(array("user" => $_SESSION['user']),array( '$pull' =>array("pubdesc" => $cname )));
		//$empcollection->deleteOne("ccode"->$code);
		//$empcollection->deleteOne("cname"->$cursor['cname'][$index]);
		//$insertOneResult = $empcollection->insertOne( ['name' => 'new', 'age' => '28','skill' => 'php']);
		/*$updateResult=$companydb->phase_b_collection->updateOne(array("user"=>$_SESSION['user']),array('$push' => array("ccode" => $ccode)));
		$updateResult=$companydb->phase_b_collection->updateOne(array("user"=>$_SESSION['user']),array('$push' => array("cname" => $cname)));
		//printf("Inserted %d documents", $updateResult->getInsertedCount()); var_dump($updateResult->getInsertedId());
		if($companydb->phase_b_collection->count(array("user"=>$_SESSION['user']))==0){
			$updateResult=$companydb->phase_b_collection->insertOne(array("user"=>$_SESSION['user']),array('$push' => array("ccode" => $ccode)));
			$updateResult=$companydb->phase_b_collection->updateOne(array("user"=>$_SESSION['user']),array('$push' => array("ccode" => $ccode)));
			$updateResult=$empcollection->updateOne(array("user"=>$_SESSION['user']),array('$push' => array("cname" => $cname)));
			
		}
*/




	/*$sql = "SELECT id,EmpName,LeaveType,RequestDate,Status,LeaveDays,StartDate,EndDate,Dept,Retro FROM emp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	$sql7 = "SELECT Dept, EmpName FROM employees WHERE username = '".$_SESSION['user']."'";
	$result7 = $conn->query($sql7);
	$row7=$result7->fetch_assoc();
	$hodname=$row7['EmpName'];
	if($result->num_rows > 0)
		{
			/*
		while($row = $result->fetch_assoc())
			{
			$leavedays = $row["LeaveDays"];
			$sql2 = "SELECT id,EarnLeave,SickLeave,CasualLeave,EmpEmail FROM employees WHERE id = '".$empid."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
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
					/*
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
					if($check === TRUE)
							{
							$sql4 = "UPDATE emp_leaves SET Status = 'Granted', hod_name='".$hodname."' WHERE id = '".$id."'";
							$sql6 = "UPDATE emp_leaves SET HOD_Remarks = '".$hodremarks."' WHERE id = '".$id."'";
							$conn->query($sql6);
							if($conn->query($sql4) === TRUE )
								{
								$msg = "This Leave request has been sent to dean Successfully ! \nEmployee Name : ".$row['EmpName']."\nLeave Type : ".$row['LeaveType']."\nNo. Of Leave Days : ".$row['LeaveDays']."\nStarting Date : ".$row['StartDate']."\nEnd date : ".$row['EndDate']."\n\n\nThanks,\nwebadmin, Leave Management System";
								$empname = $row["EmpName"];
								$leavetype=$row["LeaveType"];
								$leavedate=$row["StartDate"];
								$end=$row["EndDate"];
								$ret=$row["Retro"];
								if($row["Retro"]==1)
									$sql5 = "INSERT INTO deanemp_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept,Retro) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."','".$ret."')";
								else
									$sql5 = "INSERT INTO deanemp_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."')";
								
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
		}*/
	}
	else
		{
			header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>