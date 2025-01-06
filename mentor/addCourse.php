<?php
session_start();
include '../components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../components/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseTitle = $_POST['courseTitle'];
    $courseImg = $_POST['courseImg'];
    $courseDescription = $_POST['courseDescription'];
    $mentorId = $_SESSION['user_id']; 
    $mentorName = $_SESSION['username'];

    $sql = "INSERT INTO courses (course_img, course_title, course_desc, mentor_id, mentor_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $courseImg, $courseTitle, $courseDescription, $mentorId, $mentorName);

    if ($stmt->execute()) {
       echo '<script>alert("Course added successfully")</script>';
    } else {
       echo '<script>alert("Failed to add course")</script>';
    }

    $stmt->close();
    $conn->close();
    header("Location: addCourse.php");
    exit();
}

$mentorName = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Dashboard</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        font-size: .875rem;
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
    }

    .sidebar-sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .nav-link.active {
        color: #007bff;
    }

    .nav-link:hover {
        color: #0056b3;
    }

    .main-content {
        margin-left: 220px;
        padding: 20px;
    }

    .chart-container {
        width: 600px;
        height: 400px;
        margin: auto;
    }
    .navbar-nav{
        flex-direction: row;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Mentor Dashboard</a>
        <ul class="navbar-nav px-3 ml-auto">
            <li class="nav-item text-nowrap">
                <span class="navbar-text mr-3"><?php echo $mentorName; ?></span>
            </li>
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="menDash.php">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="mycourses.php">
                                My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addCourse.php">
                                Add Course
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userEnrolled.php">
                                Users Enrolled
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Add a Course</h1>
                </div>

                <form action="addCourse.php" method="POST">
                    <div class="form-group">
                        <label for="courseImage">Course Image</label>
                        <input type="text" class="form-control" id="courseImg" name="courseImg" required>
                    </div>
                    <div class="form-group">
                        <label for="courseTitle">Course Title</label>
                        <input type="text" class="form-control" id="courseTitle" name="courseTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="courseDescription">Course Description</label>
                        <textarea class="form-control" id="courseDescription" name="courseDescription" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
                
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>