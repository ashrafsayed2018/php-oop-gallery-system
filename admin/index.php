<?php require_once ("includes/header.php");

if(!isset($_SESSION['username'])) {
    redirect('../index.php');
}
 $photos   = Photo::find_all();
 $users    = User::find_all();
 $comments = Comment::find_all();

?>

        <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

<?php require_once ('includes/top_nav.php'); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php  require_once ('includes/side_nav.php')?>
</nav>

<div id="page-wrapper" class="pull-left">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                   صفحة الادمن
                </h1>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $session->count;?></div>
                                        <div>عدد المشاهدات</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                  <span class="pull-left">تفاصيل المشاهدات</span> 
                               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-photo fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= count($photos)?></div>
                                        <div>المقالات</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="photos.php">مجموع المقالات </a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
        <?= count($users) ?>
                                        </div>

                                        <div>المستخدمين</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="users.php">اجمالي المستخدمين</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= count($comments) ?></div>
                                        <div>التعليقات</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="comments.php">اجمالي التعليقات</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                </div> <!--First Row-->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
             <div class="col-xs-12 col-lg-6 col-lg-offset-3">
                <div id="piechart" style="max-width: 900px; height: 500px;"></div>
             </div>
         
        </div>

    </div>
    <!-- /.container-fluid -->
 </div>
        <!-- /#page-wrapper -->

<?php require_once("includes/footer.php"); ?>


<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['المشاهدات الجديده',     <?= $session->count;?>],
        ['التعليقات',      <?= count($comments)?>],
        ['المستخدمين',   <?= count($users)?>],
        ['المقالات',  <?= count($photos)?>],
        
      ]);

      var options = {
        legend : "none",
        pieSliceText : "label",
        title: 'النشاطات اليوميه',
        backgroundColor : "transparent"
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>

</body>