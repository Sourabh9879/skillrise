<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registration Form</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2>Register</h2>
            </div>
            <div class="card-body">
              <form class="registration-form" action="signup.php" method="post">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                </div>
                <div class="form-group">
                  <label for="role">Register as</label>
                  <select class="form-control" id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="mentor">Mentor</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </form>
            </div>
            <div class="card-footer text-center">
              <span>Already have an Account? <a href="login.php">Login</a></span>
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
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  $selectQuery = $conn->prepare("SELECT user_email FROM user WHERE user_email = ?");
  $selectQuery->bind_param("s", $email);
  $selectQuery->execute();
  $selectQuery->store_result();

  if ($selectQuery->num_rows > 0) {
    echo "<script>alert('Email already exists');</script>";
  } else {
  // Hash the password before storing it
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement
  $InsertQuery = $conn->prepare("INSERT INTO user (user_name, user_email, password, role) VALUES (?, ?, ?, ?)");
  $InsertQuery->bind_param("ssss", $username, $email, $hashed_password, $role);

  if ($InsertQuery->execute()) {
    echo "<script>alert('Registration successful');</script>";
    header('Location: login.php');
  } else {
    echo "<script>alert('Registration failed');</script>";
  }
}
  $selectQuery->close();
}
?>
