<?php

require_once 'application/class/util/Pagination.php';
require_once 'application/class/Manager.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/SessionController.php';

class Rest extends MY_Controller {

    public function __construct()
    {
        parent::__construct('manager');
        $this->load->database();
    }

    public function updateMyProfile()
    {
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'id'=>'Id required!',
                    'account'=>'Account required!',
                    'original_password'=>'Original password required!',
                    'first_name'=>'First name required!',
                    'last_name'=>'Last name required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $managerModel = $this->db->get_where('t_manager', array(
                'account'=>$manager->account,
                'password'=>$manager->original_password
            ));
            if($managerModel->num_rows > 0)
            {

                if($manager->new_password != '')
                {
                    $manager->password = $manager->new_password;
                }

                $this->db->update('t_manager', $manager->getEditableData(), array(
                    'id'=>$manager->id
                ));

                $sessionController = new SessionController();
                $sessionController->setSession('manager', $manager->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'My Profile Updated!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Original Password Not Matched!'
                ), TRUE);

            }

        }

        echo $jsonAlert->result();
    }

    public function getResultsPage(){

        $pagination = new Pagination($this->input);

        $this->db->select('id, account, role, first_name, last_name, email, mobile, landline');

        $this->db->like('account', $pagination->keywords);
        $this->db->or_like('role', $pagination->keywords);
        $this->db->or_like('first_name', $pagination->keywords);
        $this->db->or_like('last_name', $pagination->keywords);
        $this->db->or_like('email', $pagination->keywords);
        $this->db->or_like('mobile', $pagination->keywords);
        $this->db->or_like('landline', $pagination->keywords);

        $managerModel = $this->db->get('t_manager');

        echo json_encode($managerModel->result_object());

    }

    public function getManagerById()
    {
        $manager = new Manager($this->input);

        $managerModel = $this->db->get_where('t_manager', array(
            'id'=>$manager->id
        ));

        echo json_encode($managerModel->row_array());
    }

    public function update()
    {
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'id'=>'Id required!',
                    'account'=>'Account required!',
                    'password'=>'Password required!',
                    'first_name'=>'First name required!',
                    'last_name'=>'Last name required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $this->db->update('t_manager', $manager->getEditableData(), array(
                'id'=>$manager->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Manager Updated!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

    public function create()
    {
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'account'=>'Account required!',
                    'password'=>'Password required!',
                    'password_confirm'=>'Password confirm required!',
                    'first_name'=>'First name required!',
                    'last_name'=>'Last name required!'
                ),
                'check_differ'=>array(
                    'password|password_confirm'=>'Password must be matched!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $managerModel = $this->db->get_where('t_manager', array(
                'account'=>$manager->account
            ));
            if($managerModel->num_rows > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->insert('t_manager', $manager->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'Manager Created!'
                ), FALSE);

            }

        }

        echo $jsonAlert->result();
    }

    public function delete()
    {
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'id'=>'ID required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $managerModel = $this->db->get_where('t_manager', array(
                'id'=>$manager->id
            ));
            if($managerModel->num_rows < 1)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Manager Not Found!'
                ), TRUE);
            }
            else
            {
                $this->db->delete('t_manager', array(
                    'id' => $manager->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Manager Deleted!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

    /**
     * Get home page info
     */
    public function getHomeInfo()
    {
        /**
         * Get Plan info
         */
        $productComboLength = $this->db->count_all('t_product_combo');
        $productFeatureLength = $this->db->count_all('t_product_feature');
        $planLength = $this->db->count_all('t_plan');
        $deviceLength = $this->db->count_all('t_device');
        $addOnServiceLength = $this->db->count_all('t_addon_service');
        /**
         * Get Manager info
         */
        $managerLength = $this->db->count_all('t_contact_us');
        /**
         * Get Contact Us info
         */
        $messageLength = $this->db->count_all('t_contact_us');
        $this->db->where(array('is_replied'=>'NO'));
        $messageNotRepliedLength = $this->db->count_all_results('t_contact_us');
        /**
         * Get Provision Service
         */
        $this->db->where(array(''));


        echo json_encode(array(
            /**
             * Plan length
             */
            'productComboLength' => $productComboLength,
            'productFeatureLength' => $productFeatureLength,
            'planLength' => $planLength,
            'deviceLength' => $deviceLength,
            'addOnServiceLength' => $addOnServiceLength,
            /**
             * Manager length
             */
            'managerLength' => $managerLength,
            /**
             * Contact Us length
             */
            'messageLength' => $messageLength,
            'messageNotRepliedLength' => $messageNotRepliedLength
        ));
    }

}