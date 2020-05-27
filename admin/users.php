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
                <h1 class="page-header text-center"> صفحة المستخدمين </h1>
                <?php  
                if(isset($_SESSION['message'])) {
                  echo ' <p class="bg-success" style="padding: 8px">'.$_SESSION['message'].'</p>';
                }
                ?>
               
            </div>
            <a href="add_user.php" class="btn btn-success text-right pull-right"> اضافة مستخدم جديد </a>
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                                
                                <th>الصوره</th>
                                <th>اسم المستخدم</th>
                                <th>الاسم الاخير </th>
                                <th>الاسم الاول </th>
                                <th>مسلسل</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                    
                        $users = User::find_all();

                        foreach($users as $user) { ?>
                            <tr>
                               
                                <td>
                                    <img src="user_images/<?php echo $user->user_image;?>" alt="" width="300" height="200" class="user_image">
                                  
                                </td>
                                
                                <td> <?php echo $user ->username;?>
                                    <div class="action-links">
                                        <a href="delete_user.php?id=<?php echo  $user->id; ?>" class="btn btn-danger delete">حذف المستخدم</a>
                                        <a href="edit_user.php?id=<?php echo  $user->id; ?>" class="btn btn-success">تعديل البيانات</a>
                                    </div>
                                </td>
                             
                                <td> <?php echo $user->last_name;?></td>
                                <td> <?php echo $user->first_name;?></td>
                                <td> <?php echo $user->id;?></td>
                            
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