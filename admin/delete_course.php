<?php
session_start();
require '../components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../components/login.php");
    exit();
}

if (isset($_GET['courseId'])) {
    $courseId = $_GET['courseId'];

    // Delete course from courses table
    $deleteQuery = "DELETE FROM courses WHERE course_id = ?";
    $deleteCourse = $conn->prepare($deleteQuery);
    $deleteCourse->bind_param("i", $courseId);
    $deleteCourse->execute();

    $deleteCourse->close();
    $conn->close();
} else {
   echo '<script>alert("invalid request")</script>';
}

header("Location: manageCourse.php");
exit();
?>