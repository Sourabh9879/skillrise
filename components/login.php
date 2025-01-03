<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login Form</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2>Login</h2>
            </div>
            <div class="card-body">
              <form class="login-form" action="login.php" method="post">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" required />
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </form>
            </div>
            <div class="card-footer text-center">
              <span>Don't have an Account? <a href="signup.php">Register</a></span>
            </div>
          </div>
        </div>
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

<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare statement to fetch user by email
  $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ?");
  if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
  }
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Debugging: Print fetched user data
  // echo '<pre>';
  // print_r($user);
  // echo '</pre>';

  if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['username'] = $user['user_name'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['loggedin'] = true;

    if ($_SESSION['role'] == 'admin') {
      header('Location: ../admin/admdash.php');
    } else if ($_SESSION['role'] == 'mentor') {
      header('Location: ../mentor/menDash.php');
    } else {
      header('Location: ../userDash.php');
    }
    exit();
  } else {
    echo "<script>alert('Invalid email or password');</script>";
  }
  $stmt->close();
}
?>
