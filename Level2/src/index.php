<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>S4rkl3 Blog Lab</title>
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
            font-size: 24px;
            letter-spacing: 1px;
        }

        .container {
            width: 80%;
            margin: 40px auto;
        }

        .post-card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: 0.2s;
        }

        .post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.12);
        }

        .post-card a {
            text-decoration: none;
            color: #2563eb;
            font-size: 20px;
            font-weight: bold;
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

<header>S4rkl3 Blog Lab</header>

<div class="container">
    <?php 
    $result = mysqli_query($conn, "SELECT id, title FROM posts");
    while ($row = mysqli_fetch_assoc($result)){
        echo "<h3><a href='post.php?id=".$row['id']."'>".$row['title']."</a></h3>";
    }
    ?>
</div>

</body>
</html>
