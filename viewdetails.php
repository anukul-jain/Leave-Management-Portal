<?php
session_start();
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="client/style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="client/table.css">
<div class = "textview">
<center>
<?php


include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'navi.php';
echo "<h2>View employee information</h2>";
$count = 0;

$sql = "SELECT e.Id,e.EmpEmail,e.EmpName, e.UserName FROM employees e  ";
$result = $conn->query($sql);
if($result->num_rows > 0)
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Faculty Name</th>";
		echo "<th>Email</th>";
		echo "<th>View portal</th>";
		echo "</tr>";
		while($row = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$row['EmpName']."</td>";
				echo "<td>".$row['EmpEmail']."</td>";
				echo "<td><a href = 'facpage.php?user=".$row['UserName']."'>View details</a> </td>";
				echo "</tr>";
		}
	}
			


/*if(isset($_SESSION['adminuser']))
	{
	$sql = "SELECT Dept, username FROM admins WHERE username = '".$_SESSION['adminuser']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
				if($_SESSION['adminuser'] == "cc"){
				
					$sql2 = "SELECT e.Id,e.Dept,e.EmpName, e.UserName FROM employees e  ";
					$result2 = $conn->query($sql2);
					
					
					$sql5 = "SELECT username FROM director e  ";
					$result5 = $conn->query($sql5);
					$row5=$result5->fetch_assoc();
					$sql6 = "SELECT username FROM dean e ";
					$result6 = $conn->query($sql6);
					$row6=$result6->fetch_assoc();
					if($result2->num_rows > 0)
						{
							echo "<table>";
							echo "<tr>";
							echo "<th>Employee Name</th>";
							// echo "<th>Leave Type</th>";
							// echo "<th>Request Date</th>";
							// echo "<th>Leave Days</th>";
							// echo "<th>Starting Date</th>";
							// echo "<th>Ending Date</th>";
							echo "<th>Action</th>";
							echo "</tr>";
							//$sql3="SELECT id from hods where Dept= '".$row['Dept']."' ";
							//$result3 = $conn->query($sql3);
							
							while ($row2 = $result2->fetch_assoc())
								{$flag=0;//echo $row2['UserName'];
									$sql4 = "SELECT username FROM hods";
									$result4 = $conn->query($sql4);
									while($row4=$result4->fetch_assoc()){
										if($row4['username']== $row2['UserName']){
											$flag=1;
											break;
										}
									}
									//echo $flag=0;;
								//	if($result3["id"]<>$row['id'] ){
									if($flag==0 &&$row5['username']!= $row2['UserName']&&$row6['username']!= $row2['UserName']){
								echo "<tr>";
								echo "<td>";
								echo $row2['EmpName'];
								echo "</td>";
								echo "<td><a href = 'makedean.php?id=".$row2['Id']."&empid=".$row2["Id"]."'>Make DEAN</a></td>";
								echo "</tr>";
									}
									//}
								
							}
						}
					echo "</table>";
					}
				else if($_SESSION['adminuser'] == $row['username'])
				{
				
				$sql2 = "SELECT e.Id,e.Dept,e.EmpName, e.UserName FROM employees e WHERE e.Dept = '".$row['Dept']."' ";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0)
					{
						echo "<table>";
						echo "<tr>";
						echo "<th>Employee Name</th>";
						// echo "<th>Leave Type</th>";
						// echo "<th>Request Date</th>";
						// echo "<th>Leave Days</th>";
						// echo "<th>Starting Date</th>";
						// echo "<th>Ending Date</th>";
						//echo "<th>Action</th>";
						echo "</tr>";
						//$sql3="SELECT id from hods where Dept= '".$row['Dept']."' ";
						//$result3 = $conn->query($sql3);
						$sql4 = "SELECT username FROM hods e WHERE e.Dept = '".$row['Dept']."' ";
						$result4 = $conn->query($sql4);
						$row4=$result4->fetch_assoc();
						$sql5 = "SELECT username FROM director e  ";
						$result5 = $conn->query($sql5);
						$row5=$result5->fetch_assoc();
						$sql6 = "SELECT username FROM dean e ";
						$result6 = $conn->query($sql6);
						$row6=$result6->fetch_assoc();
						while ($row2 = $result2->fetch_assoc())
							{
							//	if($result3["id"]<>$row['id'] ){
							if($row4['username']!= $row2['UserName'] &&$row5['username']!= $row2['UserName']&&$row6['username']!= $row2['UserName']){
							echo "<tr>";
							echo "<td>";
							echo $row2['EmpName'];
							echo "</td>";
							echo "<td><a href = 'makehod.php?id=".$row2['Id']."&empid=".$row2["Id"]."'>Make HOD</a> </td><td><a href = 'makedir.php?id=".$row2['Id']."&empid=".$row2["Id"]."'>Make Director</a></td>";
							//echo "<td><a href = 'makedir.php?id=".$row2['Id']."&empid=".$row2["Id"]."'>Make Director</a></td>";
							echo "</tr>";
							}
								//}
							}
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
	}*/
?>
</div>
</center>