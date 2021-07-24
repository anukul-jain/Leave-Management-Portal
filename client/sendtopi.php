<html>
<head>
<title>::Leave Request Confirmation::</title>
<?php
session_start();
include 'connect.php';
include 'clientnavi.php';

$user = $_SESSION['user'];
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
echo "<div class = 'textview'>";
echo "<center>";
if(isset($user))
	{
		$flag=0;
	$type = $_POST['Manpower_Type'];
	$month=$_POST['No_of_months'];
	//echo $type;
	$id =$_GET['id'];
	$empid =$_GET['empid'];
	$sql3="SELECT * from projects where id='".$id."'";
	$result3 = $conn->query($sql3);
	$row3=$result3->fetch_assoc();
	if($type=='01'){
		if(40000*$month>$row3['Totalbudgetleft'])
			$flag=1;
	}
	else{
		if(31000*$month>$row3['Totalbudgetleft'])
			$flag=1;
	}
	if($flag==0){
		echo 'Request Sent';
		$sql2 = "UPDATE projects SET STATUS='Requested',type = '".$type."', months='".$month."' where id='".$id."'";
		$conn->query($sql2);
	}
	else{
		
	header('location:my_projects.php?err='.urlencode("Insufficient Budget left !"));
	//echo "<h1 color='red'>Insufficient Budget left !</h1>";
	}
	}
	else
	{
	header('location:index.php?err='.urlencode('Please Login first to access this page'));
	}
echo "</center>";
echo "</div>";
$conn->close();
function createPDF($pdf_content, $filename){
	
	$path='leaves/';
	$dompdf=new DOMPDF();
	$dompdf->load_html($pdf_content);
	$dompdf->render();
	$output = $dompdf->output();
	file_put_contents($path.$filename, $output);
	return $filename;		
	}
?>

<script type="text/javascript">
        function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
    </script>
</head>
</html>