<html>
<head>
<title>Password Reset</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class = 'textview'>
<?php
include 'connect.php';
$key = trim($_POST['key']);
$key = strip_tags($key);
$sql = "SELECT Random FROM employees";
$result = $conn->query($sql);
echo "<center>";
echo "<table>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row["Random"] == $key)
			{
			echo "<form action = 'reset.php' method = 'post'>";
			echo "<input type = 'hidden' name = 'key' value = '".$key."'><br/>";
			echo "<tr><td>New Password :</td><td><input type = 'password' name = 'newpass' class = 'textbox'></td></tr>";
			echo "<tr><td>Confirm New Password :</td><td><input type = 'password' name = 'cnfnewpass' class = 'textbox'></td></tr>";
			echo "<tr><td><input type = 'submit' value = 'Reset' class = 'recovery'></td></tr>";
			echo "</form>";
			}
    }
}
else
	{
	echo "You are at the wrong place ! <a href = '../index.php'>Go Home</a>";
	}
echo "</table>";
echo "</center>";
?>
</div>
</body>
</html>