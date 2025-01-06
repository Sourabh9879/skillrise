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
    $query = "DELETE FROM user WHERE user_id = ? AND role = 'mentor'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $mentorId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Mentor deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete mentor. Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['message'] = "Invalid request.";
}

header("Location: viewMentor.php");
exit();
?>