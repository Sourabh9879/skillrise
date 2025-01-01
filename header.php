<?php 
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">SkillRise</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>';
      if (isset($_SESSION['user_id'])) {
        echo '
      <li class="nav-item">
        <a class="nav-link" href="learning.php">My Learning</a>
      </li>';
    } else {
    }
    echo'
  <li class="nav-item">
    <a class="nav-link" href="contact.php">Contact</a>
  </li>';
    echo '
    </ul>
    <div class="ml-auto mr-2 row">'; // Added ml-auto class here
    if (isset($_SESSION['user_id'])) {
        echo '<span class="navbar-text mr-3">Hello, ' . $_SESSION['username'] . '</span>
              <a href="logout.php" class="btn btn-outline-primary">Logout</a>';
    } else {
        echo '<button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
              <button class="btn btn-outline-primary mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>';
    }
    echo '
    </div>
  </div>
</nav>';
?>

<?php
include 'components/loginModal.php';
include 'components/signup.php';
?>