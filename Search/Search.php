<?php
    session_start();
    require("../DbHandler.php");
    require("../ConnectionChecker.php");
    Db::connect("localhost", "sin", "root", "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search / Sin</title>
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Search.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include("../Nav/Nav.php"); ?>
    <div class="whereamI">
        <label class="lblMyProfile">Search</label>
    </div>
    <form action="Search.php" method="get" id="FormSearch">
        <div class="search">
            <input type="search" class="srchbar" name="searchbar" placeholder="Search" autocomplete="off">
            <input type="submit" value="Search" id="btnSearch">
        </div>
    </form>
</body>
</html>

<?php
    if($_GET)
    {
        
        $search = $_GET["searchbar"];

        $Users = Db::queryAll("SELECT * FROM users WHERE Username LIKE ?", "%".$search."%");

        if($Users)
        {
            foreach($Users as $User)
            {
                $Name = $User["Name"];
                $Username = $User["Username"];
            }
            echo '<div class="SearchResults" readonly>
                    <p class="pSearchResult"><a href="../Profile/Profile.php?username='.$Username.'">'.$Name.'</a>
                        <label>
                            '.$Username.'
                        </label>
                    </p>
                  </div><br>';
        }

        else 
        {
            echo '<div class="SearchResults" readonly>No users were found</div>';
        }
    }
?>