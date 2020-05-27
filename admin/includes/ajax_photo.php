<?php 
require_once "init.php";
$photo =new Photo();

if(isset($_POST['photo_name'])) {
    $photo_id   = $_POST['photo_id'];
    $image_name = $_POST['photo_name'];

   var_dump($photo->ajax_save_photo($photo_id,$image_name)) ;

}


if(isset($_POST['photo_id'])) {
    $photo_id = $_POST['photo_id'];
   Photo::display_sidebar_data($photo_id);
  

}



