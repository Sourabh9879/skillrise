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
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <?php
      // Check if the user is logged in and determine their role
      if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
        if ($role === 'user') {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="learning.php">My Learning</a>
          </li>';
        } elseif ($role === 'mentor') {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="mycourses.php">My Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mentor/menDash.php">Dashboard</a>
          </li>';
        } elseif ($role === 'admin') {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="admin/admdash.php">Dashboard</a>
          </li>';
        }
      }
      ?>
      
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    <div class="ml-auto mr-2 row">
      <?php
      // Check if user is logged in
      if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
          if ($_SESSION['role'] == 'admin') {
          }
          echo '<span class="navbar-text mr-3">Hello, ' . $_SESSION['username'] . '</span>
                <a href="logout.php" class="btn btn-outline-primary">Logout</a>';
      } else {
          echo '<button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
                <button class="btn btn-outline-primary mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>';
      }
      ?>
    </div>
  </div>
</nav>

<?php
include 'components/loginModal.php';
include 'components/signup.php';
?>
</body>
</html>
