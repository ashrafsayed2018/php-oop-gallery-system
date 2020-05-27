<?php include("includes/header.php"); ?>

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
                <h1 class="page-header">
                  صفحة المقالات
                </h1>
                <?php 
                if(isset($_SESSION['message'])) { 
                     echo "<p class='bg-success' style='padding: 8px'>".$_SESSION['message']."</p>";
                }

                ?>
        
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                        <thead >
                        <tr class="text-right">
                                <th class="text-right">تاريخ الاضافه</th>
                                <th>اجمالي التعليقات</th>
                                <th class="text-right">الصوره</th>
                                <th class="text-right">الوصف</th>
                                <th>عنوان المقال</th>
                                <th>المسلسل</th>
                               
                        </tr>
                        </thead>
                        <tbody class="text-right">

                        <?php
                    
                        $photos = Photo::find_all();

                        foreach($photos as $photo) { 
                            $photo_id = $photo ->id;
                            $comments = Comment::find_the_comments($photo_id);
                            ?>
                        
                            <tr>
                                <td> <?php echo $photo ->date;?></td>
                                <td><a href="photo_comment.php?id=<?php echo $photo->id?>"><?php  echo count($comments);?></a></td>
                                <td>
                                    <div class="image">
                                        <img src="<?php echo $photo->picture_path();?>" alt="" width="200" height="100">
                                    </div>
                                    <div class="pictures-link">
                                        <a href="delete_photo.php?id=<?php echo  $photo ->id; ?>" class="btn btn-danger delete" style="width:60px">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo  $photo ->id; ?>" class="btn btn-success" style="width:60px">Edit</a>
                                        <a href="../photo.php?id=<?php echo  $photo ->id; ?>" class="btn btn-info" style="width:60px">View</a>
                                    </div>
                                 </td>
                                <td> <?php echo $photo ->description;?></td>
                                <td> <?php echo $photo ->title;?></td>
                                <td> <?php echo $photo ->id;?></td>
                            
                            </tr>
                        <?php } ?>
                    
                        </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

    </div>
<!-- /.container-fluid -->

   </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>