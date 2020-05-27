<?php 
require_once "init.php";
$user =new User();

if(isset($_POST['image_name'])) {
    $user_id = $_POST['user_id'];
    $image_name = $_POST['image_name'];

   $user->ajax_save_user_image($user_id,$image_name);

}


if(isset($_POST['photo_id'])) {
    $photo_id = $_POST['photo_id'];
   echo Photo::display_sidebar_data($photo_id);
  

}



