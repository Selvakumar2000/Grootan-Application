<?php
$yourname=$_POST['yourname'];
$email=$_POST['email'];
$lemail=$_POST['email'];
$mailid=$_POST['email'];
$phone=$_POST['mnumber'];
$tfrom=$_POST['b_ad_from'];
$tto=$_POST['b_ad_to'];

$streetno=$_POST['streetnumber'];
$city=$_POST['city'];
$state=$_POST['state'];
$pincode=$_POST['pincode'];
$gender=$_POST['msex'];
$password=$_POST['password'];
$lpassword=$_POST['password'];
$conpassword=$_POST['conformpassword'];
$feedback="NIL";
if(!empty($yourname) || !empty($email)|| !empty($phone)|| !empty($tfrom)|| !empty($tto) || !empty($streetno) || !empty($city) || !empty($state) || !empty($pincode) || !empty($gender)|| !empty($password) || !empty($conpassword)){
	$host = "localhost";
	$dbUsername = "root";
	$dbpassword = "";
	$dbname="helping_hand";
	
	$conn = new mysqli($host,$dbUsername,$dbpassword,$dbname);
	
	if(mysqli_connect_error()){
		die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}else{
		$SELECT = "SELECT email From signup_admin Where email = ? Limit 1";
		$INSERT = "INSERT Into signup_admin  (yourname,email,phone,tfrom,tto,streetno,city,state,pincode,gender,password,conpassword) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		
		$INSERTL = "INSERT Into login_admin (lemail, lpassword) values (?,?)";
		$INSERTF = "INSERT Into feedbackform (mailid, feedback) values (?,?)"; 
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum==0){
			$stmt->close();
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("ssissississs",$yourname,$email,$phone,$tfrom,$tto,$streetno,$city,$state,$pincode,$gender,$password,$conpassword);
			$stmt->execute();
			$stmt->close();
			$stmt = $conn->prepare($INSERTL);
			$stmt->bind_param("ss",$lemail,$lpassword);
			$stmt->execute();

			$stmt->close();
			$stmt = $conn->prepare($INSERTF);
			$stmt->bind_param("ss",$mailid,$feedback);
			$stmt->execute();

			echo '<script language="javascript">';
			echo 'alert("new account created successfully")';
			echo '</script>';
			include("admin.html");
			}
			else{
			echo '<script language="javascript">';
			echo 'alert("someone already registered using this email")';
			echo '</script>';
			include("signup.xhtml");
			}
			$stmt->close();
			$conn->close();
		}
}
else{
//alert("all fields required");
die();
}

?>

