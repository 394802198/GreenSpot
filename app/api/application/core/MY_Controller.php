<?php

class MY_Controller extends CI_Controller
{
    public function __construct($who)
    {
        parent::__construct();

        $manager = false;
        $wholesaler = false;

        if(!isset($_SESSION)) session_start();
        
        if($who=='manager'){
            if (!isset($_SESSION["manager"])) {
                header('Location:/manager/login');
            }
        } else if($who=='customer'){
            if (!isset($_SESSION["customer"])) {
                header('Location:/customer/login');
            }
        }
    }
    
    // If role isn't manager then redirect to index page
    public function isAdminSession(){

        if($_SESSION['manager']['role']=='administrator')
        {
            return true;
        }
        else
        {
            header('Location:/manager/main');
        }
    }
}