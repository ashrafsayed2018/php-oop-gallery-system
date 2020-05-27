<?php require_once ("includes/init.php"); 

if(empty($_GET['id'])) {
    redirect('users.php');
} else {
    $id = $_GET['id'];
    $user = User::find_by_id($id);


if($user) {
    $image_name = $user->user_image;
    $user->delete_photo();
    redirect('users.php');
    $session->message("The User $user->username Has Been Deleted");
}
}

?>