document.addEventListener("DOMContentLoaded", function() {
    var comments = document.querySelectorAll(".Comments .Comment");
    var commentCount = comments.length;
    let CommentsDiv = document.querySelector(".Comments");
    let LoadMore = "";
    if(commentCount%5 == 0) 
    {
        LoadMore = "load more";
    }
    else 
    {
        LoadMore = "";
    }
    CommentsDiv.innerHTML += `<div name="NameMoreComments" id="IDMoreComments" class="MoreComments">${LoadMore}</div>`;
});