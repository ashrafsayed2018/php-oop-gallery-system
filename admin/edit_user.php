<?php include("includes/header.php"); 
if(empty($_GET['id'])) {
    redirect('users.php');
} else {
$id = $_GET['id'];

$photo = new Photo();



$user = User::find_by_id($id);
if($user) {
    $user_name = $user->username;
    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $user_password = $user->password;
    $user_image = $user->user_image;

    if(isset($_POST["update"])) {
       
        $username          = htmlentities($database->escape_string($_POST['username']));
        $firstname         = htmlentities($database->escape_string($_POST['firstname']));
        $lastname          = htmlentities($database->escape_string($_POST['lastname']));
        $password          = htmlentities($database->escape_string($_POST['password']));

        $image = $_FILES['user_image'];

    

     
        $user_errors = [];
        // $no_update = [];
        if(empty($username)) {
            $user_errors['emptyuser'] = "username should not be empty";
        }
        if($user_name == $username) {
            $no_update['sameusername'] = "the new user name is the same current username ";
        }

        if(!empty($username) && strlen($username) < 3) {
            $user_errors['userlength'] = "username should be more than 3 chars ";
        }

        if(empty($firstname)) {
            $user_errors['emptyfirst'] = "first name should not be empty ";
        }
        if($first_name == $firstname) {
            $no_update['samefirst'] = "the new first name is the same current first name ";
        }

        if(!empty($firstname) && strlen($firstname) < 3) {
            $user_errors['firstlength'] = "first name  should be more than 3 chars ";
        }

        if(empty($lastname)) {
            $user_errors['emptylast'] = "last rname should not be empty ";
        }

        if(!empty($lastname) && strlen($lastname) < 3) {
            $user_errors['lastlength'] = "last name should be more than 3 chars ";
        }
        if($last_name == $lastname) {
            $no_update['samelast'] = "the new last name is the same current last name ";
        }
        if(empty($password)) {
            $user_errors['emptypass'] = "password should not be empty ";
        }

        if(!empty($password) && strlen($password) < 5) {
            $user_errors['passlength'] = "password should be more than 5  chars ";
        }

        if($user_password == $password) {
            $no_update['samepass'] = "the new password is the same current password ";
        }

        if($user_image == $image['name']) {
            $no_update['sameimage'] = "the new image is the same current image ";
        }
        
        

      if(empty($user_errors)) {
        $user->username = $username;
        $user->first_name = $firstname;
        $user->last_name = $lastname;
        $user->password = $password;
        $user->user_image = $image['name'];

        if(empty($image)) {
            $user->save();
            redirect("users.php");
            $session->message("The User $user->username Has Been Updated");
        } else {
            $user->set_file($image);
            $user->upload_photo();
            $user->save();
            redirect("users.php");
            $session->message("The User $user->username Has Been Updated");
        }
       
 
      
     

       
      }

    
 }
}


}

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

<?php include ('includes/top_nav.php'); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php  include ('includes/side_nav.php')?>
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-8 ">
                <h1 class="page-header text-center">
                    Edit user Page
                </h1>
            </div>
        </div>
        <div class="row">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#photo-library">
  Photos Library 
</button>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-lg-3">
                 <div class="user_image_box">
                     <img src="user_images/<?php echo $user->user_image;?>" alt="" width="100%" height="300px">
                 
                 </div>
                </div>
                <div class="col-lg-6">
                    
                        <div class="form-group">
                            <label for="username">username</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?php echo isset($user_name) ? $user_name: '';?>">

                            <?php 
                                if(isset($user_errors['emptyuser'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['emptyuser']."</div>"; 
                                }
                             
                                if(isset($user_errors['userlength'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['userlength']."</div>"; 
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="firstname">first name</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo isset($first_name) ? $first_name: '';?>">
                            <?php 
                                if(isset($user_errors['emptyfirst'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['emptyfirst']."</div>"; 
                                }
                             
                                if(isset($user_errors['firstlength'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['firstlength']."</div>"; 
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="lastname">lastname</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo isset($last_name) ? $last_name: '';?>">
                            <?php 
                                if(isset($user_errors['emptylast'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['emptylast']."</div>"; 
                                }
                              
                                if(isset($user_errors['lastlength'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['lastlength']."</div>"; 
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="text" name="password" class="form-control" id="password" value="<?php echo isset($user_password) ? $user_password: '';?>">
                            <?php 
                                if(isset($user_errors['emptypass'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['emptypass']."</div>"; 
                                }
                                if(isset($user_errors['passlength'] )) {
                                    echo "<div class='alert alert-danger'>". $user_errors['passlength']."</div>"; 
                                }
                              
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="image">image</label>
                            <input type="file" name="user_image" class="form-control" id="image" accept="image/*">
                        </div>
                        <div class="form-group">
                          
                            <input type="submit" name="update" class="btn btn-primary pull-right" value="update User" >
                            <a href="delete_user.php?id=<?php echo $id;?>" id="user_id"  class="btn btn-danger pull-left">Delete</a>
                           
                        </div>
                        <?php 
              
                          
                           echo  isset($success) ? $success : '';
               
                            ?>
                
                </div>
            </form>
        </div>
        
        <!-- /.row -->

<?php  require_once "includes/user_libarary_model.php"?>

    </div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>