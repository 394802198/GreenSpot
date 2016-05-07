<?php

require_once 'application/class/util/EmailSender.php';
require_once 'application/class/util/Pagination.php';
require_once 'application/class/ContactUs.php';
require_once 'util/myutils/JSONAlert.php';

class Rest extends MY_Controller {

    public function __construct()
    {
        parent::__construct('manager');
        $this->load->database();
    }

    public function getResultsPage()
    {
        $pagination = new Pagination($this->input);

        $this->db->select('id, email, is_replied, received_datetime, replied_datetime');

        $this->db->like('email', $pagination->keywords);
        $this->db->or_like('message', $pagination->keywords);
        $this->db->or_like('reply', $pagination->keywords);
        $this->db->or_like('is_replied', $pagination->keywords);
        $this->db->or_like('received_datetime', $pagination->keywords);
        $this->db->or_like('replied_datetime', $pagination->keywords);

        $managerModel = $this->db->get('t_contact_us');

        echo json_encode($managerModel->result_object());

    }

    public function getMessageById()
    {
        $contactUs = new ContactUs($this->input);

        $contactUsModel = $this->db->get_where('t_contact_us', array(
            'id'=>$contactUs->id
        ));

        echo json_encode($contactUsModel->row_array());
    }

    public function doneReply()
    {
        $contactUs = new ContactUs($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$contactUs,
                'check_empty'=>array(
                    'id'=>'Id required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $this->db->update('t_contact_us', array(
                'is_replied'=>'YES'
            ), array(
                'id'=>$contactUs->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Switched Selected Message to Done Reply!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

    public function reply()
    {
        $contactUs = new ContactUs($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$contactUs,
                'check_empty'=>array(
                    'id'=>'Id required!',
                    'reply'=>'Reply Message required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

//            $this->db->update('t_contact_us', array(
//                'is_replied'=>'YES',
//                'replied_datetime'=>date('Y-m-d H:i:s'),
//                'reply'=>$contactUs->reply
//            ), array(
//                'id'=>$contactUs->id
//            ));

//            POP3::popBeforeSmtp('mail.greenspot.net.nz', 110, 30, 'info@greenspot.net.nz', 'Green13345', 2);


            $config = array(
                'host'          => 'mail.cyberpark.co.nz',
                'is_ssl'        => false,
                'port'          => 25,
                'host_name'     => 'www.greenspot.net.nz',
                'reply'         => 'info@cyberpark.co.nz',
                'reply_name'    => 'info@cyberpark.co.nz',
                'from'          => 'info@cyberpark.co.nz',
                'from_name'     => 'GreenSpot Info',
                'username'      => 'info@cyberpark.co.nz',
                'password'      => 'Cyberpark12345',
                'address'       => $contactUs->email,
                'subject'       => 'GreenSpot Contact Us Reply',
                'body'          => $contactUs->reply
            );
            EmailSender::send($config);

            $jsonAlert->append(array(
                'successMsg'=>'Replied successful!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

}