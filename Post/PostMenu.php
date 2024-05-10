<?php
    $Post_ID = $postID;
?>
<link rel="stylesheet" href="../Post/PostMenu.css?v=<?php echo time(); ?>">
<script src="../Post/PostMenu.js"></script>
<div class="MenuDiv">
    <span class="classMenuDots bi bi-three-dots-vertical" id="MenuDots" onclick="toggleMenu()"></span>
    <div id="MenuTable" class="table table-dark" style="display: none;">
        <div class="divs report">
            <a href="../Reports/Report.php?Post=<?php echo $Post_ID?>&username=<?php echo $_SESSION["username"]; ?>">
                <i class="icons bi bi-flag-fill"></i>
                <span>report</span>
            </a>
        </div>
        <div class="divs block" id="block">
            <i class="icons bi bi-slash-circle"></i>
            <span>block</span>
        </div>
    </div>
</div>