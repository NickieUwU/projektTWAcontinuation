<?php
    session_start();
    $username = $_GET["username"];
    $PostID = $_GET["Post"];
    require("../DbHandler.php");
    require("../ConnectionChecker.php");
    require("../ValidateUser.php");
    Db::connect("localhost", "sin", "root", "");
    $posts = Db::queryAll("SELECT * FROM posts WHERE Post_ID=?", $PostID);
    foreach($posts as $post)
    {
        $Content = $post["Content"];
        $PosterID = $post["ID"];
    }
    $PosterUsername = Db::querySingle("SELECT Username FROM users WHERE ID=?", $PosterID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sin / Report</title>
    <link rel="shortcut icon" type="x-icon" href="../Logo/Logo.png">
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="Report.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php 
        require("../Nav/Nav.php");
    ?>
</body>
</html>
