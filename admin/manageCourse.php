<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Admin Dashboard</a>
        <ul class="navbar-nav px-3">
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
                            <a class="nav-link active" href="admdash.php">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manageCourse.php">
                                Manage Course
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewMentor.php">
                                View Mentor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewUser.php">
                                View User
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Courses</h1>
                </div>

                <?php 
                include '../components/dbconnect.php';
                
                // Query to fetch courses with mentor names
                $sql = "SELECT course_title, mentor_name FROM courses";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Course Title</th>
                                <th scope="col">Mentor Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                    
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <th scope="row">' . $no++ . '</th>
                            <td>' . $row['course_title'] . '</td>
                            <td>' . $row['mentor_name'] . '</td>
                            <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>';
                    }

                    echo '
                        </tbody>
                    </table>';
                } else {
                    echo '<p>No courses found.</p>';
                }
                ?>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
