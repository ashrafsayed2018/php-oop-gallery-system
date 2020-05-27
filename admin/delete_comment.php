<?php require_once ("includes/init.php"); 

if(empty($_GET['id'])) {
    redirect('comments.php');
} else {
    $id = $_GET['id'];
    $comment = Comment::find_by_id($id);


if($comment) {
   
    $comment->delete();
    redirect("comments.php?id={$comment->photo_id}");
    $session->message("The Comment $comment->id Has Been Deleted");
} else {
    redirect("comments.php?id={$comment->photo_id}");   
}
}

?>
