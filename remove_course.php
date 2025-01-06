<?php
session_start();
require 'components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ./components/login.php");
    exit();
}

if (isset($_GET['courseId']) && isset($_SESSION['user_id'])) {
    $courseId = $_GET['courseId'];
    $userId = $_SESSION['user_id'];

    $query = "DELETE FROM my_learning WHERE user_id = ? AND course_id = ?";
    $deleteQuery = $conn->prepare($query);
    $deleteQuery->bind_param("ii", $userId, $courseId);
    $deleteQuery->execute();

    $deleteQuery->close();
    $conn->close();
} else {
   echo '<script>alert("Invalid request")</script>';
}

header("Location: userDash.php");
exit();
?>