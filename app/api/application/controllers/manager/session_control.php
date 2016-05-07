<?php

require_once 'application/class/Manager.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/SessionController.php';

class Session_Control extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login()
    {
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'account'=>'Account required!',
                    'password'=>'Password required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $managerModelQuery = $this->db->get_where('t_manager', array(
                'account'=>$manager->account,
                'password'=>$manager->password
            ));

            if($managerModelQuery->num_rows() > 0)
            {

                $sessionController = new SessionController();
                $sessionController->setSession('manager',$managerModelQuery->row_array());

                $jsonAlert->append(array(
                    'successMsg'=>'Logon Successful!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account and Password not match! Please try again~'
                ), TRUE);
            }

        }

        echo $jsonAlert->result();
    }

    public function isLoggedIn()
    {
        $sessionController = new SessionController();
        $managerSession = $sessionController->getSession('manager');
        if(isset($managerSession)){
            echo 'YES';
        }
        else
        {
            echo 'NO';
        }
    }

    public function logout()
    {
        $sessionController = new SessionController();
        $sessionController->removeSession('manager');

        $jsonAlert = new JSONAlert();
        $jsonAlert->append(array(
            'successMsg'=>'Logout Successful!'
        ), FALSE);
        echo $jsonAlert->result();
    }

    public function getManagerSession(){
        $sessionController = new SessionController();
        echo json_encode($sessionController->getSession('manager'));
    }

}