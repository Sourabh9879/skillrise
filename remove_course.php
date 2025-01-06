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
    $courseQuery = "SELECT course_title FROM courses WHERE course_id = ?";
    $courseStmt = $conn->prepare($courseQuery);
    $courseStmt->bind_param("i", $courseId);
    $courseStmt->execute();
    $courseResult = $courseStmt->get_result();
    $course = $courseResult->fetch_assoc();
    $courseTitle = $course['course_title'];

    // Remove course from my_learning
    $query = "DELETE FROM my_learning WHERE user_id = ? AND course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $courseId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Course '$courseTitle' removed from your learning list.";
    } else {
        $_SESSION['message'] = "Failed to remove course '$courseTitle'.";
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['message'] = "Invalid request.";
}

header("Location: userDash.php");
exit();
?>