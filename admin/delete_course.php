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
        $_SESSION['message'] = "Course deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete course.";
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['message'] = "Invalid request.";
}

header("Location: manageCourse.php");
exit();
?>