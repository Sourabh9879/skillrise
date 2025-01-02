<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
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
            <?php 
            include '../components/dbconnect.php';
            
            // count total users
            $sql = "SELECT * FROM `user` WHERE `role` = 'user';";
            $result = $conn->query($sql);
            $user = $result ? $result->num_rows : 0;

            // count total mentors
            $sql = "SELECT * FROM `user` WHERE `role` = 'mentor';";
            $result = $conn->query($sql);
            $mentor = $result ? $result->num_rows : 0;

            // count total courses
            $sql = "SELECT * FROM `courses`;";
            $result = $conn->query($sql);
            $course = $result ? $result->num_rows : 0;
            ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="card-deck mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $user; ?></h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Mentors</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $mentor; ?></h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Courses</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $course; ?></h6>
                        </div>
                    </div>
                </div>
                <div class="chart-container mt-4">
                    <canvas id="myChart" width="600" height="400"></canvas>
                </div>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Users', 'Mentors', 'Courses'],
                            datasets: [{
                                data: [<?php echo $user; ?>, <?php echo $mentor; ?>, <?php echo $course; ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 1,
                                barThickness: 60 
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    
                                }
                            }
                        }
                    });
                </script>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>