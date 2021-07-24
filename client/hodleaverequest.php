<?php
echo "<link rel = 'stylesheet' href= 'style.css'>";
echo "<link rel = 'stylesheet' href= 'table.css'>";
echo "<center>";
echo "<div class = 'textview'>";
include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'hodnavi.php';
session_start();

if(isset($_SESSION['user']))
	{$flag=0;
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM employees WHERE UserName = '".$user."'";
	$result = $conn->query($sql);
	$row5=$result->fetch_assoc();
	$empname=$row5['EmpName'];
	$sql2 = "SELECT * FROM dirview_leaves WHERE EmpName = '".$empname."'";
	$result2 = $conn->query($sql2);
	if($result2->num_rows > 0){
		while($row2 = $result2->fetch_assoc()){
			if($row2['Status']=='Requested'||$row2['Status']=='Redirected'){
				$flag=1;
				break;
			}
		}
	}
	if($flag==1){
		header('location:hodrequest_leave.php?err='.urlencode(" You can launch only one leave application at a time !"));
	}
	$sql = "SELECT * FROM employees WHERE UserName = '".$user."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			echo "<body>";
			echo "<h2>Request For A Leave for : ".$_POST['type']."</h2>";
			echo "<form action = 'hodrequest_confirm.php' method = 'post'>";
			echo "<table>";
			echo "<input type = 'hidden' name = 'empname' value = '".$row["EmpName"]."'>";
			echo "<input type = 'hidden' name = 'designation' value = '".$row["Designation"]."'>";
			echo "<input type = 'hidden' name = 'dept' value = '".$row["Dept"]."'>";
			echo "<input type = 'hidden' name = 'emptype' value = '".$row["EmpType"]."'>";
			echo "<input type = 'hidden' name = 'empfee' value = '".$row["EmpFee"]."'>";
			
			echo "<tr><th> * Starting Date : </th>
					<td>
					<select name = 'leavedate' class = 'textbox shadow selected' style='width:50px;'>
						<option value = '01'>1</option>
						<option value = '02'>2</option>
						<option value = '03'>3</option>
						<option value = '04'>4</option>
						<option value = '05'>5</option>
						<option value = '06'>6</option>
						<option value = '07'>7</option>
						<option value = '08'>8</option>
						<option value = '09'>9</option>
						<option value = '10'>10</option>
						<option value = '11'>11</option>
						<option value = '12'>12</option>
						<option value = '13'>13</option>
						<option value = '14'>14</option>
						<option value = '15'>15</option>
						<option value = '16'>16</option>
						<option value = '17'>17</option>
						<option value = '18'>18</option>
						<option value = '19'>19</option>
						<option value = '20'>20</option>
						<option value = '21'>21</option>
						<option value = '22'>22</option>
						<option value = '23'>23</option>
						<option value = '24'>24</option>
						<option value = '25'>25</option>
						<option value = '26'>26</option>
						<option value = '27'>27</option>
						<option value = '28'>28</option>
						<option value = '29'>29</option>
						<option value = '30'>30</option>
						<option value = '31'>31</option>
					</select>
					<select name = 'leavemonth' class = 'textbox shadow selected'>
						<option value = '01'>1</option>
						<option value = '02'>2</option>
						<option value = '03'>3</option>
						<option value = '04'>4</option>
						<option value = '05'>5</option>
						<option value = '06'>6</option>
						<option value = '07'>7</option>
						<option value = '08'>8</option>
						<option value = '09'>9</option>
						<option value = '10'>10</option>
						<option value = '11'>11</option>
						<option value = '12'>12</option>
					</select>
					<select name = 'leaveyear' class = 'textbox shadow selected'>
						<option value = '".date("Y")."'>".date("Y")."</option>
					</select>
					</td>
					</tr>";
			echo "<input type = 'hidden' name = 'leavetype' value = '".$_POST['type']."'>";
			echo "<tr><th> * No Of Leave Days : </th><td><input type = 'number' min = '1' name = 'leavedays' class = 'textbox shadow selected' step = '1'></td></tr>";
			echo "<tr><th> * Resaon For Leave : </th><td><input type = 'text' name = 'leavereason' class = 'textbox shadow selected'></td></tr>";
			/*
			echo "<table>
					<tr>
					<th>Date </th>
					<th>Time</th>		
					<th>Semester</th>
					<th>Division/Batch</th>
					<th>Room No.</th>
					<th>Subject</th>
					<th>Staff  Member Who Will Engage Class</th>
					</tr>
					<tr>
					<td><input type = 'text' name = 'value1' class = 'textbox shadow selected' style='width:90px;'></td>
					<td><input type='text' name = 'value2' class = 'textbox shadow selected' style='width:100px;'></td>		
					<td><input type='number' min = '1' max = '8' step = '1' name = 'value3' class = 'textbox shadow selected' style='width:40px;'></td>
					<td><input type='text' name = 'value4' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value5' class = 'textbox shadow selected' style='width:100px;'></td>
					<td><input type='text' name = 'value6' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value7' class = 'textbox shadow selected' style='width:50px;'></td>
					</tr>
					<tr>
					<td><input type = 'text' name = 'value8' class = 'textbox shadow selected' style='width:90px;'></td>
					<td><input type='text' name = 'value9' class = 'textbox shadow selected' style='width:100px;'></td>		
					<td><input type='number' min = '1' max = '8' step = '1' name = 'value10' class = 'textbox shadow selected' style='width:40px;'></td>
					<td><input type='text' name = 'value11' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value12' class = 'textbox shadow selected' style='width:100px;'></td>
					<td><input type='text' name = 'value13' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value14' class = 'textbox shadow selected' style='width:50px;'></td>
					</tr>
					<tr>
					<td><input type = 'text' name = 'value15' class = 'textbox shadow selected' style='width:90px;'></td>
					<td><input type='text' name = 'value16' class = 'textbox shadow selected' style='width:100px;'></td>		
					<td><input type='number' min = '1' max = '8' step = '1' name = 'value17' class = 'textbox shadow selected' style='width:40px;'></td>
					<td><input type='text' name = 'value18' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value19' class = 'textbox shadow selected' style='width:100px;'></td>
					<td><input type='text' name = 'value20' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value21' class = 'textbox shadow selected' style='width:50px;'></td>
					</tr>
					</font>
					</table>";*/
			echo "<br/><tr><td><input type = 'submit' value = 'Request a Leave' class = 'login-button shadow'></td></tr>";
			echo "</form>";
			echo "</div>";
			echo "</center>";
			echo "</body>";
			}
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Site !'));
	}
?>
<title>::Leave Management::</title>
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