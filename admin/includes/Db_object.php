<?php 

class Db_object {
         protected static $the_table = "users";
        // method to find all 

        public static function find_all() {
            $result_array = static::find_by_query("SELECT * FROM " . static::$the_table);
      
           return $result_array;
          }
      
          // method to find  by id
      
          public static function find_by_id($id) {
                 
             $result_array =  static::find_by_query("SELECT * FROM ".static::$the_table." WHERE id = $id");
             
            // check if the array is not empty then grap the first item 
            return !empty($result_array) ? array_shift($result_array) : false;
          
          }
      
          // nethod to find this query 
      
          public static function find_by_query($sql) {
              global $database;
             $result = $database->query($sql);
             $the_object_array = array();
             while($row = mysqli_fetch_array($result)){
                 $the_object_array[] = static::instatiation($row);
             }
             return $the_object_array;
          }
      
          public static function instatiation($the_record) {
              $the_object = new static;
              foreach($the_record as $the_attribute => $value) {
                if($the_object->has_the_attribute($the_attribute)) {
                    $the_object->$the_attribute = $value;
                }
              }
      
              return $the_object;
          }

         // method to check if the object has the attribute

        public static function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars(new static);
        if(array_key_exists($the_attribute,$object_properties)) {
            return 'true';
           }
        }

            // method to create 

    public function create() {
        global $database;

        $properties = $this->clean_properties();
        $array_keys= implode(",",array_keys($properties));
        $array_values = implode("','",array_values($properties));
        
    
        $sql = "INSERT INTO ".static::$the_table ."($array_keys) VALUES ('".html_entity_decode($array_values)."')";

      if($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
      } else {
            return false;
      }

   
    }

    // method to update 

    public function update() {
        global $database;
        $id = $this->id;
        $properties = $this->clean_properties();
        $properties_pairs = [];
        foreach($properties as $key => $value) {
            $properties_pairs[] = "{$key}='$value'";
        }
       $implode = implode(',',$properties_pairs);
        if(is_numeric($id)) {
            $sql = "UPDATE ".static::$the_table. " SET  $implode WHERE id = '$id'";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
    }

    //  delete  method 

    public function delete() {
      
        global $database;
        $id = $database->escape_string($this->id);
        $sql = "DELETE FROM ".static::$the_table." WHERE id = '$id' LIMIT 1";
        if($database->query($sql)) {
            return true;
        } else {
            return false;
        }
     
    }

    // method to check if the object is exist or not 

    public function save() {
        return (isset($this->id)) ? $this->update() : $this->create();
    }

    // method to get the object properties 
    public function properties() {
    
        $properties = array();

        foreach(static::$db_table_fields as $db_field) {
            if(property_exists($this,$db_field)) {
                $properties[$db_field] = $this->$db_field;
            } 
        }
       return $properties;
    }

    // method to clean properties 

    public function clean_properties () {
        global $database;

        $clean_properties = array();

        foreach($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    // method to delete the image when the user is deleted 

    public function delete_photo() {
         if($this->delete()) {
             $target_path = $this->upload_directory.DS. $this->user_image;
             return unlink($target_path) ? true : false;
         } else {
             return false;
         }
    }
      
}