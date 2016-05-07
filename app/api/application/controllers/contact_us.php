<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 2015/6/5
 * Time: 23:22
 */

require_once 'application/class/ContactUs.php';
require_once 'util/myutils/JSONAlert.php';

class Contact_Us extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     *
     */
    public function submitContact() {

        $contactUs = new ContactUs($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$contactUs,
                'check_empty'=>array(
                    'email'=>'Email address required!',
                    'message'=>'Message required!'
                ),
                'check_email'=>array(
                    'email'=>'Email format not valid!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        if(!$jsonAlert->hasErrors){

            $this->db->insert('t_contact_us', array(
                'email'=>$contactUs->email,
                'message'=>$contactUs->message
            ));

            $jsonAlert->append(array(
                'successMsg'=>'We have received your request, we\'ll respond you soon!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

}