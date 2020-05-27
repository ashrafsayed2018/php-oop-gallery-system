<?php require_once ("includes/init.php"); 

if(empty($_GET['id'])) {
    redirect('photos.php');
} else {
    $id = $_GET['id'];
    $photo = Photo::find_by_id($id);


if($photo) {
    $image_name = $photo->filename;
    $photo->delete_photo();
    redirect('photos.php');
    $session->message("The Photo $image_name Has Been Deleted");
}
}

?>
