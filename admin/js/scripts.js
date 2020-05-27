$(function () {
    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_src_splitted;
    var image_name;
    var photo_id;
    $('.model-thumbnails').on('click',function (e) {
         e.preventDefault();
         $('.model-thumbnails').removeClass('bordered');
         $(this).addClass("bordered");
         $('#set_user_image').removeAttr('disabled');
         $('#set_photo').removeAttr('disabled');

         // getting the user id 

         var user_href = $("#user_id").attr('href');
         user_href_splitted = user_href.split('=');
         user_id = user_href_splitted[user_href_splitted.length - 1];
        // gettung the image name ;
         image_src = $(this).attr('src');
         image_src_splitted = image_src.split('/');
         image_name = image_src_splitted[image_src_splitted.length - 1];
        console.log(image_name);
         photo_id = $(this).attr('data-id');
         $.ajax({
            url : "includes/ajax_code.php",
            method : "post",
            data : {photo_id: photo_id},
            success : function (data) {
                  if(!data.error) {
                     $('#model_sidebar').html(data);
                  }
            }
        })
      

    });

    $('#set_user_image').on('click',function () {
      $.ajax({
          url : "includes/ajax_code.php",
          method : "post",
          data : {user_id: user_id,image_name: image_name},
          success : function (data) {
                if(!data.error) {
                   $('.user_image_box img').prop('src',"user_images/" + data);
             
                }
          }
      })
    });

    $('#set_photo').on('click',function () {
        var href = $('.info-box-delete a').attr('href');
        var photo_href = $('.info-box-delete a').attr('href');
        photo_href_splitted = photo_href.split('=');
        photo_id = photo_href_splitted[photo_href_splitted.length - 1];
        $.ajax({
            url : "includes/ajax_photo.php",
            method : "post",
            data : {photo_id: photo_id,photo_name: image_name},
            success : function (data) {
                  if(!data.error) {
                     $('.user_image_box img').prop('src',"user_images/" + data);
                     location.reload();
               
                  }
            }
        })
      });
 $("#toggle").on("click",function () {
     $(this).toggleClass('glyphicon glyphicon-menu-up glyphicon glyphicon-menu-down')
     $(".inside").slideToggle(500);
 });

 $('.delete').on("click",function () {
     return confirm("هل انت متاكد من الحذف ؟")
 })

 // count the title charchaters on key up
 $('#title').on('keydown',function (){
     $count = $(this).val().length + 1;
     $('.u-title-count').text(35 - $count + " : الاحرف المتبقيه");
     if($count > 35) {
        $('.u-title-count').css('color','red');
        $(this).attr('disabled',true)
     }
 });

  // count the edittitle charchaters on key up

 $('#e-title').on('keydown',function (){
    $count = $(this).val().length + 1;
    $('.edit-title-count').text(35 - $count + " : الاحرف المتبقيه");
    if($count > 35) {
       $('.edit-title-count').css('color','red');
       $(this).attr('disabled',true)
    }
});
  // count the caption charchaters on key up
  $('#caption').on('keydown',function (){
    $count = $(this).val().length + 1;
    $('.u-caption-count').text(100 - $count + " : الاحرف المتبقيه");
    if($count > 100) {
       $('.u-caption-count').css('color','red');
       $(this).attr('disabled',true)
    }
});

  // count the edit caption charchaters on key up
  $('#e-caption').on('keydown',function (){
    $count = $(this).val().length + 1;
    $('.edit-caption-count').text(100 - $count + " : الاحرف المتبقيه");
    if($count > 100) {
       $('.edit-caption-count').css('color','red');
       $(this).attr('disabled',true)
    }
});

  // count the desc charchaters on key up
  $('#desc').on('keydown',function (){
    $count = $(this).val().length + 1;
    $('.u-desc-count').text(600 - $count + " : الاحرف المتبقيه");
    if($count > 600) {
       $('.u-desc-count').css('color','red');
       $(this).attr('disabled',true)
    }
});

  // count the edit desc charchaters on key up
  $('#e-description').on('keydown',function (){
    $count = $(this).val().length + 1;
    $('.edit-desc-count').text(600 - $count + " : الاحرف المتبقيه");
    if($count > 600) {
       $('.edit-desc-count').css('color','red');
       $(this).attr('disabled',true)
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('.uploaded-image #u-image').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
  $("#file").change(function() {
    readURL(this);
  });

})