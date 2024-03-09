<?php
    session_start();
    $username = $_GET["username"];
    require("../DbHandler.php");
    require("../ConnectionChecker.php");
    require("../ValidateUser.php");
    Db::connect("localhost", "sin", "root", "");
    $LoggedUser = Db::queryOne("SELECT * FROM users WHERE Username=?", $username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications / Sin</title>
    <link rel="shortcut icon" type="x-icon" href="../Logo/Logo.png">
    <link rel="stylesheet" href="Notifications.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>"> 
</head>
<body>
    <div class="whereamI">
        <label class="lblMyProfile">Notifications</label>
    </div>
    <?php
        include("../Nav/Nav.php");
    ?>
    <div class="Notifications">
        <?php
            $follows = Db::queryAll("SELECT * FROM follow WHERE LoggedID=?", $LoggedUser["ID"]);
            foreach($follows as $follow)
            {
                if($follow["IsChecked"] == 0)
                {
                    $users = Db::queryAll("SELECT * FROM users WHERE ID=?", $follow["ID"]);
                    foreach($users as $user)
                    {
                        $FollowerName = $user["Name"];
                        $FollowerUsername = $user["Username"];
                        echo '
                            <div class="Notification">
                                <img src="../DefaultPFP/DefaultPFP.png" class="PFP"><br>
                                <a href="../Profile/Profile.php?username='.$FollowerUsername.'">'.$FollowerName.'</a> has just followed you!
                            </div>
                            <hr>
                        ';
                    }
                }
            }
        ?>
    </div>
</body>
</html>

<script>
    
</script>