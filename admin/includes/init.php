<?php 

date_default_timezone_set('Asia/Kuwait');
require_once "functions.php";
require_once "new_config.php";
require_once "Database.php";
require_once "Db_object.php";
require_once "User.php";
require_once "Photo.php";
require_once "Session.php";
require_once "Comment.php";
require_once "Paginate.php";

// define the directory seperator after checking is defined or not

defined('DS') ? NULL : define('DS',DIRECTORY_SEPARATOR);
define('SITE_ROOT','C:'.DS.'xampp'.DS.'htdocs'.DS.'gallery');
define('INCLUDES_ROOT',SITE_ROOT .DS.'admin'.DS.'includes');

