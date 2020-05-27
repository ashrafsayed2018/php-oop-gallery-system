<?php require_once ("includes/header.php");
 $photos   = Photo::find_all();

 ?>


<!-- Modal -->
<div class="modal fade" id="photo-library" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gallery System library</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
             <div class="row thumbnail">
                <?php foreach($photos as $photo) : ?>
                <div class="col-xs-2">
                  <a href="" role="checkbox" area-checked="false" tabindex=0>
                      <img src="user_images/<?= $photo->filename;?>" data-id="<?= $photo->id;?>" alt="" class="model-thumbnails img-responsive" style="height:100px;width:100%;margin-bottom:20px">
                    
                  </a>
                  <div class="photo-id hidden"></div>
                </div>
                <?php endforeach ;?>
             </div>
        </div>
        <div class="col-md-3">
            <div id="model_sidebar">

           
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="set_photo" class="btn btn-primary" disabled="true">Apply Selection </button>
      </div>
    </div>
  </div>
</div>