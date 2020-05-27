<?php 

class Photo extends Db_object{

    protected static $the_table = "photos";
    protected static $db_table_fields = array('id','title',"caption","description","filename","alternate_text","type",'size',"date");
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;
    public $date;
    public $error;
    public $tmp_path;
    public $target_path;
    public $upload_directory = "user_images";
    public $errors = array();
    public $upload_error_array = array(
        UPLOAD_ERR_OK => 'There is no error, the file uploaded with success',
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
    );
  public function __construct() {
    $this->date     = date("Y-m-d h:i:s", time());
  }
    // method to set the path to $_FILES['upload_file'] as an argument

    public function set_file($file) {
        // check if the file is empty or it is not a file 
        if(empty($file) || ! $file || ! is_array($file)) {
            $this->errors[] = "there is no file is uploaded ";
            return false ;
        } else if($file['error'] != 0) {
            $this->errors[] = $this->upload_error_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = "C:\\xampp\\tmp\\".basename($file['tmp_name']);
            $this->type     = basename($file['type']);
            $this->size     = basename($file['size']);
           
            $this->error    = basename($file['error']);

           
        }
   
    }

    // method to save the image in the database 

    public function save() {

        if($this->id) {
            $this->update();
        } else {
           
            // check if the error array is not empty
            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "the file is not available";
                return false; 
            }

            $ext = pathinfo($this->filename, PATHINFO_EXTENSION);

            // check if the extension is jpg or jpeg or jif 
           $allowed_ext = ['jpeg','jpg','png'];
            if(!in_array($ext,$allowed_ext)) {
                $this->errors[] = "the file extension  is not allowed";
                return false; 
            }


            // set  the target

            $this->target_path = "user_images/". $this->filename;

            // check if the image file is already exist 

            if(file_exists($this->target_path)) {
                $this->errors[] = "the file {$this->filename} is already exists";
                return false;
            }
        
            if(move_uploaded_file($this->tmp_path,$this->target_path)) {
                if($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "the file directory probably has not the premissions ";
                return false;
            }

         
        }
       
      
    }

    // picture path method
     public function picture_path() {
         return $this->upload_directory .DS. $this->filename;
     }

     // function to delete the photo 

     function delete_photo() {
         if($this->delete()) {
             $target_path =  "user_images/". $this->filename;
             return unlink($target_path) ? true : false;
         } else {
            return false;
         }
     }

     // display the model side bar data 

     public static function display_sidebar_data($photo_id) {
        $photo = Photo::find_by_id($photo_id);
        $pic = $photo->picture_path();
        $output = "<img  class='thumbnail' src='$pic' width='100%'>";
        $output .= "<p>image name : $photo->filename</p>";
        $output .= "<p>image type : $photo->type</p>";
        $output .= "<p>image size : $photo->size</p>";
        $output .= "<p>upload date : $photo->date</p>";

        return $output;
    }

    
        // method to save user image by ajax 

        public function ajax_save_photo ($photo_id,$photo){
            global $database;
             $this->id = $photo_id;
             $this->filename = $photo;
            $query = "UPDATE photos SET filename = '$this->filename' WHERE id='$this->id'";
            $statment = $database->query($query);

            echo $this->filename;
          ;
        }

}
?>

