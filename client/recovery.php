<?php
include 'connect.php';
include 'recoverymailer.php';
$key = $_POST['recoverykey'];
echo "<div class = 'textview'>";
echo "<h1>Leave Management System</h1>";
include 'navi.php';
$sql = "SELECT id, UserName, EmpPass, EmpEmail FROM employees";
$result = $conn->query($sql);

if (!filter_var($key, FILTER_VALIDATE_EMAIL)) 
	{
	$err = "Invalid email ID";
	header('location:passrecovery.php?err='.urlencode($err));
	}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if(($row["EmpEmail"] == $key))
			{
			$uname = $row["UserName"];
			$to = $row["EmpEmail"];
			$id = $row["id"];
			}
    }
}
if(isset($uname) && isset($to))
	{$rand = mt_rand();
		$sql2 = "UPDATE employees SET Random='".$rand."' WHERE id=".$id;
		$conn->query($sql2);
	$msg = "Please enter the following key on the key field to reset your password : ".$rand." \n\n\n\n Regards,\n webadmin, Project Management System";
	$status = mailer($to,$msg);
			echo "<table>";
			echo "<form action = 'resetpass.php' method = 'post'>";
			echo "<tr><td> Please Enter the key sent to your mail : </td><td><input type = 'number' min = '0' name = 'key' class = 'textbox'></td></tr>";
			echo "<tr><td><input type = 'submit' class = 'recovery' value = 'Reset Password'></td></tr>";
			echo "</form>";
			echo "</table>";
	}
else{
	header('location:passrecovery.php?err='.urlencode('No Such User Found !'));
	}
echo "</div>";
if(empty($key))
	{
	header('location:passrecovery.php?err='.urlencode('Empty Field !'));
	}
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
