<?php

class Session {
    private $signed_in = false;
    public $user_id;
    public $message = "this is me ";
    public $count;

    public function __construct () {
        session_start();
        $this->check_the_login();
        $this->check_message();
        $this->vistor_count();
        }

    // check the login method 
    private function check_the_login() {
     
        if(isset($_SESSION['user_id'])) {    // check if session user_id is set
          $this->user_id = $_SESSION['user_id']; // assign the session user_id to the object property user_id
          $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    // method to check if the user is signed in 
    public function is_signed_in() {
        return $this->signed_in;
    }

    // method to login the user 
    public function login($user) {

           if($user) {
               $this->user_id = $_SESSION['user_id'] = $user->id;
              
               $this->signed_in = true;
           }
    }

    // method to logout 
     public function logout() {
      session_unset();
      session_destroy();
        $this->signed_in = false;
     }

     // method to create message 

     public function message($msg = "") {

         if(!empty($msg)) {
             $_SESSION['message'] = $msg;
         } else {
             return $this->message;
         }

     }

    //  method to check if there is message 

    private function check_message() {
        if(isset($_SESSION['nessage'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    // method to count the visitors 

    public function vistor_count() {
        if(isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 0;
        }
    }

     
}
$session = new Session();

$message = $session->message();

