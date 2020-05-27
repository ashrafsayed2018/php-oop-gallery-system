<?php 
require_once "init.php";

class User extends Db_object{
    protected static $the_table = "users";
    protected static $db_table_fields = array('username',"password","first_name","last_name","user_image");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $alternate_text;
    public $type;
    public $size;
    public $date;
    public $error;
    public $tmp_path;
    public $upload_directory = "user_images/";
    public $image_placeholder = "http://placehold.it/300/f00&text-image";
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

   // method to create the path for the image 

   public function image_path_and_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
   }

    // method to verify user login 

    public static function verify_user($username,$password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "SELECT * FROM ".self::$the_table." WHERE username = '$username' AND password = '$password' LIMIT 1 ";

        $result_array =  self::find_by_query($sql);

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
       
        // check if the array is not empty then grap the first item 
        return !empty($result_array) ? array_shift($result_array) : false;
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
                $this->user_image = basename($file['name']);
                $this->tmp_path = "C:\\xampp\\tmp\\".basename($file['tmp_name']);
                $this->type     = basename($file['type']);
                $this->size     = basename($file['size']);
                // $this->errors[]    = basename($file['error']);
            }
       
        }

            // method to upload the image images directory 

        public function upload_photo() {

    
            
                // check if the error array is not empty
                if(!empty($this->errors)) {
                    return false;;
                }

                if(empty($this->user_image) || empty($this->tmp_path)) {
                    $this->errors[] = "the file is not available";
                    return false; 
                }

                $ext = pathinfo($this->user_image, PATHINFO_EXTENSION);

                // check if the extension is jpg or jpeg or jif 
                $allowed_ext = ['jpeg','jpg','png'];

                if(!in_array($ext,$allowed_ext)) {
                    $this->errors[] = "the file extension  is not allowed";
                    return false; 
                }

                // set  the target

                $this->target_path = $this->upload_directory.DS. $this->user_image;

                if(file_exists($this->target_path)) {
                    $this->errors[] = "the file {$this->user_image} is already exists";
                    return false;
                }
                if(move_uploaded_file($this->tmp_path,$this->target_path)) {
                
                        unset($this->tmp_path);
                        return true;
                } else {
                    $this->errors[] = "the file directory probably has not the premissions ";
                    return false;
                }
        
        
        

        }

        // method to save user image by ajax 

        public function ajax_save_user_image ($user_id,$user_image){
            global $database;
             $this->id = $user_id;
             $this->user_image = $user_image;
            $query = "UPDATE users SET user_image = '$this->user_image' WHERE id='$this->id'";
            $statment = $database->query($query);

            echo $this->user_image;
        }

}

