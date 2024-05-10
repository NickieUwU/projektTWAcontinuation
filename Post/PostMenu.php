<?php
    $Post_ID = $postID;
?>
<link rel="stylesheet" href="../Post/PostMenu.css?v=<?php echo time(); ?>">
<script src="../Post/PostMenuLoggedUser.js"></script>
<div class="MenuDiv">
    <span class="classMenuDots bi bi-three-dots-vertical" id="MenuDots" onclick="toggleMenu()"></span>
    <div id="MenuTable" class="table table-dark" style="display: none;">
        <div class="report">
            <i class="icons bi bi-flag-fill"></i>
            <span>report</span>
        </div>
        <div class="block">

        </div>
    </div>
</div>
