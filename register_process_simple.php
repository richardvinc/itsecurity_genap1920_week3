<?php

//display all error message - for debugging only
ini_set("display_errors", "1");
ERROR_REPORTING(E_ALL);

//detect if the server supports cryptography using blowfish
CRYPT_BLOWFISH or die('No Blowfish found.');

//connect to database
$link = mysqli_connect('localhost', 'root', 'T!ke36O4GJh8ebW') or die('Not connected : ' . mysql_error());
mysqli_select_db($link, 'itsecurity') or die('Not selected : ' . mysql_error());

//get the password and email from user
$password = mysqli_real_escape_string($link, $_POST['password']);
$username = mysqli_real_escape_string($link, $_POST['username']);


$options = ['cost' => 12];
$hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

// generate current date for database input
$mysql_date = date('Y-m-d');
//form query to inserting data
$sql = "INSERT INTO users2 (reg_date, email, password) VALUES ('$mysql_date', '$username', '$hashed_password')";
//if query error, then end all operation
mysqli_query($link, $sql) or die(mysqli_error($link));

echo 'registration successful.<br/><a href="login_form.php">go to login page</a>';
