<nav>
    <a class="navmenu" href="../Home/Home.php">
        <i class="bi bi-house-door-fill"></i> Home
    </a><br>
    <a class="navmenu" href="../Search/Search.php">
        <i class="bi bi-search"></i> Search
    </a>
    <a class="navmenu" href="../CreatePost/CreatePost.php?username=<?php echo $_SESSION["username"];?>">
        <i class="bi bi-pencil-fill"></i> Create
    </a><br>
    <a class="navmenu" href="../Messages/Messages.php?username=<?php echo $_SESSION["username"]; ?>">
        <i class="bi bi-send"></i> Messages
    </a><br>
    <a class="navmenu" href="../Notifications/Notifications.php?username=<?php echo $_SESSION["username"]; ?>">
        <i class="bi bi-bell"></i> Notifications
    </a>
    <a class="navmenu" href="../Profile/Profile.php?username=<?php echo $_SESSION["username"];?>">
        <i class="bi bi-person-fill"></i> Profile
    </a><br>

    <?php
        if (isset($_GET["logout"])) {
            session_unset();
            session_destroy();
            header("Location: ../Login/Login.php");
            exit();
        }
    ?>
</nav>

