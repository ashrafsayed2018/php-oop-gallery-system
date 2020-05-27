<?php include("includes/header.php");

if(empty($_GET['id'])) {
    redirect('photos.php');
} else {
    $id = $_GET['id'];
    $comments = Comment::find_the_comments($id);


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
                <h1 class="page-header"> Photo Comment Page </h1>
                <p class="bg-success" style="padding: 8px"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ""; ?></p>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                                <th>Id</th>
                                <th>author</th>
                                <th>body </th>
                                <th>Delete</th>
                               
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                    

                        foreach($comments as $comment) { ?>
                            <tr>
                                <td> <?php echo $comment->id;?></td>
                                <td> <?php echo $comment ->author;?> </td>
                                <td> <?php echo $comment->body;?></td>
                                <td>
                                    <div class="action-links">
                                        <a href="delete_comment.php?id=<?php echo  $comment->id; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>

                            
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