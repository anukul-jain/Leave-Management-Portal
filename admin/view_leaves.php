<?php
session_start();
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="table.css">
<div class = "textview">
<center>
<?php


include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'adminnavi.php';
echo "<h2>View Employees' Leaves</h2>";
$count = 0;
if(isset($_SESSION['adminuser']))
	{
	$sql = "SELECT Dept, username FROM admins WHERE username = '".$_SESSION['adminuser']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			if($_SESSION['adminuser'] == $row['username'])
				{
				
				$sql2 = "SELECT e.Id,e.Dept,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id,el.Dept FROM employees e, emp_leaves el WHERE e.Dept = el.Dept AND e.Dept = '".$row['Dept']."' AND el.Status = 'Requested' AND e.EmpName = el.EmpName";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0)
					{
						echo "<table>";
						echo "<tr>";
						echo "<th>Employee Name</th>";
						echo "<th>Leave Type</th>";
						echo "<th>Request Date</th>";
						echo "<th>Leave Days</th>";
						echo "<th>Starting Date</th>";
						echo "<th>Ending Date</th>";
						echo "<th>Action</th>";
						echo "</tr>";
						while ($row2 = $result2->fetch_assoc())
							{
							echo "<tr>";
							echo "<td>";
							echo $row2['EmpName'];
							echo "</td>";
							echo "<td>";
							echo $row2['LeaveType'];
							echo "</td>";
							echo "<td>";
							echo $row2['RequestDate'];
							echo "</td>";
							echo "<td>";
							echo $row2['LeaveDays'];
							echo "</td>";
							echo "<td>";
							echo $row2['StartDate'];
							echo "</td>";
							echo "<td>";
							echo $row2['EndDate'];
							echo "</td>";
							echo "<td><a href = 'acceptleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Accept</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = 'rejectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Reject</a></td>";
							echo "</tr>";
							$count++;
							}
						echo $count." Leave(s)";
					}
				echo "</table>";
				}
			else
				{
				header("location:index.php?err=".urlencode('Please login first to view this page !'));
				}
			}
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please login first to view this page !'));
	}
?>
</div>
</center>