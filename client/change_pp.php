<?php
session_start();
if(isset($_SESSION['user']))
	{
?>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
	}
else
	{
		header("location:index.php?err=".urlencode('Please Login First To Access This Page !'));
	}
?>