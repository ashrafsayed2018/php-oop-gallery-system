<?php 

require_once ("includes/header.php");
require_once "admin/includes/init.php";
if(empty( $_GET['id'])) {
 redirect('index.php');
} else {
    $id = $_GET['id'];

    $photo = Photo::find_by_id($id);
    
}


if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body   = trim($_POST['body']);
    $date   = date('Y-m-d H:i:s');

    $new_comment = Comment::create_comment($photo->id,$author,$body,$date);
    if($new_comment && $new_comment->save()) {
        
        redirect("photo.php?id=$photo->id");


    } else {
        $message = "sorry there is some problem saving your comment";
    }
}

$comments = Comment::find_the_comments($photo->id);

?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>اعلانات وتسويق الكتروني بالكويت</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">الرئيسيه</a>
                    </li>
                 
                    <li>
                        <a href="admin">الادمن</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8 col-lg-offset-2">

                <!-- Blog Post -->

                <!-- Title -->

                <!-- Author -->
                <h2 class="lead text-center">
                    <?= $photo->title;?>
    </h2>

                <hr>

                <!-- Date/Time -->
                <p class="text-right"><span class="glyphicon glyphicon-time"></span>  <?= $photo->date; ?> : نشر بتاريخ </p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?= $photo->picture_path();?>" alt="<?= $photo->picture_path();?>" style="width:100%;height:400px">

                <hr>

                <!-- Post Content -->
                <p class="lead text-right"><?= $photo->description ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4 class="text-right">اترك تعليق</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group text-right">
                            <input type="text" name="author" id="author" class="form-control text-right" placeholder=" اسمك ">
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control text-right" rows="3" placeholder="محتوي التعليق "></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary pull-right">تعليق</button>
                    </form>
            
                    <?php 
                      if(isset($message) && !empty($message)) {
                          echo '<div class="alert alert-danger text-center text-capitalize">'.$message.'</div>';
                      }
                    ?>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <?php foreach($comments as $comment) : ?>

                <div class="media">
                    <a class="pull-right" href="#">
                        <img class="media-object" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSQmx95IUXIcJVHq3Gj7cBzgWdZ0uRlWuIJdojtdD0mfpjj82NP&usqp=CAU" alt="" style="width=50px;height:50px;border-radius:50%">
                    </a>
                    <div class="media-body">
                        <span class="date"><?= $comment->date?></span>
                        <h4 class="media-heading">
                            <small><?=  $comment->author;?></small>
                        </h4>
                        <p><?=  $comment->body;?></p>
                    </div>
                </div>

                <?php endforeach ;?>


          

            </div>


                <!-- <div class="col-lg-4"> -->
                    
                <?php //include("includes/sidebar.php"); ?>
                <!-- </div> -->
       

                <!-- /.row -->

        
        </div>
    </div>

    <?php include("includes/footer.php"); ?>



