<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
$year = date("Y"); 
if(isset($_SESSION['user']))
	{  echo "<div class = 'textview'>";
	   echo "<h1>Leave Management System</h1>";
	   include 'hodnavi.php';
	   include 'connect.php';
	   //include 'acceptleave.php';
	   //include 'rejectleave.php';
	   //include 'view_leaves.php';
       echo "<h2>Welcome, " . $_SESSION["user"] ."</h2>";
	   if(isset($_GET['msg']))
		{
		echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['msg'])."</u></b></div><br/>";
		}
	   echo "<table>";
		$user = $_SESSION['user'];
		$sql="SELECT * FROM employees WHERE  UserName = '".$user."'";
		$result = $conn->query($sql);
		$startd=NULL;
		$flag=0;
		$row5=$result->fetch_assoc();
		$empname=$row5['EmpName'];
		$sql2 = "SELECT * FROM dirview_leaves WHERE EmpName = '".$empname."'";
		$result2 = $conn->query($sql2);
		$t=time();
		if($result2->num_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				if(strtotime($row2['StartDate']) <= time() && $row2['Retro']==NULL&& ($row2['Status']=='Requested'||$row2['Status']=='Redirected')){
					$startd=$row2['StartDate'];
					$flag=1;
					break;
				}
			}
		}
		$rem='The application was automatically rejected by the system as the application was not approved/rejected by the proposed start date';
	
	if($flag==1){
		$sql4="UPDATE dirview_leaves SET Status = 'Rejected', Director_Remarks='".$rem."' where StartDate ='".$startd."' and EmpName = '".$empname."'";
		$conn->query($sql4);
	}
	$sql = "SELECT * FROM employees WHERE UserName = '".$user."'";
	$result = $conn->query($sql);
		echo "<table>";
			if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if($row["UpdateStatus"]<$year){
							$row["UpdateStatus"]=$year;
							$sql7="UPDATE employees SET SickLeave = 15, UpdateStatus = '".$year."' where  UserName = '".$user."'";
							$conn->query($sql7);
							$row["SickLeave"]=15;
						}
						echo "<tr><th>Profile Picture : </th><td><img src ='pro-pic/".$user.".jpg' height = 200 width = 200><a href = 'change_pp.php'>Change</a>&nbsp;&nbsp;&nbsp;<a href = 'delete_pp.php'>Delete</a></td></tr>";
						echo "<tr><th>User Name : </th><td>".$row["UserName"]."</tr>";
						echo "<tr><th>Email ID : </th><td>".$row["EmpEmail"]."</td></tr>";
						echo "<tr><th>Employee Name : </th><td>".$row["EmpName"]."</td></tr>";
						echo "<tr><th>Department : </th><td>".$row["Dept"]."</td></tr>";
						//echo "<tr><th>Earn Leave : </th><td>".$row["EarnLeave"]."</td></tr>";
						echo "<tr><th> Leaves : </th><td>".$row["SickLeave"]."</td></tr>";
						//echo "<tr><th>Casual Leave : </th><td>".$row["CasualLeave"]."</td></tr>";
						echo "<tr><th>Date Of Joining : </th><td>".$row["DateOfJoin"]."</td></tr>";
						echo "<tr><th>Current Time : </th><td><div id = 'clock'></div></td></tr>";
						
						}
			}
	   echo "</table>";
	}
else
	{
		header('location:index.php?err='.urlencode('Please Login First For Accessing This Page !'));
		exit();
	}
?>

<html>
<head>
<title>::Leave Management::</title>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
</script>
</head>
<body onload="startTime()">

<link rel='stylesheet' type='text/css' href='style.css'>
<link rel="stylesheet" type="text/css" href="table.css">
