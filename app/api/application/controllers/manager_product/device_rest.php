<?php

require_once 'application/class/util/Pagination.php';
require_once 'application/class/Device.php';
require_once 'util/myutils/JSONAlert.php';

class Device_Rest extends MY_Controller {

    public function __construct()
    {
        parent::__construct('manager');
        $this->load->database();
    }

    public function getResultsPage(){

        $pagination = new Pagination($this->input);

        $this->db->select('id, name, lump_fee, weekly_fee, monthly_fee, annual_fee, is_lump_accepted, is_weekly_accepted, is_monthly_accepted, is_annual_accepted, is_on_shelf');

        $this->db->like('name', $pagination->keywords);
        $this->db->or_like('lump_fee', $pagination->keywords);
        $this->db->or_like('weekly_fee', $pagination->keywords);
        $this->db->or_like('monthly_fee', $pagination->keywords);
        $this->db->or_like('annual_fee', $pagination->keywords);

        $deviceModel = $this->db->get('t_device');

        echo json_encode($deviceModel->result_object());

    }

    public function getAll(){

        $deviceModel = $this->db->get('t_device');

        echo json_encode($deviceModel->result_object());

    }

    public function getDeviceById()
    {
        $device = new Device($this->input);

        $deviceModel = $this->db->get_where('t_device', array(
            'id'=>$device->id
        ));

        echo json_encode($deviceModel->row_array());
    }

    public function update()
    {
        $device = new Device($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$device,
                'check_empty'=>array(
                    'id'=>'Id required!',
                    'name'=>'Name required!'
                ),
                'check_numeric'=>array(
                    'lump_fee'=>'Lump Fee must be numeric!',
                    'weekly_fee'=>'Weekly Fee must be numeric!',
                    'monthly_fee'=>'Monthly Fee must be numeric!',
                    'annual_fee'=>'Annual Fee must be numeric!'
                ),
                'check_one_not_empty'=>array(
                    'lump_fee|weekly_fee|monthly_fee|annual_fee'=>'Require at least one pay frequency fee!'
                ),
                'check_empty_on_other'=>array(
                    'is_lump_accepted=YES|lump_fee'=>'Lump Fee must be assigned if accepted!',
                    'is_weekly_accepted=YES|weekly_fee'=>'Weekly Fee must be assigned if accepted!',
                    'is_monthly_accepted=YES|monthly_fee'=>'Monthly Fee must be assigned if accepted!',
                    'is_annual_accepted=YES|annual_fee'=>'Annual Fee must be assigned if accepted!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $this->db->update('t_device', $device->getEditableData(), array(
                'id'=>$device->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Device Updated!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

    public function create()
    {
        $device = new Device($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$device,
                'check_empty'=>array(
                    'name'=>'Name required!'
                ),
                'check_numeric'=>array(
                    'lump_fee'=>'Lump Fee must be numeric!',
                    'weekly_fee'=>'Weekly Fee must be numeric!',
                    'monthly_fee'=>'Monthly Fee must be numeric!',
                    'annual_fee'=>'Annual Fee must be numeric!'
                ),
                'check_one_not_empty'=>array(
                    'lump_fee|weekly_fee|monthly_fee|annual_fee'=>'Require at least one pay frequency fee!'
                ),
                'check_empty_on_other'=>array(
                    'is_lump_accepted=YES|lump_fee'=>'Lump Fee must be assigned if accepted!',
                    'is_weekly_accepted=YES|weekly_fee'=>'Weekly Fee must be assigned if accepted!',
                    'is_monthly_accepted=YES|monthly_fee'=>'Monthly Fee must be assigned if accepted!',
                    'is_annual_accepted=YES|annual_fee'=>'Annual Fee must be assigned if accepted!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $deviceModel = $this->db->get_where('t_device', array(
                'name'=>$device->name
            ));
            if($deviceModel->num_rows > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->insert('t_device', $device->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'Device Created!'
                ), FALSE);

            }

        }

        echo $jsonAlert->result();
    }

    public function delete()
    {
        $device = new Device($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$device,
                'check_empty'=>array(
                    'id'=>'Id required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $deviceModel = $this->db->get_where('t_device', array(
                'id'=>$device->id
            ));
            if($deviceModel->num_rows < 1)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Device Not Found!'
                ), TRUE);
            }
            else
            {
                $this->db->delete('t_device', array(
                    'id' => $device->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Device Deleted!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

}