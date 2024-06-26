<?php
    require("../DbHandler.php");
    Db::connect("localhost", "sin", "root", "");
    // Get a random user ID


    // Get a random post from the user
    $Posts = Db::queryAll("SELECT * FROM posts ORDER BY RAND() LIMIT 1");
    foreach($Posts as $Post)
    {
        $Post_ID = $Post["Post_ID"];
        $ID = $Post["ID"];
        $Content = $Post["Content"];
        $Date = $Post["PostCreation"];
    }

    $Users = Db::queryAll("SELECT * FROM users WHERE ID=?", $ID);

    foreach($Users as $User)
    {
        $Name = $User["Name"];
        $Username = $User["Username"];
    }

    $_LoggedUser = Db::queryAll("SELECT * FROM users WHERE Username=?", $_SESSION["username"]);
    foreach($_LoggedUser as $LoggedUser)
    {
        $LoggedID = $LoggedUser["ID"];
        $LoggedUsername = $LoggedUser["Username"];
    }
    $Likes = Db::queryAll("SELECT * FROM likes WHERE ID=? AND Post_ID=?", $LoggedID, $Post_ID);
    if($Likes)
    {
        foreach($Likes as $Like)
        {
            $IsLiked = $Like["Liked"];
        } 
    }
    else
    {
        $IsLiked = "0";
    }

    $LikesCount = Db::querySingle("SELECT COUNT(*) FROM likes WHERE Post_ID=?",  $Post_ID);
    $CommentsCount = Db::querySingle("SELECT COUNT(*) FROM comments WHERE Post_ID=?", $Post_ID);
    
    $BtnText;
?>

<input type="hidden" name="Post_ID" value="<?php echo $Post_ID; ?>">
<div class="post">
    <img src="../DefaultPFP/DefaultPFP.png" alt="Profile picture" class="PFP">
    <div class="post-info">
        <p class="name"><?php echo $Name; ?></p>
        <p class="handler" name="PostUsername"><?php echo $Username; ?></p>
        
    </div>
    <div class="date">
        <p class="date"><?php echo $Date; ?></p>
    </div>
    <textarea class="post-text" name="PostContent" readonly><?php echo $Content; ?></textarea>
    <div class="actions" id="actionID">
        <div class="heart" id="IDheart" name="Nameheart">
            <?php
                if($IsLiked == 0)
                {
                    echo '<i class="bi bi-heart"></i>';
                }
                else if($IsLiked == 1)
                {
                    echo '<i class="bi bi-heart-fill"></i>';
                }
                echo $LikesCount;
            ?>
        </div>
        <div class="comments">
        <a href="../ExpandedPost/ExpandedPost.php?Post=<?php echo $Post_ID; ?>&username=<?php echo $_SESSION["username"]; ?>">
                <i class="bi bi-chat-left-dots-fill"></i> <?php echo $CommentsCount; ?>
        </a> 
        </div>
        <div class="share">
            <i class="bi bi-share-fill"></i>
        </div>
    </div>
    <div class="menu">
        <?php
            if($LoggedID == $ID || $LoggedUsername == "@admin")
            {
                $postID = $Post_ID;
                include("../Post/PostMenuLoggedUser.php");
            }
            else
            {
                $postID = $Post_ID;
                include("../Post/PostMenu.php");
            }
        ?>
    </div>
</div> 
<br>
<script>
//You have to click the button twice
$(document).ready(() => {
    $(".share").click(() => {
        const postLink = "http://localhost/projektTWA/ExpandedPost/ExpandedPost.php?Post=<?php echo $Post_ID; ?>&username=<?php echo $_SESSION["username"]; ?>";
        const tempInput = document.createElement('input');
        tempInput.value = postLink;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
    });
        let IsLiked = <?php echo $IsLiked; ?>;
        $("#IDheart").click((e) => {
            IsLiked = (IsLiked == 0) ? 1 : 0;
            $.ajax({
                type: "POST",
                url: "Home.php",
                data: {
                    Nameheart: true,
                    IsLiked: IsLiked,
                    Post_ID: <?php echo $Post_ID; ?>
                },
                success: (resp) => {
                    console.log(resp);
                    if (IsLiked == 0) 
                    {
                        $("#IDheart").html('<i class="bi bi-heart"></i><?php echo $LikesCount++; ?>');
                    } 
                    else if (IsLiked == 1) 
                    {
                        $("#IDheart").html('<i class="bi bi-heart-fill"></i><?php echo $LikesCount--; ?>');
                    }
                },
                error: (xhr, status, error) => {
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>