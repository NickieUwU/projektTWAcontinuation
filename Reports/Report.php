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
    <title>Report / Connectify</title>
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
    <div class="whereamI">
        <label class="lblMyProfile">Report <?php echo $PosterUsername; ?>'s post</label>
    </div>
    <div class="Report">
        <form action="Report.php?Post=<?php echo $PostID; ?>&username=<?php echo $username; ?>" method="post">
            <select name="ReportOptions" class="ReportOptions">
                <option value="Spamming">Spamming</option>
                <option value="Fraud">Fraud</option>
                <option value="Bullying">Bullying</option>
                <option value="Copyright">Copyright</option>
            </select><br><br><br><br><br>
            <input type="text" placeholder="what happened?" name="explanation" max="50"><br>
            <input class="btn btn-outline-secondary" type="submit" value="Report">
        </form>
    </div>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $ReportOption = $_POST["ReportOptions"];
        $explanation = $_POST["explanation"];
        if($explanation != null)
        {
            $data = array("ReportOption" => $ReportOption, "ReportExplanation" => $explanation);
            Db::insert("reports", $data);
        }
    }
?>