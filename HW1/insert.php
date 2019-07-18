<?php
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$gender = $_POST['gender'];
$occupation = $_POST['occupation'];
$favcolor = $_POST['favcolor'];
$message = $_POST['message'];

if (!empty($name) || !empty($birthday) || !empty($email) || !empty($phone) || !empty($password) || !empty($confirmpassword) || !empty($gender) || !empty($occupation) || !empty($favcolor) || !empty($message))
{
	$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "myregform";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (name, birthday, email, phone, password, confirmpassword, gender, occupation, favcolor, message) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssissssss", $name, $birthday, $email, $phone, $password, $confirmpassword, $gender, $occupation, $favcolor, $message);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>