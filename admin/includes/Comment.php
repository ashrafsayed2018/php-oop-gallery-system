<?php 
require_once "init.php";

class Comment extends Db_object{
    protected static $the_table = "comments";
    protected static $db_table_fields = array('id',"photo_id","author","body","date");
    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $date;


    // method to instatiate the comment object 

    public static function create_comment($photo_id,$author,$body,$date) {
        if(!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment= new Comment();

            $comment->photo_id = $photo_id;
            $comment->author   = $author;
            $comment->body     = $body;
            $comment->date     = $date;

         return $comment;
        } else {
            return false;
        }
    }


    // method to find all the comment which related to the photo id 

    public static function find_the_comments($photo_id) {
        $query = "SELECT * FROM " . self::$the_table . " WHERE photo_id = '$photo_id' ORDER BY photo_id ASC";

        return self::find_by_query($query);
    }
  

  
}



