<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>S4rkl3 Blog Lab - Post</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
        }

        header {
            background: #111827;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
        }

        .container {
            width: 70%;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
        }

        .back {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #2563eb;
            font-size: 14px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header> Blog Post</header>

<div class="container">
<a class="back" href="index.php">⬅ Back to posts</a>
    <?php
      ini_set('display_errors', 0);
      error_reporting(0);
      mysqli_report(MYSQLI_REPORT_OFF);

   if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "SELECT title, content FROM posts WHERE id='$id'";
      mysqli_query($conn,$query);
      if(ctype_digit($id)){
        $safe_id = intval($id);
        $safe_query = "SELECT title, content FROM posts WHERE id=$safe_id";
        $result = mysqli_query($conn,$safe_query);

        if($result && mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            echo"<h2>".$row['title']."</h2>";
            echo"<p>".$row['content']."</p>";
        } else {
            echo"<h2>Post not found</h2>";
        }
      } else {
        echo"<h2>Post not found</h2>";
      }
}
    ?>
</div>

<footer>© 2026 S4rkl3 Blog Lab. All rights reserved.</footer>

</body>
</html>