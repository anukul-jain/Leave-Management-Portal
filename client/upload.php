<?php
session_start();
if(isset($_SESSION['user']))
	{	
	$target_dir = "pro-pic/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "JPG") {
		$msg = "Sorry, only JPG files are allowed";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		header('location:home.php?msg='.urlencode($msg));
	// if everything is ok, try to upload file
	} else
		{
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
				{
				$target_location="pro-pic/".basename($_FILES["fileToUpload"]["name"]);
				$ext = pathinfo($target_location, PATHINFO_EXTENSION);
				$new="pro-pic/".$_SESSION['user'].".".$ext;
				rename($target_location,$new);
				header('location:home.php');
				}
			else 
				{
				$msg = "Sorry, there was an error uploading your picture";
				header('location:home.php?msg='.urlencode($msg));
				}
		}
	}
else
	{
		header('location:index.php?err='.urlencode('Please Login First To Access this Page !'));
		exit();
	}
?> 