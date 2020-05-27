<?php include("includes/header.php"); 

if(isset($_POST['upload'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->caption = $_POST['caption'];
    $photo->description = $_POST['description'];
    $photo->set_file($_FILES['file_upload']);

    // $path = $photo->tmp_path;
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
        if($photo->save()) {
            $success_msg = "<div class='alert alert-success'> the image uploaded successfully</div>";
        } else {
            $success_msg = "<div class='alert alert-success'> the image not uploaded </div>"; 
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
            عمل مقال جديد
        </h1>
        <div class="col-lg-6 col-lg-offset-3">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group text-right">
                    <label for="title">عنوان المقال</label>
                     <input type="text" name="title" id="title" class="form-control" value="<?= isset($photo->title) ? $photo->title: "";?>"  placeholder="عنوان المقال  لا يزيد عن 35 حرف ">
                     <div class="u-title-count"></div>
                </div>
                <?php 
                    if(isset($errors['empty_title'])) {
                        echo $errors['empty_title'];
                        
                    }
                    if(isset($errors['long_title'])) {
                        echo $errors['long_title'];
                        
                    }
                 ?>

                <div class="form-group text-right">
                    <label for="caption">عنوان مختصر للمقال</label>
                     <input type="text" name="caption" id="caption" class="form-control" value="<?= isset($photo->caption) ? $photo->caption: "";?>"  placeholder="عنوان المقال المختصر لا يزيد عن 100 حرف ">
                     <div class="u-caption-count"></div>
                </div>
                <?php 
                    if(isset($errors['empty_caption'])) {
                        echo $errors['empty_caption'];
                        
                    }
                    if(isset($errors['long_caption'])) {
                        echo $errors['long_caption'];
                        
                    }
                 ?>

                <div class="form-group text-right">
                <label for="desc">محتوى المقال</label>
                     <textarea name="description" id="desc" class="form-control" rows="10"  placeholder="محتوي المقال  لا يزيد عن 600 حرف "><?= isset($photo->description) ? $photo->description : "" ;?></textarea>
                     <div class="u-desc-count"></div>
                </div>
                <?php 
                    if(isset($errors['empty_description'])) {
                        echo $errors['empty_description'];
                        
                    }

                    if(isset($errors['long_description'])) {
                        echo $errors['long_description'];
                        
                    }
                 ?>
                <div class="form-group text-right">
                    <label for="file" class="btn btn-success pull-right">
                        ارفع صوره للمقال
                    <input type="file" name="file_upload" class="btn btn-info hidden" id="file" accept='image/*'>
                    </label>

                
                </div>
                <div class="form-group">
                    <input type="submit" name="upload" value="حفظ المقال " class="btn btn-primary pull-left">
                </div>
                <div class="uploaded-image">
                      <img src="" alt="" id="u-image" width="90" height="90">
                    </div>
                   
            </form>

            <?php 
            if(isset($success_msg)) {
                echo $success_msg;
                
            }
            if(isset($error_msg)) {
                echo "<div class='alert alert-danger'>" . $error_msg . "</dov>";
                
            }
            if(isset($photo->errors)) {
                foreach($photo->errors as $error) {
                    echo $error . "</br>";
                }
             }

            ?>


        </div>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>