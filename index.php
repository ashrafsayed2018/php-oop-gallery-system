<?php include("includes/header.php"); 
require_once "admin/includes/init.php";

$photos =  Photo::find_all();

$current_page = !empty($_GET['page']) ? $_GET['page'] : 1;

$items_per_page = 6;
$total_items_count = count($photos);;

$paginate = new Paginate($current_page,$items_per_page,$total_items_count);
 

// query to make the pagination work

$offset = $paginate->offset();

$query = "SELECT * FROM photos LIMIT $items_per_page OFFSET $offset";

$photos =  Photo::find_by_query($query);


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="top-header">
            
            </div>
        
        </div>
    </div>
</div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
           <h2 class="text-center ">الخدمات التي نقدمها </h2>
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="row">
                     <?php foreach ($photos as $photo) : ?>
                    
              
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="service-card">  
                            <div class="thumbnail">
                                <a href="photo.php?id=<?=  $photo->id; ?>" class="thumbnail">
                                    <img src="admin/<?= $photo->picture_path();?>" alt="" style="height:300px;width:100%">
                                </a>
                            </div>
                            <p class="title"><?= $photo->title;?></p>
                            <p class="description"><?= $photo->caption;?>
                            <a href="photo.php?id=<?=  $photo->id; ?>" class="more btn btn-info">المزيد </a>
                            </p>
                        </div>
                    </div>
                

                     <?php endforeach; ?>  
                </div>
            </div>




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->

            
                 <?php //include("includes/sidebar.php"); ?>



            <!-- </div> -->
        </div>

        <div class="row">
             <div class="col-lg-12">
                  <ul class="pagination">
                  <?php  
                    if($paginate->total_pages() > 1) {
                   
                        if($paginate->has_previous()){
                            $previous = $paginate->previous();
                            echo "<li class='previous'> <a href='index.php?page=$previous'>Previous</a>  </li>";
                        } 

                        $total_pages = $paginate->total_pages() ;
                 

                        for($i = 1 ; $i <= $total_pages ;$i++) { 
   
                           if($i == $paginate->current_page) {
                               echo "<li><a href='index.php?page=$i' class='active'>$i</a></li>";
                           } else {
                               echo "<li><a href='index.php?page=$i'>$i</a></li>";
                           }
           
                         }
                        if($paginate->has_next()) {
                            $next = $paginate->next();
                            echo "<li class='next'> <a href='index.php?page=$next'>Next</a>  </li>";
                        } 
                        
                    }
                   
                
                
                    ?>
                    
                  </ul>
             </div>
        </div>
        <!-- /.row -->

 </div>
        <?php include("includes/footer.php"); ?>
