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
                <h1 class="page-header text-center"> صفحة التعليقات </h1>
                <?php 
                if(isset($_SESSION['message'])) { 
                     echo "<p class='bg-success' style='padding: 8px'>".$_SESSION['message']."</p>";
                }

                ?>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                                
                                <th class="text-right">حذف</th>
                                <th class="text-right">المحتوى </th>
                                <th class="text-right">صاحب المقال</th>
                                <th class="text-right">المسلسل</th>
                               
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                    
                        $comments = Comment::find_all();

                        foreach($comments as $comment) { ?>
                            <tr>
                              
                               
                                
                                <td>
                                    <div class="action-links">
                                        <a href="delete_comment.php?id=<?php echo  $comment->id; ?>" class="btn btn-danger delete">Delete</a>
                                    </div>
                                </td>
                                <td> <?php echo $comment->body;?></td>
                                <td> <?php echo $comment ->author;?> </td>
                                <td> <?php echo $comment->id;?></td>

                            
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