<?php
session_start();
include 'components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ./components/login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die('User ID not set in session.');
}

$courseId = $_GET['courseId'];
$userId = $_SESSION['user_id'];

// Check if the course is already in "My Learning"
$checkSql = "SELECT * FROM `my_learning` WHERE user_id = ? AND course_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ii", $userId, $courseId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$isInMyLearning = $checkResult->num_rows > 0;

// Fetch course details
$sql = "SELECT * FROM `courses` WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $courseId);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

$courseTitle = $course['course_title'];
$courseDescription = $course['course_desc'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?php echo $courseTitle; ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">SkillRise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="userDash.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="learning.php">My Learning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
        <div class="ml-auto mr-2 row">
            <span class="navbar-text mr-3"><?php echo $_SESSION['username']; ?></span>
            <a href="logout.php" class="btn btn-outline-primary">Logout</a>
        </div>
    </div>
</nav>

<div class="container my-3">
    <div class="jumbotron">
        <h1 class="display-4 fw-bold"><?php echo $courseTitle; ?></h1>
        <p class="lead"><?php echo $courseDescription; ?></p>
        <hr class="my-4">
        <?php if ($isInMyLearning): ?>
            <a class="btn btn-danger btn-lg" href="remove_course.php?courseId=<?php echo $courseId; ?>" role="button">Remove from My Learning</a>
        <?php else: ?>
            <a class="btn btn-primary btn-lg" href="add_course.php?courseId=<?php echo $courseId; ?>" role="button">Add to My Learning</a>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
</body>
</html>