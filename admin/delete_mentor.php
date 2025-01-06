<?php
session_start();
require '../components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../components/login.php");
    exit();
}

if (isset($_GET['mentorId'])) {
    $mentorId = $_GET['mentorId'];

    // Delete mentor from user table
    $deleteQuery = "DELETE FROM user WHERE user_id = ? AND role = 'mentor'";
    $deleteMentor = $conn->prepare($deleteQuery);
    $deleteMentor->bind_param("i", $mentorId);
    $deleteMentor->execute();

    $deleteMentor->close();
    $conn->close();
} else {
    echo '<script>alert("Invalid request")</script>';
}

header("Location: viewMentor.php");
exit();
?>