<?php
session_start();
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE firstname = '$fname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if password matches First Name
        if ($password === $user['firstname']) {
            $_SESSION['user_name'] = $user['firstname'];
            header("Location: welcome.php"); // Success!
            exit();
        } else {
            // Error: Wrong password
            header("Location: login.php?error=wrongpass");
            exit();
        }
    } else {
        // Error: User not found
        header("Location: login.php?error=notfound");
        exit();
    }
}
?>