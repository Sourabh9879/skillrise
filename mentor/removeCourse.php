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
    $query = "DELETE FROM courses WHERE course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $courseId);

    if ($stmt->execute()) {
        echo '<script>alert("Delete Successfull.")</script>';
    } else {
         echo '<script>alert("failed to delete course.")</script>';
    }

    $stmt->close();
    $conn->close();
} else {
   echo '<script>alert("invalid request.")</script>';
}

header("Location: mycourse.php");
exit();
?>