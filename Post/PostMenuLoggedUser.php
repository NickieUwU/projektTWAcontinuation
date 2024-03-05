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
                <td class="delete">
                    <span id="IDdelete-content" name="NameDeleteContent" class="delete-content">delete</span>                    
                </td>
            </tr>
            <tr class="edit">
                <td name="NameEditPost" id="IDedit-post" class="edit-post">
                    <span name="NameEditPost" id="IDedit-post" class="edit-post"><a href="../Edit/Edit.php?post=<?php echo $Post_ID; ?>&username=<?php echo $_SESSION["username"]; ?>">edit</a></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(() => {
        $("#IDdelete-content").click(() => {
            var postID = <?php echo $Post_ID; ?>;
            $.ajax({
                type: "POST",
                url: "Home.php",
                data: {
                    NameDeleteContent: "delete",
                    postID: postID 
                },
                success: (resp) => {
                    console.log(resp);
                },
                error: (xhr, status, error) => {
                    console.log(xhr.responseText);
                }
            })
        });
    });
</script>
