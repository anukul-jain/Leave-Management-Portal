<link rel="shortcut icon" type="image/png" href="favicon.png"/><?php
session_start();
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="table.css">
<div class = "textview">
<center>
<?php
$flag=0;

include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'dirnavi.php';
echo "<h2>View Faculty Leaves</h2>";
$count = 0;
if(isset($_SESSION['user']))
	{//echo "<h1>Leave Management System</h1>";
	$sql = "SELECT Dept, username FROM director WHERE username = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{//echo "<h1>Leave Management System</h1>";
		while($row = $result->fetch_assoc())
			{
			if($_SESSION['user'] == $row['username'])
				{
				
				$sql2 = "SELECT e.UserName,e.Id,e.Dept,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id,el.Dept FROM employees e, emp_leaves el WHERE  el.Status = 'Requested' AND e.EmpName = el.EmpName";
				$result2 = $conn->query($sql2);
				$sql3="SELECT username from dean";
				$result3= $conn->query($sql3);
				if($result3->num_rows > 0  ){
					while ($row3 = $result3->fetch_assoc()){
						$deanuser=$row3['username'];
					}
				}
				$sql4="SELECT username from hods";
				$result4= $conn->query($sql4);
				if($result4->num_rows > 0  ){
					while ($row4 = $result4->fetch_assoc()){
						$hoduser=$row4['username'];
				if($result2->num_rows > 0  )
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
						while ($row2 = $result2->fetch_assoc()){
						if( $deanuser==$row2['UserName']&&$flag==0)	
							{
								$flag=1;
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
							else if($hoduser==$row2['UserName']){
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
						}
						echo $count." Leave(s)";
					}
				echo "</table>";
				}
			}
				}
			else
				{
				header("location:index.php?err=".urlencode('Please login first to view this page !'));
				}
			}
		}
	}
/*else
	{
	header('location:index.php?err='.urlencode('Please login first to view this page !'));
	}*/
?>
</div>
</center>