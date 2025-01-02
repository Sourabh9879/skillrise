<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SkillRise</title>
</head>
<body>
    <?php include 'header.php'
    ?>
        
<!-- category container -->
<div class="container my-3" id="ques">
        <div class="row">
            <?php 
    
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
            <!-- using loop to iterate over categories -->

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