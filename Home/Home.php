<?php
    session_start();
    require("../ConnectionChecker.php");
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home / Connectify</title>
    <link rel="shortcut icon" type="x-icon" href="../Logo/Logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Post/Post.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include("../Nav/Nav.php"); ?>
    <div class="whereamI">
        <label class="lblMyProfile">Home</label>
    </div>
    <?php 
        include("../Post/Post.php"); 
    ?>
</body>
</html>

<?php
    if(isset($_POST["NameDeleteContent"]))
    {
        $postID = $_POST["postID"];

        $result = Db::query("DELETE FROM posts WHERE Post_ID=?", $postID);
        
        if($result)
        {
            echo "Post successfully deleted";
        }
        else
        {
            exit;
        }
    }

    if(isset($_POST["Nameheart"])) 
    { 
        $PostID = $_POST["Post_ID"];
        $IsLiked = $_POST["IsLiked"];    
        if($IsLiked == 0) 
        {
            $IsLiked = 1;
            $data = array("ID" => $LoggedID, "Post_ID" => $PostID, "Liked" => $IsLiked);
            Db::insert("likes", $data);
        } 
        elseif($IsLiked == 1) 
        {
            Db::query("DELETE FROM likes WHERE ID=? AND Post_ID=? AND Liked=?", $LoggedID, $PostID, 1);
            $IsLiked = 0;
        }
        echo json_encode(["IsLiked" => $IsLiked]);
        exit;
    } 
?>