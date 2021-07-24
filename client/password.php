<link rel = "stylesheet" type = "text/css" href = "style.css">
<?php
session_start();
include 'clientnavi.php';
include 'connect.php';
if(isset($_SESSION['user']))
{
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	$cnfnewpass = $_POST['cnfnewpass'];
	$uname = $_SESSION['user'];
	if($newpass == $cnfnewpass)
		{
		$sql = "SELECT id,UserName,EmpPass FROM employees";
		if((strlen($newpass) >=10))
			{	
				if($newpass != $_SESSION['user'])
				{
					$oldpass = hash_hmac('sha512', 'salt'.$oldpass, md5($uname));
					$result = $conn->query($sql);
					if($result->num_rows > 0)
						{
						while($row = $result->fetch_assoc())
							{
							if($uname == $row["UserName"])
								{
								$id = $row['id'];
								if($oldpass == $row["EmpPass"])
									{
									$newpass = hash_hmac('sha512', 'salt'.$newpass, md5($uname));
									$sql2 = "UPDATE employees SET EmpPass='".$newpass."' WHERE id=".$id;
									if($conn->query($sql2) === TRUE)
										{
										header("location:home.php?msg=".urlencode('Password Succesfully Changed !'));
										}
									}
								else
									{
									header("location:changepass.php?err=".urlencode('Incorrect Old Password !'));
									}
								}
							}
						}
				}
				else
					{
						header('location:changepass.php?err='.urlencode('New Password cannot be same as username !'));
					}
			}
			else
				{
					header('location:changepass.php?err='.urlencode('New Password must be atleast 10 characters long !'));
				}
		}
	else
		{
		header("location:changepass.php?err=".urlencode('New Passwords Do Not Match !'));
		}
}
else
	{
		header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
	}
?>