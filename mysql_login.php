<?php

$db_host = "localhost" ;
$db_username = "root";
$db_pass = "";
$db_name = "user_info";

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_pass, $db_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$email = $_POST['username'];

$password = $_POST['password'];

$sql = "SELECT firstname, lastname, email, gender FROM registration_db WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		session_start();
		$_SESSION['fname'] = $row['firstname'];
		$_SESSION['lname'] = $row['lastname'];
		$_SESSION['username'] = $row['email'];
		$_SESSION['gender'] = $row['gender'];
        include 'profilePage.php';
    }
} 
else {
    include 'loginformforwrongcredential.html';
}

mysqli_close($conn);
?> 