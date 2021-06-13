<?php

$host= "localhost";
$dbUsername= "root";
$dbpassword= "";
$dbname= "helping_hand";
	
$connect= new mysqli($host,$dbUsername,$dbpassword,$dbname);	
if($connect->connect_error)
{
	die('Connection Error');
}
else
{		
	$lemail=$_POST['lemail'];
	$lpassword=$_POST['lpassword'];
	
	$sql= "SELECT lemail From login_admin Where lemail='$lemail' AND lpassword='$lpassword'";
		
	$result= $connect->query($sql);	
	if($result-> num_rows> 0)
	{
		while($row=$result->fetch_assoc())
		{
			echo '<script language="javascript">';
			echo 'alert("Welcome to HELPING HAND")';
			echo '</script>';
			include("admin_next.html");
		}
	}
	else
	{
			echo '<script language="javascript">';
			echo 'alert("Signup before login")';
			echo '</script>';
			include("signup.xhtml");
	}
	$connect->close();
}	

?>

