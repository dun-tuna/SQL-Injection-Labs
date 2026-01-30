<?php
include('db.php');

// Disable error display
ini_set('display_errors', 0);
error_reporting(0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$post = null;
$error = false;
$not_found = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "SELECT 1 FROM posts WHERE id='$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            preg_match('/^\d+/', $id, $matches);
            if ($matches) {
                $numeric_id = intval($matches[0]);
                $safe_query = "SELECT title, content FROM posts WHERE id=$numeric_id LIMIT 1";
                $safe_result = mysqli_query($conn, $safe_query);
                
                if ($safe_result && mysqli_num_rows($safe_result) > 0) {
                    $post = mysqli_fetch_assoc($safe_result);
                } else {
                    $not_found = true;
                }
            } else {
                $not_found = true;
            }
        } else {
            $not_found = true;
        }

    } catch (mysqli_sql_exception $e) {
        $error = true; 
    }
}


if ($error) {
    http_response_code(500);
} else {
    http_response_code(200);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>S4rkl3 Blog Lab - Post</title>
    <style>
        body { margin: 0; font-family: Arial; background: #f4f6f9; }
        header { background: #111827; color: white; padding: 20px; text-align: center; font-size: 22px; }
        .container { width: 70%; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        .back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #2563eb; font-size: 14px; }
        footer { text-align: center; padding: 20px; color: #777; margin-top: 40px; }
    </style>
</head>
<body>
<header>Blog Post</header>
<div class="container">
<a class="back" href="index.php">⬅ Back to posts</a>

<?php
if ($error) {
    echo "<h1>Something went wrong.</h1>";
} elseif ($not_found) {
    echo "<p>Post not found.</p>";
} elseif ($post) {
    echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
    echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
} else {
    echo "<p>No post ID specified.</p>";
}
?>
</div>
<footer>© 2026 S4rkl3 Blog Lab. All rights reserved.</footer>
</body>
</html>