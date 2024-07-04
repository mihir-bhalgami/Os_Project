<?php
    $input_username = "";
    $input_password = "";

    // Get the username and password from the POST request
    $input_username = $_POST['user'];
    $input_password = $_POST['pass'];

    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Concatenate the IP address with the password
    $password_with_ip = $input_password . $user_ip;

    // Hash the concatenated string
    $input_password = hash("sha256", $password_with_ip);

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "mihir";
    
    // Connect to the database
    $connect = mysqli_connect($servername, $username, $password);
    
    if (!$connect) {
        die("Connection Failed.......\n");
    }

    // Select the database
    $query1 = mysqli_query($connect, "USE users");

    // Get the current number of rows in the table
    $select_query = mysqli_query($connect, "SELECT * FROM logininfo");
    $num = mysqli_num_rows($select_query);
    $num = $num + 1;
    
    // Insert the new user data into the table
    $add_query = "INSERT INTO logininfo (id, username, password) VALUES ('$num', '$input_username', '$input_password')";
    $query = mysqli_query($connect, $add_query);

    // Check if the insertion was successful
    $select_query = mysqli_query($connect, "SELECT * FROM logininfo");
    if (mysqli_num_rows($select_query) == $num) {
        include 'login.html';
        echo "<script> alert('Successfully Registered.'); </script>";
    } else {
        echo "<script> alert('Registration Failed.'); </script>";
    }
?>
