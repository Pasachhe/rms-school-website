

<?php
session_start();

if(!$_SESSION['name'])
{
	header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title> Rambhakta Memorial School </title>
	<meta charset="utf-8" />
	<link rel="stylesheet"  href="style.css" type="text/css"/> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>	
	<body background="backgroung.jpg">
	
		<div id="container">
		<div id="header">
		<img src="logoe.jpg" height="75" width="100%" alt="RMS_logo" align="center">
		</div> 
	
				<div id="navigation">
				
			<div id='cssmenu'>
<ul>
	<li><a href="index.php"><span>Home</span></a></li>
	<li><a href="Admission.php"><span>Admission</span></a>
   <li><a href="teacher.php"><span>Teachers</span></a></li>
   
   <li class='last'><a href="Token.php"><span>Tokens</span></a></li>
   
      <li class='active has-sub'><a href="admin.php"><span>MANAGE</span></a>
      <ul>
			 <li class='has-sub'><a href="admin.php"><span>Tokens</span></a></li>
         <li class='has-sub'><a href="teach_ac.php"><span>Teacher A/C</span></a></li>
         <li class='has-sub'><a href="stud_ac.php"><span>Student A/C</span></a></li>
		  <li class='has-sub'><a href="stud_ac.php"><span>Admin A/C</span></a></li>
      </ul>
   </li>
	<li class='last'><a href="logout.php"><span>LOG OUT</span></a></li>
</ul>
   

</ul>
</div>

	
<td width="1000">
		<table>
			<tr>
				
				<td width="150">
					<div class="left_bar">

					</div>
				</td>
				
				<td width="900">
					<div class="mid">
					<h1>Student Tokens</h1>
						<p>

<strong>

  <span style="font-weight: bold;">
<font color="#535B68" align='rightside'><?php echo $_SESSION['name']; ?></font>
		<a href='logout.php'><input type="button" value="logout"/></a></font></font>

    </span>

</strong>




<?php
$con = mysql_connect("localhost","root","");
if(!$con){
die("Can not connect:" . mysql_error());
}

mysql_select_db("pasachhe",$con); // selects the database named pasachhe and relates all the connections afterwards...............

// for add update and delete queries

if(isset($_POST['update'])){
$UpdateQuery ="UPDATE lectures Set Topic='$_POST[topic]', Name='$_POST[name]',Token='$_POST[token]' WHERE Topic='$_POST[hidden]'";
mysql_query($UpdateQuery,$con);
};

if(isset($_POST['delete'])){
$DeleteQuery="DELETE FROM lectures WHERE Topic='$_POST[hidden]'";
mysql_query($DeleteQuery,$con);
};

if(isset($_POST['add'])){
$AddQuery="INSERT INTO lectures (Topic, Name, Token) VALUES ('$_POST[utopic]','$_POST[uname]','$_POST[utoken]')";
mysql_query($AddQuery,$con);
};

//end query connection



$sql ="SELECT * FROM lectures";    // lectures ia the table inside the database named pasachhe...._where students token records are kept_
$myData = mysql_query($sql,$con);
echo"<table border=1>
<tr>
<th>Topic</th>
<th>Name</th>
<th>Token</th>
</tr>";
while($record = mysql_fetch_array($myData)){
echo "<form action=admin.php method=post>";
echo"<tr>";
echo"<td>" . "<input type = text name=topic value=" . $record['Topic'] . " </td>";
echo"<td>" . "<input type = text name=name value=" . $record['Name'] . " </td>";
echo"<td>" . "<input type = text name=token value=" . $record['Token'] . " </td>";
echo"<td>" . "<input type = hidden name=hidden value=" . $record['Topic'] . " </td>";
echo"<td>" . "<input type = submit name=update value=update" . " </td>";
echo"<td>" . "<input type = submit name=delete value=delete" . " </td>";
echo"</tr>";
echo"</form>";
}
echo "<form action=admin.php method=post>";
echo "<tr>";
// utopic uname utoken are the variables taken 
echo "<td><input type=text name=utopic></td>";
echo "<td><input type=text name=uname></td>";
echo "<td><input type=text name=utoken></td>";
echo "<td>" . "<input type = submit name=add value=add " . "</td>";
echo"</tr>";
echo "</form>";
echo "</table>";
mysql_close($con);

?>



	
</p>
					</div>
				</td>
		
				
			</tr>
		</table>
	
		
	<div id="main-footer">
		<p>Copyright &copy 2014. Powered by: Mythcrews Studios Pvt. Ltd </p>
	</div>	
	
	</div>
	
	</body>
	
	
		
	</head>
</html>