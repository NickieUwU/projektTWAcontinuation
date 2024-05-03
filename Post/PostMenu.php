<?php
    $Post_ID = $postID;
?>
<link rel="stylesheet" href="../Post/PostMenu.css?v=<?php echo time(); ?>">
<script src="../Post/PostMenuLoggedUser.js"></script>
<div class="MenuDiv">
    <span class="classMenuDots bi bi-three-dots-vertical" id="MenuDots" onclick="toggleMenu()"></span>
    <table id="MenuTable" class="" style="display: none;">
        <tbody>
            <tr>
                <td class="table-default">
                    <span class="bi bi-flag-fill"></span>
                </td>
                <td>
                    <span class="table-default">report</span>
                </td>
            </tr>
            <tr>
                <td class="table-danger">
                    <span>block</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>