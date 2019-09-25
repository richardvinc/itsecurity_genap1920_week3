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

// $password = "hello";
//This string tells crypt to use blowfish for 5 rounds (2^5 iterations).
$Blowfish_Pre = '$2y$05$';
$Blowfish_End = '$';

// PHP code you need to register a user
// Blowfish accepts these characters for salts.
$Allowed_Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
$Chars_Len = 63;
$Salt_Length = 21; // 18 would be secure as well.

//generate salt
$salt = "";
for ($i = 0; $i < $Salt_Length; $i++) {
    $salt .= $Allowed_Chars[mt_rand(0, $Chars_Len)];
}
//prepend and postpend the salt so it suits blowfish requirement
$bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
//actually hash the password and the salt
$hashed_password = crypt($password, $bcrypt_salt);

echo "blowfish pre: " . $Blowfish_Pre;
echo "<br/>";
echo "salt: " . $salt;
echo "<br/>";
echo "blowfist end: " . $Blowfish_End;
echo "<br/>";
echo "Bycrypt salt: " . $bcrypt_salt;
echo "<br/>";
echo "hashed password: " . $hashed_password;

// generate current date for database input
$mysql_date = date('Y-m-d');
//form query to inserting data
$sql = "INSERT INTO users (reg_date, email, salt, password) VALUES ('$mysql_date', '$username', '$salt', '$hashed_password')";
//if query error, then end all operation
mysqli_query($link, $sql) or die(mysqli_error($link));

echo 'registration successful.<br/><a href="login_form.php">go to login page</a>';
