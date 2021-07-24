<?php
include 'connect.php';
$key = trim($_POST['key']);
$newpass = trim($_POST['newpass']);
$key = strip_tags($key);
$newpass = strip_tags($newpass);
if(strip_tags(trim($_POST['cnfnewpass'])) === $newpass)
{
	$sql = "SELECT id,UserName,Random FROM employees";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row["Random"] == $key)
				{
				$uname = $row["UserName"];
				$id = $row["id"];
				$newpw = hash_hmac('sha512', 'salt'.$newpass, md5($uname));
				$sql2 = "UPDATE employees SET EmpPass='".$newpw."' WHERE id=".$id;

				if ($conn->query($sql2) === TRUE)
					{
					$sql3 = "UPDATE employees SET Random='' WHERE id=".$id;
					if($conn->query($sql3) === TRUE)
						{
							header('location:index.php?err='.urlencode('Password Changed Succesfully ! '));
						}
					}
				else
					{
					echo "Password change error ! ";
					}
				}
			else
			{
			echo "You are at the wrong place ! <a href = '../index.php'>Go Home</a>";
			}
		}
	}
	else
		{
		echo "You are at the wrong place ! <a href = '../index.php'>Go Home</a>";
		}
$conn->close();
}
else
	{
	header('location:resetpass.php?err='.urlencode('Passwords do not match !'));
	}
?>