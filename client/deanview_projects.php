<link rel="shortcut icon" type="image/png" href="favicon.png"/><?php
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
$faculty_rem=NULL;
$hod_rem=NULL;

include 'connect.php';
echo "<h1>Project Management System</h1>";
include 'deannavi.php';
echo "<h2>View Project Requests</h2>";
$count = 0;
if(isset($_SESSION['user']))
	{//echo "<h1>Leave Management System</h1>";
	$sql = "SELECT prevDept, username ,id FROM dean WHERE username = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{//echo "<h1>Leave Management System</h1>";
		while($row = $result->fetch_assoc())
			{
			if($_SESSION['user'] == $row['username'])
				{
				
				$sql2 = "SELECT * FROM  deanviewprojects  where STATUS = 'Requested'";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0  )
					{
						echo "<table>";
						echo "<tr>";
						echo "<th>Project Name</th>";
						echo "<th>PI </th>";
						echo "<th>Department</th>";
						echo "<th>Project Description</th>";
						echo "<th>Total budget left</th>";
						echo "<th>Man Power Type</th>";
						echo "<th>Man Power Months</th>";
						echo "<th>Action</th>";
						echo "</tr>";
						while ($row2 = $result2->fetch_assoc()){
							echo "<tr>";
							echo "<td>";
							echo $row2['Pname'];
							echo "</td>";
							echo "<td>";
							echo $row2['PI'];
							echo "</td>";
							echo "<td>";
							echo $row2['Dept'];
							echo "</td>";
							echo "<td>";
							echo $row2['Description'];
							echo "</td>";
							echo "<td>";
							echo $row2['Totalbudgetleft'];
							echo "</td>";
							echo "<td>";
							if($row2['ManPowerType']=='01')
								echo 'JRF';
							else
								echo 'SRF';
							echo "</td>";
							echo "<td>";
							echo $row2['ManPmonths'];
							echo "</td>";
							echo "<td><form action = '/' method = 'post'><br>";
							echo "<button type='submit' class='button' formaction = 'deanacceptproject.php?id=".$row2['id']."&empid=".$row["id"]."'>Accept</button> &nbsp;&nbsp;&nbsp; <button type='submit' class='button button3' formaction = 'deanrejectproject.php?id=".$row2['id']."&empid=".$row["id"]."'>Reject</button></form></td>";
							
							//echo "<td><a href = 'deanacceptleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Accept</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = 'deanrejectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Reject</a></td>";
							echo "</tr>";
							$count++;
							
						}
						echo $count." Requested";
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