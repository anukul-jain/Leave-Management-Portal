<?php
session_start();
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="table.css">
<div class = "textview">
<center>
<html>
<head>
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
.button5 {background-color: #555555;} /* Black */
</style>
</head>
</html>
<?php


include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'hodnavi.php';
echo "<h2>View Faculty Leaves</h2>";
$count = 0;
$deanuser;
if(isset($_SESSION['user']))
	{//echo "<h1>Leave Management System</h1>";
	$sql = "SELECT Dept, username FROM hods WHERE username = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{//echo "<h1>Leave Management System</h1>";
		while($row = $result->fetch_assoc())
			{
			if($_SESSION['user'] == $row['username'])
				{
				
				$sql2 = "SELECT e.UserName,e.Id,e.Dept,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id,el.Dept, el.Remarks FROM employees e, emp_leaves el WHERE e.Dept = el.Dept AND e.Dept = '".$row['Dept']."' AND el.Status = 'Requested' AND e.EmpName = el.EmpName";
				$result2 = $conn->query($sql2);
				$sql3="SELECT username from dean";
				$result3= $conn->query($sql3);
				if($result3->num_rows > 0  ){
					while ($row3 = $result3->fetch_assoc()){
						$deanuser=$row3['username'];
					}
				}
				if($result2->num_rows > 0  )
					{
						echo "<table>";
						echo "<tr>";
						echo "<th>Employee Name</th>";
						//echo "<th>Leave Type</th>";
						echo "<th>Request Date</th>";
						echo "<th>Leave Days</th>";
						echo "<th>Starting Date</th>";
						echo "<th>Ending Date</th>";
						echo "<th>Reason for leave</th>";
						echo "<th>Action</th>";
						echo "</tr>";
						while ($row2 = $result2->fetch_assoc()){
						if($row['username']!=$row2['UserName'] && $deanuser!=$row2['UserName'])	
							{
							echo "<tr>";
							echo "<td>";
							echo $row2['EmpName'];
							echo "</td>";
							/*echo "<td>";
							echo $row2['LeaveType'];
							echo "</td>";*/
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
							echo "<td>";
							echo $row2['Remarks'];
							echo "</td>";
							
							echo "<td><form action = '/' method = 'post'>Your remarks<br>";
							echo "<input type = 'text' name = 'hodremarks' class = 'textbox shadow selected'>";
							echo "<button type='submit' class='button' formaction = 'acceptleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Accept</button> &nbsp;&nbsp;&nbsp; <button type='submit' class='button button3' formaction = 'rejectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Reject</button>&nbsp;&nbsp;&nbsp; <button type='submit' class='button button2' formaction = 'redirectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Redirect</button></form></td>";
							echo "</tr>";
							$count++;
							}
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
/*else
	{
	header('location:index.php?err='.urlencode('Please login first to view this page !'));
	}*/
?>
</div>
</center>