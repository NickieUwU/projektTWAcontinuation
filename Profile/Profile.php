<?php
    session_start();
    require("../ConnectionChecker.php");
    require("../DbHandler.php");
    $username = $_GET['username'];
    Db::connect("localhost", "sin", "root", "");
    $Users = Db::queryAll("SELECT * FROM  users WHERE Username=?", $username);
    if($Users)
    {
        foreach($Users as $User)
        {
            $ID = $User["ID"];
            $name = $User["Name"];
            $bio = $User["Bio"];
            $joined = $User["Joined"];
            $followers = $User["Followers"];
            $following = $User["Following"];
        }
    }
    else
    {
        $name = "";
    }
    if($name == "")
    {
        header("Location: ../404/404.php");
    }
    $LoggedUsers = Db::queryAll("SELECT * FROM users WHERE Username=?", $_SESSION["username"]);
    foreach($LoggedUsers as $LoggedUser)
    {
        $LoggedID = $LoggedUser["ID"];
        $loggedFollowing = $LoggedUser["Following"];
        
    }
    $follows = Db::queryAll("SELECT * FROM follow WHERE ID=? AND LoggedID=?", $ID, $LoggedID);
    if($follows)
    {
        foreach($follows as $follow)
        {
            $IsFollowed = $follow["IsFollowed"];
        }
    }
    else
    {
        $IsFollowed = "0";
    }
    $FollowText;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($IsFollowed == 0)
        {
            $followers++;
            $loggedFollowing++;
            $IsFollowed = 1;
            $dataFollowing = array("Following" => $loggedFollowing);
            Db::update("users", $dataFollowing, "WHERE ID=?", $LoggedID);
            $dataFollower = array("Followers" => $followers);
            Db::update("users", $dataFollower, "WHERE ID=?", $ID);
            $followdata = array("ID" => $ID, "LoggedID" => $LoggedID,  "IsFollowed" => $IsFollowed);
            Db::insert("follow", $followdata);
        }
        elseif($IsFollowed == 1)
        {
            Db::query("DELETE FROM follow WHERE ID=? AND LoggedID=? AND IsFollowed=?", $ID, $LoggedID, $IsFollowed);
            $followers--;
            $loggedFollowing--;
            $IsFollowed = 0;
            $dataFollowing = array("Following" => $loggedFollowing);
            Db::update("users", $dataFollowing, "WHERE ID=?", $LoggedID);
            $dataFollower = array("Followers" => $followers);
            Db::update("users", $dataFollower, "WHERE ID=?", $ID);
        }
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$name ($username)" ?> / Sin</title>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <form action='Profile.php?username=<?php echo $username; ?>' method='post' id='FollowFormID'>
        <?php
            require("../Nav/Nav.php");
        ?>
        <div class="whereamI">
            <label class="lblMyProfile">Profile</label>
        </div>
        <div class="User">
            <img src="../DefaultPFP/DefaultPFP.png" class="PFP">
            <div class="Name">
                <?php
                    echo $name;
                ?>
            </div>
            <div class="Username">
                <?php
                    echo $username;
                ?>
            </div>
            <div class="Bio">
                <?php
                    echo $bio;
                ?>
            </div>
            <div class="JoinedDate">
                <?php echo "Joined $joined"; ?>
            </div>
            <div class="Action">
                    <?php
                        if($IsFollowed == 0)
                        {
                            $FollowText = "follow";
                        }
                        elseif($IsFollowed == 1)
                        {
                            $FollowText = "unfollow";
                        }
                        if($_SESSION["username"] == $username)
                        {
                            echo "<a href='../ProfileEdit/ProfileEdit.php?username=$username'>
                                    <input type='button' name='edit' id='IDedit' value='edit'>
                                </a>";
                        }
                        else
                        {
                            echo '<button id="FollowID" class="btnFollow">'.$FollowText.'</button>';
                        }
                    ?>
            </div>
            <div class="Followers" >
                <label id="DisplayFollowID">
                    <?php
                        if($followers == 1)
                        {
                            echo "$followers follower";
                        }
                        else
                        {
                            echo "$followers followers";
                        }
                    ?>
                </label>
            </div>
            <div class="Following">
                <?php echo "$following following"; ?>
            </div>
        </div>
    </form>
</body>
</html>
<script>
document.getElementById('FollowFormID').addEventListener('submit', function(event) {
    event.preventDefault();

    var form = event.target;
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open(form.method, form.action, true);
    xhr.onload = function() {
        if (xhr.status == 200) 
        {
            var btnFollow = document.getElementById("FollowID");
            btnFollow.innerHTML = (btnFollow.innerHTML === "follow") ? "unfollow" : "follow";
            var Follower = document.getElementById("DisplayFollowID");
        }
    };
    xhr.send(formData);
});
</script>