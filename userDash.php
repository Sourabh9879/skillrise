<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillRise</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-3" id="ques">
        <div class="row">
            <?php 
    include 'components/dbconnect.php';

   if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      header("location: ./components/login.php");
      exit();
   }
    
    $sql = "SELECT * FROM `courses`"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $courseId = $row['course_id'];
      $courseImg = $row['course_img'];
      $courseTitle =  $row['course_title'];
      $courseDescription =  $row['course_desc'];
      echo '
      <div class="col-md-4">
      <div class="card my-2" style="width: 18rem;">
      <img src=" ' . $courseImg .  ' "/>
    <div class="card-body">
      <h5 class="card-title"><a href="courselist.php?courseId=' . $courseId . '">' . $courseTitle . '</a></h5>
      <p class="card-text">' . substr($courseDescription, 0,90) . '...</p>
      <a href="courselist.php?courseId=' . $courseId . '" class="btn btn-primary">View</a>
  </div>
</div>
</div> ';
    }
    
    
    ?>

</body>

</html>