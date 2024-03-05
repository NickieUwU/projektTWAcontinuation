<?php
    session_start();
    require("../ConnectionChecker.php");
    require("../DbHandler.php");
    $username = $_GET["username"];
    require("../ValidateUser.php");
    Db::connect("localhost", "sin", "root", "");
    $LoggedUsers = Db::queryAll("SELECT * FROM users WHERE Username=?", $_GET["username"]);
    foreach($LoggedUsers as $LoggedUser)
    {
        $LoggedID = $LoggedUser["ID"];
        $LoggedUsername = $LoggedUser["Username"];
        $LoggedFollowing = $LoggedUser["Following"];
    }
    $Followings = Db::queryAll("SELECT * FROM follow WHERE LoggedID=?", $LoggedID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages / Sin</title>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="../Nav/Nav.css">
    <link rel="stylesheet" href="Messages.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
        include("../Nav/Nav.php");
    ?>
    <div class="whereamI">
           <label class="lblMyProfile">Messages</label>
    </div>
    <div class="layout">
        <div class="UsersMessage">
            <div id="NewMessageRedirect" onclick="toggleChooseUser()">
                <i class="bi bi-envelope-fill"></i> New message
            </div>
            <div class="ChooseUser" style="display: none;">
                <?php 
                        foreach($Followings as $Following)
                        {
                            $IsFollowed = $Following["IsFollowed"];
                            $Users = Db::queryAll("SELECT * FROM users WHERE ID=?", $IsFollowed);
                            foreach($Users as $User)
                            {
                                $Name = $User["Name"];
                                $Username = $User["Username"];
                                echo "$Name $Username<br>";
                            }
                        }
                    ?>
            </div>
        </div>
    </div>
    
    <script>
        let isDivVisible = false;

        function toggleChooseUser() {
            let chooseUserDiv = document.querySelector(".ChooseUser");
            if (!isDivVisible) 
            {
                chooseUserDiv.style.display = "block";
                isDivVisible = true;
            } 
            else 
            {
                chooseUserDiv.style.display = "none";
                isDivVisible = false;
            }
        }
    </script>
</body>
</html>
