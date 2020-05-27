<?php 

function classAutoloader($class) {
// $class = strtolower($class);

$the_path = "includes/{$class}.php";
if(file_exists($the_path)) {
     require_once($the_path);
 
} else {
    // die("this file name {$class}.php was not found ...");
}
}
spl_autoload_register('classAutoloader');

function redirect($location) {
    header("Location:$location");
}
