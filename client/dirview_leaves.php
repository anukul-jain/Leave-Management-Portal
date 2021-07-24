<link rel="shortcut icon" type="image/png" href="favicon.png"/>
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
include 'dirnavi.php';
echo "<h2>View Faculty Leaves</h2>";
$count = 0;
$deanuser;
if(isset($_SESSION['user']))
	{//echo "<h1>Leave Management System</h1>";
	$sql = "SELECT  username FROM director WHERE username = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{//echo "<h1>Leave Management System</h1>";
			if($_SESSION['user'] == $row['username'])
				{
				
					$sql2 = "SELECT e.UserName,e.Id,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id, el.Remarks FROM employees e, dirview_leaves el WHERE  el.Status = 'Requested' AND e.EmpName = el.EmpName";
					$result2 = $conn->query($sql2);
					
				/*$sql3="SELECT username from dean";
				$result3= $conn->query($sql3);
				if($result3->num_rows > 0  ){
					while ($row3 = $result3->fetch_assoc()){
						$deanuser=$row3['username'];
					}
				}*/
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
						echo "<th>Reason for leave</th>";
						echo "<th>Action</th>";
						echo "</tr>";
						while ($row2 = $result2->fetch_assoc()){
						//if($row['username']!=$row2['UserName'] )	
							//{
							$sql4="SELECT Remarks from emp_leaves where StartDate= '".$row2['StartDate']."' and EmpName = '".$row2['EmpName']."'";
							$result4 =$conn->query($sql4);
							$row4=$result4->fetch_assoc();
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
							echo "<td>";
							if($result4->num_rows > 0)
								echo $row4['Remarks'];
							else
								echo $row2['Remarks'];
							echo "</td>";
							echo "<td><form action = '/' method = 'post'>Your remarks<br>";
							echo "<input type = 'text' name = 'dirremarks' class = 'textbox shadow selected'>";
							echo "<button type='submit' class='button' formaction = 'diracceptleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Accept</button> &nbsp;&nbsp;&nbsp; <button type='submit' class='button button3' formaction = 'dirrejectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Reject</button>&nbsp;&nbsp;&nbsp; <button type='submit' class='button button2' formaction = 'dirredirectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Redirect</button></form></td>";
							echo "</tr>";
							$count++;
							//}
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