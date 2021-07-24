<link rel = "stylesheet" type = "text/css" href = "style.css">
<link rel = "stylesheet" type = "text/css" href = "table.css">
<title>::Leave Management::</title>
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

session_start();
if(isset($_SESSION['user']))
	{
	echo "<div class = 'textview'>";
	include 'connect.php';
	echo "<h1>Leave Management System</h1>";
	include 'PInavi.php';
	echo "<center>";
	echo "<h2>My All Leaves</h2>";
	$sql = "SELECT Id,UserName,EmpName FROM employees WHERE UserName = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{ 
		while($row = $result->fetch_assoc())
			{
			$name = $row["EmpName"];
			$sql2 = "SELECT * FROM emp_leaves WHERE EmpName = '".$name."'";
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
				echo "<th>HOD Remarks</th>";
				echo "<th>HOD Status</th>";
				echo "<th>Dean Remarks</th>";
				echo "<th>Dean Status</th>";
				echo "<th>Director Remarks</th>";
				echo "<th>Director Status</th>";
				//echo "<th>More Data</th></tr>";
				while($row2 = $result2->fetch_assoc())
					{
						$flag=0;
						$dirrem=NULL;
				$dirstatus=NULL;
					$req = $row2["StartDate"];
					echo "<tr><td>".$row2["EmpName"]."</td>";
					//echo "<td>".$row2["LeaveType"]."</td>";
					echo "<td>".$row2["RequestDate"]."</td>";
					echo "<td>".$row2["LeaveDays"]."</td>";
					echo "<td>".$row2["StartDate"]."</td>";
					echo "<td>".$row2["EndDate"]."</td>";
				
					if($row2["Status"]=="Redirected"){
						echo "<td><form action = '/' method = 'post'>Enter more comments<br>";
							echo "<input type = 'text' name = 'leavereason2' class = 'textbox shadow selected'>";
							echo "<button type='submit' class='button button2' formaction = 'facredirect.php?id=".$row2['id']."&empid=".$row["Id"]."'>Resend</button> </form></td>";
					}
					else {
						$sql3 = "SELECT * FROM deanemp_leaves WHERE EmpName = '".$name."'  ";
						$result3 = $conn->query($sql3);
						while($row3 = $result3->fetch_assoc()){
							if($req==$row3['StartDate']){
								 if($row3["Status"]=='Redirected'){$flag=$flag+1;
								echo "<td><form action = '/' method = 'post'>Enter more comments<br>";
								echo "<input type = 'text' name = 'leavereason3' class = 'textbox shadow selected'>";
								echo "<button type='submit' class='button button2' formaction = 'deanfacredirect.php?id=".$row3['id']."&empid=".$row["Id"]."'>Resend</button> </form></td>";
								break;
								}
							}
						}
						$sql9 = "SELECT * FROM dirview_leaves WHERE EmpName = '".$name."'  ";
						$result9 = $conn->query($sql9);
						while($row9 = $result9->fetch_assoc()){
							if($req==$row9['StartDate']){
									$dirrem=$row9["Director_Remarks"];
									$dirstatus=$row9["Status"];
									if($row9["Status"]=='Redirected'){$flag=1;
									echo "<td><form action = '/' method = 'post'>Enter more comments<br>";
									echo "<input type = 'text' name = 'leavereason4' class = 'textbox shadow selected'>";
									echo "<button type='submit' class='button button2' formaction = 'dirfacredirect.php?id=".$row9['id']."&empid=".$row2["id"]."'>Resend</button> </form></td>";
									
								}
								}
							}
						if($flag==0){
							echo "<td>".$row2["Remarks"]."</td>";
						}
						
					}
					echo "<td>".$row2["HOD_Remarks"]."</td>";
					echo "<td>".$row2["Status"]."</td>";
					$deanrem='N/A';
					$sql3 = "SELECT * FROM deanemp_leaves WHERE EmpName = '".$name."'  ";
					$result3 = $conn->query($sql3);
					while($row3 = $result3->fetch_assoc()){
						if($req==$row3['StartDate']){
							/*if($row3["Status"]=='Rejected'){
								echo "<td>".$deanrem."</td>";
								echo "<td>".$deanrem."</td>";

							}*/
							//else {
							echo "<td>".$row3["Dean_Remarks"]."</td>";
						echo "<td>".$row3["Status"]."</td>";
							//}
						
						break;
						}
					
					}
					
					echo "<td>".$dirrem."</td>";
					echo "<td>".$dirstatus."</td>";
					
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