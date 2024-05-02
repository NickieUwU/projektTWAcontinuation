<?php
    $Post_ID = $postID;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="../Post/PostMenu.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="../Post/PostMenuLoggedUser.js"></script>
<div class="MenuDiv">
    <span class="classMenuDots bi bi-three-dots-vertical" id="MenuDots" onclick="toggleMenu()"></span>
    <table id="MenuTable" style="display: none;">
        <tbody>
            <tr>
                <td class="report">
                    <span class="bi bi-flag-fill"></span>
                </td>
                <td>
                    <span>report</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>block</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>