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

    // Fetch course title
    $fetchCourse = "SELECT course_title FROM courses WHERE course_id = ?";
    $fetchedCourse = $conn->prepare($fetchCourse);
    $fetchedCourse->bind_param("i", $courseId);
    $fetchedCourse->execute();
    $courseResult = $fetchedCourse->get_result();
    $course = $courseResult->fetch_assoc();
    $courseTitle = $course['course_title'];

    // Add course to my_learning
    $insertQuery = "INSERT INTO my_learning (user_id, course_id, course_title) VALUES (?, ?, ?)";
    $insertQueryResult = $conn->prepare($insertQuery);
    $insertQueryResult->bind_param("iis", $userId, $courseId, $courseTitle);
    $insertQueryResult->execute();

    $insertQueryResult->close();
    $conn->close();
} else {
    echo '<script>alert("Invalid request")</script>';
}

header("Location: learning.php");
exit();
?>