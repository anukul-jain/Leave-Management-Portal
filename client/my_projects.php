<link rel = "stylesheet" type = "text/css" href = "style.css">
<link rel = "stylesheet" type = "text/css" href = "table.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
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
	include 'clientnavi.php';
	echo "<center>";
	if(isset($_GET['err']))
		{
			echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div><br/>";
		}
	$sql = "SELECT * FROM employees WHERE UserName = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{ 
			echo "<h2>Project(s) As PI</h2>";
			while($row = $result->fetch_assoc())
			{
			$name = $row["EmpName"];
			$username = $row["UserName"];
			$dept=$row["Dept"];
			$sql2 = "SELECT * FROM projects WHERE PI = '".$username."'";
			$result2 = $conn->query($sql2);

			if($result2->num_rows > 0)
				{
				echo "<table>";
				echo "<tr><th>Project Name</th>";
				echo "<th>PI Name</th>";
				echo "<th>Co-PI 1</th>";
				echo "<th>Co-PI 2</th>";
				echo "<th>Co-PI 3</th>";
				echo "<th>Co-PI 4</th>";
				echo "<th>Initial Budget </th>";
				echo "<th>Budget Left</th>";
				echo "<th>Project Description</th>";
				echo "<th> ManPower Status </th>";
				while($row2 = $result2->fetch_assoc())
					{
					echo "<tr><td>".$row2["ProjectName"]."</td>";
					//echo "<td>".$row2["LeaveType"]."</td>";
					echo "<td>".$row2["PI"]."</td>";
					echo "<td>".$row2["CoPI1"]."</td>";
					echo "<td>".$row2["CoPI2"]."</td>";
					echo "<td>".$row2["CoPI3"]."</td>";
					echo "<td>".$row2["CoPI4"]."</td>";
					echo "<td>".$row2["Totalbudget"]."</td>";
					echo "<td>".$row2["Totalbudgetleft"]."</td>";
					echo "<td>".$row2["Description"]."</td>";
					$sql3="SELECT * from deanviewprojects where PI = '".$row2['PI']."'and Pname = '".$row2['ProjectName']."'";
					$result3 = $conn->query($sql3);
					$row3=$result3->fetch_assoc();
					if($result3->num_rows > 0){
					if($row3['STATUS']== 'Granted'){
						echo "<td>Man Power has been already hired</td>";
					}
					else if($row3['STATUS']== 'Requested'){
						echo "<td>Man Power has been already requested</td>";
					}
					else if($row2['STATUS']=='Requested'){
						echo "<td><form action = '/' method = 'post'><br><button type='submit' class='button' formaction = 'sendtoPIdean.php?id=".$row2['id']."&empid=".$row["id"]."'>Accept</button> &nbsp;&nbsp;&nbsp; <button type='submit' class='button button3' formaction = 'PIrejectproject.php?id=".$row2['id']."&empid=".$row["id"]."'>Reject</button></form></td>";
					}
					else{
					echo "<td style='width:12%'><form action = '/' method = 'post'>";
							echo "<select name = 'Manpower_Type' class = 'textbox shadow selected style='width:10px;'>
							<option value = '01'>JRF</option>
							<option value = '02'>SRF</option>
						</select>
							<select name = 'No_of_months' class = 'textbox shadow selected'>
							<option value = '01'>1</option>
							<option value = '02'>2</option>
							<option value = '03'>3</option>
							<option value = '04'>4</option>
							<option value = '05'>5</option>
							<option value = '06'>6</option>
							<option value = '07'>7</option>
							<option value = '08'>8</option>
							<option value = '09'>9</option>
							<option value = '10'>10</option>
							<option value = '11'>11</option>
							<option value = '12'>12</option>
						</select><br>";
							echo "<button type='submit' class='button' formaction = 'sendtodean.php?id=".$row2['id']."&empid=".$row["id"]."'>Send</button> </form></td>";
							
						}
					}
					else if($row2['STATUS']=='Requested'){
						echo "<td><form action = '/' method = 'post'><br><button type='submit' class='button' formaction = 'sendtoPIdean.php?id=".$row2['id']."&empid=".$row["id"]."'>Accept</button> &nbsp;&nbsp;&nbsp; <button type='submit' class='button button3' formaction = 'PIrejectproject.php?id=".$row2['id']."&empid=".$row["id"]."'>Reject</button></form></td>";
					}
					else{
					echo "<td style='width:12%'><form action = '/' method = 'post'>";
							echo "<select name = 'Manpower_Type' class = 'textbox shadow selected style='width:10px;'>
							<option value = '01'>JRF</option>
							<option value = '02'>SRF</option>
						</select>
							<select name = 'No_of_months' class = 'textbox shadow selected'>
							<option value = '01'>1</option>
							<option value = '02'>2</option>
							<option value = '03'>3</option>
							<option value = '04'>4</option>
							<option value = '05'>5</option>
							<option value = '06'>6</option>
							<option value = '07'>7</option>
							<option value = '08'>8</option>
							<option value = '09'>9</option>
							<option value = '10'>10</option>
							<option value = '11'>11</option>
							<option value = '12'>12</option>
						</select><br>";
							echo "<button type='submit' class='button' formaction = 'sendtodean.php?id=".$row2['id']."&empid=".$row["id"]."'>Send</button> </form></td>";
							
						}
					}
				
				echo "</table>";
				echo "</center>";
				//echo "</div>";
				echo "<h2>Project(s) As Co-PI</h2>";
				echo "<center>";
			$sql2 = "SELECT * FROM projects WHERE CoPI1 = '".$username."' or CoPI2 = '".$username."' or CoPI3 = '".$username."'or CoPI4 = '".$username."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
				echo "<table>";
				echo "<tr><th>Project Name</th>";
				echo "<th>PI Name</th>";
				echo "<th>Co-PI 1</th>";
				echo "<th>Co-PI 2</th>";
				echo "<th>Co-PI 3</th>";
				echo "<th>Co-PI 4</th>";
				echo "<th>Initial Budget </th>";
				echo "<th>Budget Left</th>";
				echo "<th>Project Description</th>";
				echo "<th>Request ManPower</th>";
				while($row2 = $result2->fetch_assoc())
					{
					echo "<tr><td>".$row2["ProjectName"]."</td>";
					//echo "<td>".$row2["LeaveType"]."</td>";
					echo "<td>".$row2["PI"]."</td>";
					echo "<td>".$row2["CoPI1"]."</td>";
					echo "<td>".$row2["CoPI2"]."</td>";
					echo "<td>".$row2["CoPI3"]."</td>";
					echo "<td>".$row2["CoPI4"]."</td>";
					echo "<td>".$row2["Totalbudget"]."</td>";
					echo "<td>".$row2["Totalbudgetleft"]."</td>";
					echo "<td>".$row2["Description"]."</td>";
					$sql3="SELECT * from deanviewprojects where PI = '".$row2['PI']."'and Pname = '".$row2['ProjectName']."'";
					$result3 = $conn->query($sql3);
					$row3=$result3->fetch_assoc();
					if($result3->num_rows > 0){
					if($row3['STATUS']== 'Granted'){
						echo "<td>Man Power has been already hired</td>";
					}
					else if($row3['STATUS']== 'Requested'||$row2['STATUS']=='Requested'){
						echo "<td>Man Power has been already requested</td>";
					}
					else{
						echo "<td style='width:12%'><form action = '/' method = 'post'>";
								echo "<select name = 'Manpower Type' class = 'textbox shadow selected style='width:10px;'>
								<option value = '01'>JRF</option>
								<option value = '02'>SRF</option>
							</select>
								<select name = 'No of months' class = 'textbox shadow selected'>
								<option value = '01'>1</option>
								<option value = '02'>2</option>
								<option value = '03'>3</option>
								<option value = '04'>4</option>
								<option value = '05'>5</option>
								<option value = '06'>6</option>
								<option value = '07'>7</option>
								<option value = '08'>8</option>
								<option value = '09'>9</option>
								<option value = '10'>10</option>
								<option value = '11'>11</option>
								<option value = '12'>12</option>
							</select><br>";
								echo "<button type='submit' class='button' formaction = 'sendtopi.php?id=".$row2['id']."&empid=".$row["id"]."'>Send</button> </form></td>";
						}
				}
					else{
					echo "<td style='width:12%'><form action = '/' method = 'post'>";
							echo "<select name = 'Manpower Type' class = 'textbox shadow selected style='width:10px;'>
							<option value = '01'>JRF</option>
							<option value = '02'>SRF</option>
						</select>
							<select name = 'No of months' class = 'textbox shadow selected'>
							<option value = '01'>1</option>
							<option value = '02'>2</option>
							<option value = '03'>3</option>
							<option value = '04'>4</option>
							<option value = '05'>5</option>
							<option value = '06'>6</option>
							<option value = '07'>7</option>
							<option value = '08'>8</option>
							<option value = '09'>9</option>
							<option value = '10'>10</option>
							<option value = '11'>11</option>
							<option value = '12'>12</option>
						</select><br>";
							echo "<button type='submit' class='button' formaction = 'sendtopi.php?id=".$row2['id']."&empid=".$row["id"]."'>Send</button> </form></td>";
					}
				
					}
				
				echo "</table>";
				echo "</center>";
				echo "</div>";
				}
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