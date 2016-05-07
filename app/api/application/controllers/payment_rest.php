<?php

require_once 'application/class/ProductCombo.php';
require_once 'util/myutils/JSONAlert.php';

class Payment_Rest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getFirstThree(){

        $this->db->order_by('sequence asc');
        $this->db->limit(3);

        $productComboModel = $this->db->get('t_product_combo');

        echo json_encode($productComboModel->result_object());

    }

    public function getProductComboAndDetailsById()
    {
        $productCombo = new ProductCombo($this->input);

        $productComboQuery = $this->db->get_where('t_product_combo', array(
            'id'=>$productCombo->id
        ));
        $productComboModel = $productComboQuery->row_array();
        $productComboModel['plans'] = array();

        $plan_ids = $productComboModel['plan_ids'];
        $plan_ids = explode("^_greenspot_^", $plan_ids);
        foreach($plan_ids as $plan_id)
        {
            $planQuery = $this->db->get_where('t_plan', array(
                'id' => $plan_id
            ));
            $planModel = $planQuery->row_array();
            $planModel['devices'] = array();

            $device_ids = $planModel['device_ids'];
            $device_ids = explode("^_greenspot_^", $device_ids);

            if($planModel['device_ids'] != null)
            {
                $planModel['has_device'] = true;
                $planModel['is_changing_plan'] = 'NO';
            }
            else
            {
                $planModel['has_device'] = false;
            }
            foreach($device_ids as $device_id)
            {
                $deviceQuery = $this->db->get_where('t_device', array(
                    'id' => $device_id
                ));
                $deviceModel = $deviceQuery->row_array();
                $deviceModel['qty'] = 1;
                $deviceModel['is_changing_qty'] = 'NO';

                array_push($planModel['devices'], $deviceModel);

            }

            array_push($productComboModel['plans'], $planModel);

        }

        echo json_encode($productComboModel);
    }

    public function getAllPlanHasDevice(){

        $planModel = $this->db->get_where('t_plan', 'device_ids IS NOT NULL');
        $plans = array();
        foreach($planModel->result_object() as $plan)
        {
            $plan->devices = array();

            $device_ids = $plan->device_ids;
            $device_ids = explode("^_greenspot_^", $device_ids);

            if($plan->device_ids != null)
            {
                $plan->has_device = true;
                $plan->is_changing_plan = 'NO';
            }
            else
            {
                $plan->has_device = false;
            }
            foreach($device_ids as $device_id)
            {
                $deviceQuery = $this->db->get_where('t_device', array(
                    'id' => $device_id
                ));
                $deviceModel = $deviceQuery->row_array();
                $deviceModel['qty'] = 1;
                $deviceModel['is_changing_qty'] = 'NO';

                array_push($plan->devices, $deviceModel);

            }

            array_push($plans, $plan);
        }

        echo json_encode($plans);

    }

}