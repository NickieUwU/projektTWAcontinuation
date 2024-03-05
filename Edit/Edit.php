<?php
    session_start();
    require("../DbHandler.php");
    Db::connect("localhost", "sin", "root", "");
    require("../ConnectionChecker.php");

    $posts = Db::queryAll("SELECT * FROM posts WHERE Post_ID=?", $_GET["post"]);
    foreach($posts as $post)
    {
        $Post_ID = $post["Post_ID"];
        $ID = $post["ID"];
        $Content = $post["Content"];
        $Creation = $post["PostCreation"];
    }

    $users = Db::queryAll("SELECT * FROM users WHERE ID=?", $ID);
    foreach($users as $user)
    {
        $Username  = $user["Username"];
    }
    if(!$Content || $_GET["username"] != $_SESSION["username"] || $Username != $_GET["username"])
    {
        Header("Location: ../404/404.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="Edit.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="whereamI">
    <label class="lblMyProfile">Edit post</label>
</div>
<form action="Edit.php?post=<?php echo $Post_ID; ?>&username=<?php echo $_SESSION["username"] ?>" method="post">
    <div class="CreatePost">
        <textarea class="txtContent" name="txtContent" placeholder="What's happening?" maxlength="500"><?php echo $Content ?></textarea>
        <input type="submit" value="Edit" class="btnSubmit">
    </div>
</form>
</body>
</html>

<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $NewContent = $_POST["txtContent"];
        $data = array("Content" => $NewContent);
        Db::update("posts", $data, "WHERE Post_ID=?", $Post_ID);
        Header("Location: ../Home/Home.php");
    }
?>