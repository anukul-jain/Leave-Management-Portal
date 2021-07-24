<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #FFFAF0;
	font-family: "Segoe UI Light","Segoe WPC","Segoe UI",
              Helvetica, Arial, "Arial Unicode MS", Sans-Serif;
  font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	color: #000000;
  opacity: 0.7;
}

li {
    float: left;
	font-family: "Segoe UI Light","Segoe WPC","Segoe UI",
              Helvetica, Arial, "Arial Unicode MS", Sans-Serif;
  font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
	font-family: "Segoe UI Light","Segoe WPC","Segoe UI",
              Helvetica, Arial, "Arial Unicode MS", Sans-Serif;
  font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	color : #000000;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: #FFEBCD;
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #FFFAF0;
    min-width: 160px;
	font-family: "Segoe UI Light","Segoe WPC","Segoe UI",
              Helvetica, Arial, "Arial Unicode MS", Sans-Serif;
  font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	color: #000000;
}

.dropdown-content a {
    color: #fefefe;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
	font-family: "Segoe UI Light","Segoe WPC","Segoe UI",
              Helvetica, Arial, "Arial Unicode MS", Sans-Serif;
  font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	color: #000000;
}

.dropdown-content a:hover {background-color: #FFEBCD;}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>
<body>

<ul>
  <li><a href="dirmain.php"> Home</a></li>
  <li><a href = "dirview_leaves.php">Accept/Reject Leave</a>
    </li>
  
  <li class="dropdown">
    <a href="#" class="dropbtn">Me</a>
    <div class="dropdown-content">
      <a href="logout.php">Logout</a>
    </div>
  </li>
</ul>
</body>
</html>