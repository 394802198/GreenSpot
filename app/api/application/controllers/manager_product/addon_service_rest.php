<?php

require_once 'application/class/util/Pagination.php';
require_once 'application/class/AddonService.php';
require_once 'util/myutils/JSONAlert.php';

class Addon_Service_Rest extends MY_Controller {

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

        $addonServiceModel = $this->db->get('t_addon_service');

        echo json_encode($addonServiceModel->result_object());

    }

    public function getAddonServiceById()
    {
        $addonService = new AddonService($this->input);

        $addonServiceModel = $this->db->get_where('t_addon_service', array(
            'id'=>$addonService->id
        ));

        echo json_encode($addonServiceModel->row_array());
    }

    public function update()
    {
        $addonService = new AddonService($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$addonService,
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

            $this->db->update('t_addon_service', $addonService->getEditableData(), array(
                'id'=>$addonService->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Addon Service Updated!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

    public function create()
    {
        $addonService = new AddonService($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$addonService,
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

            $addonServiceModel = $this->db->get_where('t_addon_service', array(
                'name'=>$addonService->name
            ));
            if($addonServiceModel->num_rows > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->insert('t_addon_service', $addonService->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'Addon Service Created!'
                ), FALSE);

            }

        }

        echo $jsonAlert->result();
    }

    public function delete()
    {
        $addonService = new AddonService($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$addonService,
                'check_empty'=>array(
                    'id'=>'Id required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $addonServiceModel = $this->db->get_where('t_addon_service', array(
                'id'=>$addonService->id
            ));
            if($addonServiceModel->num_rows < 1)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Addon Service Not Found!'
                ), TRUE);
            }
            else
            {
                $this->db->delete('t_addon_service', array(
                    'id' => $addonService->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Addon Service Deleted!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

}