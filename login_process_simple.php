<?php
//display all error message - for debugging only
ini_set("display_errors", "1");
ERROR_REPORTING(E_ALL);

//detect if the server supports cryptography using blowfish
CRYPT_BLOWFISH or die('No Blowfish found.');

//connect to database
$link = mysqli_connect('localhost', 'root', 'T!ke36O4GJh8ebW') or die('Not connected : ' . mysql_error());
mysqli_select_db($link, 'itsecurity') or die('Not selected : ' . mysql_error());

if (!isset($_POST['password']) || !isset($_POST['username'])) {
    die('you cannot access this page directly.<br/><a href="login_form.php">back to login page?</a>');
}

//get the password and email from user
$password = mysqli_real_escape_string($link, $_POST['password']);
$username = mysqli_real_escape_string($link, $_POST['username']);

// Now to verify user’s password
$sql = "SELECT password FROM users2 WHERE email='$username'";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);

if (password_verify($password, $row['password'])) {
    echo 'Password verified!';
} else {
    echo 'There was a problem with your user name or password.<br/>';
    echo '<a href="login_form.php">back to login page?</a>';
}
