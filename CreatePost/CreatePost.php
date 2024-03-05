<?php
    session_start();
    $username = $_GET["username"];
    require("../DbHandler.php");
    require("../ConnectionChecker.php");
    require("../ValidateUser.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create / Sin</title>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CreatePost.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
        include("../Nav/Nav.php");
    ?>
    <div class="whereamI">
           <label class="lblMyProfile">Create post</label>
    </div>
    <form action="CreatePost.php?username=<?php echo $_SESSION["username"]; ?>" method="post">
        <div class="CreatePost">
            <textarea class="txtContent" name="txtContent" placeholder="What's happening?" maxlength="500"></textarea>
            <input type="submit" value="Post" class="btnSubmit">
        </div>
    </form>
</body>
</html>

<?php
    if($_POST)
    {
        $Content = $_POST["txtContent"];
        if($Content != "")
        {
            Db::connect("localhost", "sin", "root", "");
            $Users = Db::queryAll("SELECT * FROM users WHERE Username=?", $username);
            foreach($Users as $User)
            {
                $ID = $User["ID"];
            }
            $PostCreationDate = date("Y-m-d");
            $data = array("ID" => $ID, "Content" => $Content, "PostCreation" => $PostCreationDate);
            Db::insert("posts", $data);
        }
        else
        {
            exit;
        }
    }
?>