<link rel = "stylesheet" type = "text/css" href = "style.css">
<link rel = "stylesheet" type = "text/css" href = "table.css">
<title>::Leave Management::</title>
<?php
session_start();
if(isset($_SESSION['user']))
	{
	echo "<div class = 'textview'>";
	include 'connect.php';
	echo "<h1>Leave Management System</h1>";
	include 'hodnavi.php';
	echo "<center>";
	echo "<h2>My All Leaves</h2>";
	$sql = "SELECT id,UserName,EmpName FROM employees WHERE UserName = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			$name = $row["EmpName"];
			$sql2 = "SELECT * FROM dirview_leaves WHERE EmpName = '".$name."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
				echo "<table>";
				echo "<tr><th>Name</th>";
				//echo "<th>Type Of Leave</th>";
				echo "<th>Request Date</th>";
				echo "<th>Days Of Leave</th>";
				echo "<th>Start Date</th>";
				echo "<th>End Date</th>";
				echo "<th>Reason</th>";
				echo "<th>Director Remarks</th>";
				echo "<th>Status</th>";
				//echo "<th>More Data</th></tr>";
				while($row2 = $result2->fetch_assoc())
					{
					echo "<tr><td>".$row2["EmpName"]."</td>";
					//echo "<td>".$row2["LeaveType"]."</td>";
					echo "<td>".$row2["RequestDate"]."</td>";
					echo "<td>".$row2["LeaveDays"]."</td>";
					echo "<td>".$row2["StartDate"]."</td>";
					echo "<td>".$row2["EndDate"]."</td>";
					echo "<td>".$row2["Remarks"]."</td>";
					echo "<td>".$row2["Director_Remarks"]."</td>";
					echo "<td>".$row2["Status"]."</td>";
					//echo "<td><a href = 'leaves/".$_SESSION['user'].$row2["StartDate"].$row2["LeaveType"].$row2["EndDate"].".pdf'>Download</a></td>";
					}
				echo "</table>";
				echo "</center>";
				echo "</div>";
				}
			}
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
	exit();
	}
?>