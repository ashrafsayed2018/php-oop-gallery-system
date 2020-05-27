<?php include("includes/header.php"); 

if(empty($_GET['id'])) {
    redirect('photos.php');
} else {
    $id = $_GET['id'];
    $photo = Photo::find_by_id($id);

    if(isset($_POST["update"])) {
       
        $title          =  htmlentities($database->escape_string($_POST['title']));
        $caption        = htmlentities($database->escape_string($_POST['caption']));
        $alternate_text = htmlentities($database->escape_string($_POST['alternate_text']));
        $description    = htmlentities($database->escape_string($_POST['description']));

       $photo->title = $title;
       $photo->caption = $caption;
       $photo->alternate_text = $alternate_text;
       $photo->description = $description;
       $errors = [];

       if(mb_strlen($photo->title) > 35) {
           $errors['long_title'] = "<div class='alert alert-danger'> عنوان المقال اكبر من 35 احرف </div>";
       }
       if(mb_strlen($photo->caption) > 100) {
           $errors['long_caption'] = "<div class='alert alert-danger'> عنوان المقال المختصر اكبر من 100 احرف </div>";
       }
   
       if(mb_strlen($photo->description) > 600) {
           $errors['long_description'] = "<div class='alert alert-danger'> محتوي المقال اكبر من 600 احرف </div>";
       }
       if(empty($photo->title)) {
           $errors['empty_title'] = "<div class='alert alert-danger'> عنوان المقال فارغ</div>";
       }
       if(empty($photo->caption)) {
           $errors['empty_caption'] = "<div class='alert alert-danger'> عنوان المقال المختصر فارغ</div>";
       }
       if(empty($photo->description)) {
           $errors['empty_description'] = "<div class='alert alert-danger'> محتوي المقال فارغ</div>";
       }
       if(empty($errors)) {
       $photo->update();
       $session->message("The Photo $photo->filename Has Been Updated");
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
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                   تعديل المقال
                </h1>
            </div>
            <form action="" method="post">
                <div class="col-md-8">
                    
                        <div class="form-group text-right">
                        <label for="e-title">العنوان</label>
                            <input type="text" name="title" class="form-control" placeholder="image title" id="e-title" value="<?php echo $photo->title; ?>">
                            <div class="edit-title-count"></div>
                            <?php 
                                if(isset($errors['empty_title'])) {
                                    echo $errors['empty_title'];
                                    
                                }
                                if(isset($errors['long_title'])) {
                                    echo $errors['long_title'];
                                    
                                }
                            ?>

                        </div>
                        <div class="form-group text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#photo-library">
                            معرض الصور
                        </button>
                        <div class="user_image_box">
                            <img src="<?php echo $photo->picture_path();?>" alt="" width="100%">
                        </div>
                           
                        </div>
                        <div class="form-group text-right">
                            <label for="e-caption">عنوان مختصر</label>
                            <input type="text" name="caption" class="form-control" id="e-caption" value="<?php echo $photo->caption; ?>">
                            <div class="edit-caption-count"></div>
                            <?php 
                            if(isset($errors['empty_caption'])) {
                                echo $errors['empty_caption'];
                                
                            }
                            if(isset($errors['long_caption'])) {
                                echo $errors['long_caption'];
                                
                            }
                             ?>
                         </div>
                        <div class="form-group text-right">
                            <label for="alternate">  النص البديل للصوره اختياري</label>
                            <input type="text" name="alternate_text" class="form-control" id="alternate" value="<?php echo $photo->alternate_text; ?>">
                        </div>
                        <div class="form-group text-right">
                            <label for="e-description">محتوي المقال </label>
                            <textarea name="description" id="e-description" class="form-control" rows="4"> <?php echo $photo->description;?></textarea>
                            <div class="edit-desc-count"></div>
                            <?php 
                            if(isset($errors['empty_description'])) {
                                echo $errors['empty_description'];
                                
                            }

                            if(isset($errors['long_description'])) {
                                echo $errors['long_description'];
                                
                            }
                        ?>
                        </div>
                
                </div>
            
                <div class="col-md-4" >
                    <div  class="photo-info-box">
                        <div class="info-box-header">
                            <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                        </div>
                        <div class="inside">
                            <div class="box-inner">
                            <p class="text">
                                    <span class="glyphicon glyphicon-calendar"></span> تم التحميل في:<?php echo $photo->date; ?>
                                </p>
                                <p class="text ">
                                   مسلسل: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                </p>
                                <p class="text">
                                    اسم الملف: <span class="data"><?php echo $photo->filename; ?></span>
                                </p>
                                <p class="text">
                                   نوع الملف: <span class="data"><?php echo $photo->type; ?></span>
                                </p>
                                <p class="text">
                                   حجم الملف: <span class="data"><?php echo $photo->size; ?></span>
                                </p>
                            </div>
                            <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg delete" id="user_id" >حذف</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="تحديث" class="btn btn-primary btn-lg ">
                                </div>   
                            </div>
                    </div>          
                </div>
            </form>
        </div>
        
        <!-- /.row -->
        <?php  require_once "includes/photo_library_model.php"?>
    </div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>