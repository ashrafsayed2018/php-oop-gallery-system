<?php include("includes/header.php"); 

$user = new User();

    if(isset($_POST["add"])) {
       
        $username          = htmlentities($database->escape_string($_POST['username']));
        $firstname         = htmlentities($database->escape_string($_POST['firstname']));
        $lastname          = htmlentities($database->escape_string($_POST['lastname']));
        $password          = htmlentities($database->escape_string($_POST['password']));
        $image = $_FILES['user_image'];
        $user_errors = [];

        if(empty($username)) {
            $user_errors['emptyuser'] = "username should not be empty ";
        }

        if(!empty($username) && strlen($username) < 3) {
            $user_errors['userlength'] = "username should be more than 3 chars ";
        }

        if(empty($firstname)) {
            $user_errors['emptyfirst'] = "first name should not be empty ";
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

        if(empty($password)) {
            $user_errors['emptypass'] = "password should not be empty ";
        }

        if(!empty($password) && strlen($password) < 5) {
            $user_errors['passlength'] = "password should be more than 5  chars ";
        }

     
      if(empty($user_errors)) {
        $user->username = $username;
        $user->first_name = $firstname;
        $user->last_name = $lastname;
        $user->password = $password;
        $user->set_file($image);

        $user->upload_photo();
 
        $user->save();

        $success = "<div class='alert alert-success'>the new user was added successfully </div>";
        $session->message("The User $user->username Has Been Added");
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
                   Add  users Page
                </h1>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6 col-lg-offset-3">
                    
                        <div class="form-group">
                            <label for="username">username</label>
                            <input type="text" name="username" class="form-control" id="username">

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
                            <input type="text" name="firstname" class="form-control" id="firstname">
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
                            <input type="text" name="lastname" class="form-control" id="lastname">
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
                            <input type="password" name="password" class="form-control" id="password">
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
                          
                            <input type="submit" name="add" class="btn btn-primary pull-right" value="Add User" >
                           
                        </div>
                        <?php 
                           echo  isset($success) ? $success : '';
                            ?>
                
                </div>
                <?php  

                if(isset($user->errors)) {
                   foreach($user->errors as $error) {
                       echo "<duv class='alert alert-dabger'>".$error."<div>";
                   }
                }

              
                
                ?>
            </form>
        </div>
        
        <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>