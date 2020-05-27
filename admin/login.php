<?php
 require_once("includes/header.php"); 

 if($session->is_signed_in()) {

    redirect("index.php");
    
    }

if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   
    // method to check database user 

    $found_user = User::verify_user($username,$password);
  
  
   
    if($found_user) {
        $session->login($found_user);
        redirect("index.php");
      
        
    } else {
       
        $the_message = "اسم المستخدم او الرقم السري غير صحيحان";
    }

 } 
 else {
    $the_message = "";
    $username = "";
    $password = "";
    
    }
    
    
     ?>
    
    
    <div class="col-md-4 col-md-offset-3" >
    
   <h2 class="text-center">تسجيل دخول كأدمن </h2>
        
    <form id="login-id" action="" method="post">
        
    <div class="form-group">
        <label for="username" class="pull-right">اسم المستخدم</label>
        <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >
    
    </div>
    
    <div class="form-group">
        <label for="password" class="pull-right">الرقم السري</label>
        <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
        
    </div>
    
    
    <div class="form-group">
    <input type="submit" name="submit" value="دخول" class="btn btn-primary pull-right">
    
    </div>
    
    
    </form>
    <?php
    if(!empty($the_message)) { ?>
    <div class="bg-danger" style="padding :10px;font-size:2rem"><?php  echo $the_message; ?></div>
   <?php } ?>

    
    </div>
    
     
    
    
    
    
    