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
                <a class="navbar-brand" href="#">دعايه واعلانات بالكويت</a>
                <a href="tel:0096560067832">
                    <i class="fa fa-phone"></i>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">الرئيسيه</a>
                    </li>
                    <li>
                        <a href="#">الخدمات</a>
                    </li>
                    <li>
                        <?php
                           if(isset($_SESSION['username'])) {
                               echo '  <a href="admin">الادمن</a>';
                           } else {
                        echo '<a href="admin/login.php">الادمن</a>';
                           }
                        ?>
                      
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>