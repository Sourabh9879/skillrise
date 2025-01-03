<div class="container my-3" id="ques">
    <div class="row">
<?php 

include 'components/dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
header("location: ./components/login.php");
exit();
}

$sql = "SELECT * FROM `my_learning` WHERE user_id = $_SESSION[user_id]"; 
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
</div>
</div>

