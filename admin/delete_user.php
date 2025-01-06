<?php
session_start();
require '../components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../components/login.php");
    exit();
}

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Delete user from user table
    $deleteQuery = "DELETE FROM user WHERE user_id = ? AND role = 'user'";
    $deleteUser = $conn->prepare($deleteQuery);
    $deleteUser->bind_param("i", $userId);
    $deleteUser->execute();

    $deleteUser->close();
    $conn->close();
} else {
   echo '<script>alert("Invalid request")</script>';
}

header("Location: viewUser.php");
exit();
?>