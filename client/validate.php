<?php
session_start();
include 'connect.php';
require 'update_leaves.php';
$username = $_POST['uname'];
$password = $_POST['pass'];
$sql2 = "SELECT * FROM hods";
$result2 = $conn->query($sql2);
$sql3 = "SELECT * FROM dean";
$result3 = $conn->query($sql3);
$sql4 = "SELECT * FROM director";
$result4 = $conn->query($sql4);
$check=false;

while($row = $result4->fetch_assoc())
	{
		if(($username == $row["username"]) && ($password == $row["password"])){
			$check=true;
			$_SESSION["user"] = $username;
			$_SESSION['dept'] = $row['Dept'];
			$status = update_leaves($username,$dept);
			if($status  === true){
				header('location:dirmain.php?msg='.urlencode('Your Leaves Were Updated Successfully !'));
					exit();
			}
			else
				header('location:dirmain.php');
		}
	
	}
if($check==false){
	while($row = $result3->fetch_assoc())
	{
		if(($username == $row["username"]) && ($password == $row["password"])){
			$check=true;
			$_SESSION["user"] = $username;
			$_SESSION['dept'] = $row['prevDept'];
			$status = update_leaves($username,$dept);
			if($status  === true){
				header('location:deanmain.php?msg='.urlencode('Your Leaves Were Updated Successfully !'));
					exit();
			}
			else
				header('location:deanmain.php');
		}
	
	}
}
if($check==false){
	while($row = $result2->fetch_assoc()) {
		if(($username == $row["username"]) && ($password == $row["password"]))
			{
				$check=true;
				$_SESSION["user"] = $username;
				$_SESSION['dept'] = $row['Dept'];
				$status = update_leaves($username,$dept);
				if($status  === true)
				{
					header('location:hodmain.php?msg='.urlencode('Your Leaves Were Updated Successfully !'));
					exit();
				}
				else
					header('location:hodmain.php');
			}
		}
	}
if($check==false){
	$sql = "SELECT * FROM employees";
	$result = $conn->query($sql);
	if($check==false){
				while($row = $result->fetch_assoc()) {
        			if(($username == $row["UserName"]) && ($password == $row["EmpPass"]))
					{
						$_SESSION["user"] = $username;
						$_SESSION['dept'] = $row['Dept'];
						$status = update_leaves($username,$dept);
						if($status  === true)
						{
							header('location:home.php?msg='.urlencode('Your Leaves Were Updated Successfully !'));
							exit();
						}
						else
							header('location:home.php');
					}
					else
					{
						header('location:index.php?err='.urlencode('Username Or Password Incorrect'));
					}
    			}
			}
			
	}
?>