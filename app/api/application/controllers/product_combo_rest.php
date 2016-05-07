<?php

require_once 'application/class/ProductCombo.php';
require_once 'util/myutils/JSONAlert.php';

class Product_Combo_Rest extends CI_Controller {

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

    public function getProductComboById()
    {
        $productCombo = new ProductCombo($this->input);

        $productComboModel = $this->db->get_where('t_product_combo', array(
            'id'=>$productCombo->id
        ));

        echo json_encode($productComboModel->row_array());
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
            foreach($device_ids as $device_id)
            {
                $deviceQuery = $this->db->get_where('t_device', array(
                    'id' => $device_id
                ));
                $deviceModel = $deviceQuery->row_array();

                array_push($planModel['devices'], $deviceModel);

            }

            array_push($productComboModel['plans'], $planModel);

        }

        echo json_encode($productComboModel);
    }

}