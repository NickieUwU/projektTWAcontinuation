<?php
    session_start();
    require("../ConnectionChecker.php");
    require("../DbHandler.php");
    $username = $_GET["username"];
    require("../ValidateUser.php");
    Db::connect("localhost", "sin", "root", "");
    $Users = Db::queryAll("SELECT * FROM  users WHERE Username=?", $username);
    foreach($Users as $User)
    {
        $name = $User["Name"];
        $bio = $User["Bio"];
        $joined = $User["Joined"];
        $followers = $User["Followers"];
        $following = $User["Following"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="../Nav/Nav.css">
    <link rel="stylesheet" href="ProfileEdit.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<body>
    <?php 
        include("../Nav/Nav.php");
    ?>
    <div class="whereamI">
           <label class="lblMyProfile">Edit profile</label>
    </div>
    <div class="EditNameDiv">
        <form action="ProfileEdit.php?username=<?php echo $username; ?>" method="post">
            <input type="text" name="newName" placeholder="<?php echo $name?>" autocomplete="off">
            <input type="submit" name="btnNewUsername" value="Change rname" class="btnSubmit">
        </form>
    </div>
    <div class="EditBioDiv">
        <form action="ProfileEdit.php?username=<?php echo $username; ?>" method="post">
            <input type="text" name="newBio" placeholder="<?php  echo $bio; ?>" autocomplete="off">
            <input type="submit" name="btnNewBio" value="Change bio" class="btnSubmit">
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST["btnNewUsername"]))
    {
        $new_name = $_POST["newName"];
        if($new_name != "")
        {
            $result = Db::update("users", array("Name" => $new_name), "WHERE Name=?", $name);
        }
        else
        {
            exit;
        }
    }
    if(isset($_POST["btnNewBio"]))
    {
        $new_bio = $_POST["newBio"];
        if($new_bio != "")
        {
            $result = Db::update("users", array("Bio" => $new_bio), "WHERE Bio=?", $bio);
        }
        else
        {
            exit;
        }
    }
?>