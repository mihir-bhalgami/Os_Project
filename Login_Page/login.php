<?php

$access = false;
$input_username = "";
$input_password = "";

$input_username = $_POST['user'];
$input_password = $_POST['pass'];

// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Concatenate the IP address with the password and hash the result
$hashed_password_with_ip = hash("sha256", $input_password . $user_ip);

$servername = "localhost";
$username = "root";
$password = "mihir";

$connect = mysqli_connect($servername, $username, $password);

if (!$connect) {
    die("Connection Failed.......\n");
}

// Select the database
$query1 = mysqli_query($connect, "USE users");

// Query the logininfo table
$query = mysqli_query($connect, "SELECT * FROM logininfo");

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        // Check if the username and hashed password match
        if (($row["username"] == $input_username) && ($row["password"] == $hashed_password_with_ip)) {
            $access = true;
            include '../Index/index.html';
            break; // Stop checking once a match is found
        }
    }

    if ($access) {
        echo "\nAccess Granted";
    } else {
        echo "\nAccess Denied";
    }
} else {
    echo "\nNo users found in the database.";
}

?>
