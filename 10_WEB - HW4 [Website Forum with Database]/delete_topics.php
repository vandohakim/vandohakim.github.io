<?php
// include database connection file
include_once("connect.php");
$con=mysqli_connect("localhost","root","","forum");
// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($con, "DELETE FROM topics WHERE topic_id=$id");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
?>