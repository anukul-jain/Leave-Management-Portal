<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include 'clientnavi.php';
include 'connect.php';

$username=$_SESSION['user'];
require 'vendor/autoload.php';
$client = new MongoDB\Client(
    'mongodb+srv://civil:civil@cs301b.un6q7.mongodb.net/phase_b?retryWrites=true&w=majority');
	$db = $client->test;
	$companydb= $client->phase_b; 
	$empcollection=$companydb->phase_b_collection;
	$cursor = $empcollection->find(array("user"=>$username));
$itr = new IteratorIterator($cursor); // (1)
$itr -> rewind();
if(isset($_SESSION['user'])){
$sql="SELECT * FROM employees WHERE  UserName = '".$username."'";
		$result = $conn->query($sql);
echo "<br><br><br><br><br>";
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
				
				echo "<div class='row'><div class='column1'>";
				echo "<table >";
				echo "<tr><th>Profile Picture : </th><td><img src ='pro-pic/".$username.".jpg' height = 200 width = 200></td></tr>";
				echo "<tr><th>User Name : </th><td>".$row["UserName"]."</tr>";
				echo "<tr><th>Email ID : </th><td>".$row["EmpEmail"]."</td></tr>";
				echo "<tr><th>Employee Name : </th><td>".$row["EmpName"]."</td></tr>";
				echo "<tr><th>Department : </th><td>".$row["Dept"]."</td></tr>";
				echo "<tr><th>Date Of Joining : </th><td>".$row["DateOfJoin"]."</td></tr>";
				echo "<tr><th>Current Time : </th><td><div id = 'clock'></div></td></tr></table></div>";



				echo "<div class='column2'>";
				echo "<table>";
				
				
				while ($cursor = $itr->current()){ 
					echo "<tr><th>Background : </th>";
					echo "<td>";
					if($cursor['bgdetails']!=NULL)
						echo $cursor['bgdetails'];
					echo "</td>";
					echo "<tr><th>Courses taught : </th>";
					echo "<td>";
					if($cursor['ccode']!=NULL){
					$length = count($cursor['ccode']);
					for ($i = 0; $i < $length; $i++) {//echo "<td>";
						echo "(";
						echo $i+1;
						echo ") ";
						echo "<b>";
						print $cursor['ccode'][$i];
						echo "</b>";
						echo " : ";
						echo "<form action = '/' method = 'post'>";
						echo "<button type='submit'  class = 'login-button shadow'   formaction = 'confirmdelcourse.php?index=".$i."'>Remove</button> </form>";
						//print $cursor['cname'][$i];
						//echo " <br> ";
						//echo "</td>";
					}
					
				}
				
					echo "</tr>";

					echo "<tr><th>Publications : </th>";
					echo "<td>";
					if($cursor['pubname']!=NULL){
					
					$length = count($cursor['pubname']);
					for ($i = 0; $i < $length; $i++) {
						echo "(";
						echo $i+1;
						echo ") ";
						echo "<b>";
						print $cursor['pubname'][$i];
						echo "</b>";
						echo "  :";
						echo "<form action = '/' method = 'post'>";
						echo "<button type='submit'  class = 'login-button shadow'   formaction = 'removepub.php?index=".$i."'>Remove</button> </form>";
						//echo "<br>";
						//print $cursor['pubdesc'][$i];
						//echo " <br> ";
					}
					
				}echo "</td>";
					echo "</tr>";
					$itr->next(); // (4)
					}
				
				//echo "<tr><th>User Name : </th><td>".$row["UserName"]."</tr>";
				/*echo "<tr><th>Email ID : </th><td>".$row["EmpEmail"]."</td></tr>";
				echo "<tr><th>Employee Name : </th><td>".$row["EmpName"]."</td></tr>";
				echo "<tr><th>Department : </th><td>".$row["Dept"]."</td></tr>";
				//echo "<tr><th>Earn Leave : </th><td>".$row["EarnLeave"]."</td></tr>";
				//echo "<tr><th> Leaves : </th><td>".$row["SickLeave"]."</td></tr>";
				//echo "<tr><th>Casual Leave : </th><td>".$row["CasualLeave"]."</td></tr>";
				echo "<tr><th>Date Of Joining : </th><td>".$row["DateOfJoin"]."</td></tr>";
				echo "<tr><th>Current Time : </th><td><div id = 'clock'></div></td></tr>*/
				echo "</table></div>";
				
				}
	}



}

/*session_start();
$year = date("Y"); 
if(isset($_SESSION['user']))
	{ 
		
		echo "<div class = 'textview'>";
	   echo "<h1>Leave Management System</h1>";
	   include 'clientnavi.php';
	   include 'connect.php';
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
		$sql2 = "SELECT * FROM emp_leaves WHERE EmpName = '".$empname."'";
		$result2 = $conn->query($sql2);
		$t=time();
		if($result2->num_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				//echo $row2['StartDate'];
				//echo ' ' ;
				if(strtotime($row2['StartDate']) <= time() && $row2['Retro']==NULL && ($row2['Status']=='Requested'||$row2['Status']=='Redirected')){
					$startd=$row2['StartDate'];
					$flag=1;
					break;
				}
				else if(strtotime($row2['StartDate']) <= time()){
					$sql3 = "SELECT * FROM deanemp_leaves WHERE EmpName ='".$empname."'";
					$result3 = $conn->query($sql3);
					while($row3 = $result3->fetch_assoc()){
						if(strtotime($row3['StartDate']) <= time()&& $row3['Retro']==NULL&& ($row3['Status']=='Requested'||$row3['Status']=='Redirected')){
							$flag=2;
							$startd=$row3['StartDate'];
							break;
						}
					}
				}
			}
		}
		$rem='The application was automatically rejected by the system as the application was not approved/rejected by the proposed start date';
	if($flag==1){
		$sql4="UPDATE emp_leaves SET Status = 'Rejected', HOD_Remarks='".$rem."' where StartDate ='".$startd."' and EmpName = '".$empname."'";
		$conn->query($sql4);
	}
	else if($flag==2){
		$sql4="UPDATE deanemp_leaves SET Status = 'Rejected', Dean_Remarks='".$rem."' where StartDate ='".$startd."' and EmpName = '".$empname."'";
		$conn->query($sql4);
	}
	//echo $flag;
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
	}*/
?>

<html>
<head>
<style>
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column1 {
  float: left;
  width: 30%;
  padding-left: 10px;
}
.column2 {
  float: left;
  width: 60%;
  padding-left: 40px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
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
<link rel='stylesheet' type='text/css' href=' style.css'>
<link rel="stylesheet" type="text/css" href="table.css">
