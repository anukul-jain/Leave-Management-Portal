<?php
session_start();
include 'connect.php';

$username = $_POST['uname'];
$password = $_POST['pass'];

$sql = "SELECT * FROM admins";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
        if(($username == $row["username"]) && ($password == $row["password"]))
			{
			$_SESSION['adminuser'] = $username;
			$_SESSION['dept'] = $row['Dept'];
			header('location:home.php');
			}
		else
			{
			header('location:index.php?err='.urlencode('Username Or Password Incorrect'));
			}
    }	
?>