<?php

require_once 'application/class/Service.php';
require_once 'application/class/ServiceDetail.php';
require_once 'util/myutils/JSONAlert.php';

class Service_Rest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function checkout()
    {
        $service = new Service($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$service,
                'check_empty'=>array(
                    'first_name'=>'First Name required!',
                    'last_name'=>'Last Name required!',
                    'company'=>'Company required!',
                    'mobile'=>'Mobile required!',
                    'street'=>'Street required!',
                    'suburb'=>'Suburb required!',
                    'city'=>'City required!',
                    'zip'=>'Zip required!',
                    'email'=>'Email required!'
                ),
                'check_email'=>array(
                    'email'=>'Email format incorrect!'
                ),
                'check_empty_on_other'=>array(
                    'business_type=Other|other_business_type'=>'Must provide a business type if choose Other option!'
                )
            ));
            if($service->is_new_shipping_address == 'YES')
            {
                $jsonAlert->append_batch(array(
                    'model'=>$service,
                    'check_empty'=>array(
                        'shipping_first_name'=>'Shipping First Name required!',
                        'shipping_last_name'=>'Shipping Last Name required!',
                        'shipping_company'=>'Shipping Company required!',
                        'shipping_mobile'=>'Shipping Mobile required!',
                        'shipping_street'=>'Shipping Street required!',
                        'shipping_suburb'=>'Shipping Suburb required!',
                        'shipping_city'=>'Shipping City required!',
                        'shipping_zip'=>'Shipping Zip required!'
                    )
                ));
            }
            else
            {
                $service->shipping_first_name = $service->first_name;
                $service->shipping_last_name = $service->last_name;
                $service->shipping_company = $service->company;
                $service->shipping_mobile = $service->mobile;
                $service->shipping_street = $service->street;
                $service->shipping_suburb = $service->suburb;
                $service->shipping_city = $service->city;
                $service->shipping_zip = $service->zip;
            }
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors)
        {
            $service->status = 'wait_for_payment';
            $service->create_date = date('Y-m-d H:i:s');

            $this->db->insert('t_service', $service->getInsertableData());
            $service_id = $this->db->insert_id();

            $resultService = array(
                'id' => $service_id,
                'total_amount' => $service->total_amount
            );
            $jsonAlert->model = $resultService;

            $plan_ids = explode("^_greenspot_^", $service->plan_ids);
            $device_ids_and_qty = explode("^_greenspot_^", $service->device_ids_and_qty);
            $addon_service_ids = explode("^_greenspot_^", $service->addon_service_ids);
            foreach($plan_ids as $plan_id)
            {
                $planModelQuery = $this->db->get_where('t_plan', array(
                    'id' => $plan_id
                ));
                if($planModelQuery->num_rows > 0)
                {
                    $planModel = $planModelQuery->row_array();

                    $insertableData = array(
                        'service_id' => $service_id,
                        'type_id' => $planModel['id'],
                        'type' => 'plan',
                        'name' => $planModel['name'],
                        'qty' => 1,
                        'pay_frequency' => 'monthly',
                        'lump_fee' => $planModel['lump_fee'],
                        'weekly_fee' => $planModel['weekly_fee'],
                        'monthly_fee' => $planModel['monthly_fee'],
                        'annual_fee' => $planModel['annual_fee'],
                        'last_bill_date' => date('Y-m-d'),
                        'next_bill_date' => date("Y-m-d",strtotime("+1 month"))
                    );

                    $this->db->insert('t_service_detail', $insertableData);
                }
            }

            foreach($device_ids_and_qty as $device_id_and_qty)
            {
                $device_id_and_qty_arr = explode("|", $device_id_and_qty);
                $deviceModelQuery = $this->db->get_where('t_device', array(
                    'id' => $device_id_and_qty_arr[0]
                ));
                if($deviceModelQuery->num_rows > 0)
                {
                    $deviceModel = $deviceModelQuery->row_array();

                    $insertableData = array(
                        'service_id' => $service_id,
                        'type_id' => $deviceModel['id'],
                        'type' => 'device',
                        'name' => $deviceModel['name'],
                        'qty' => $device_id_and_qty_arr[1],
                        'pay_frequency' => 'monthly',
                        'lump_fee' => $deviceModel['lump_fee'],
                        'weekly_fee' => $deviceModel['weekly_fee'],
                        'monthly_fee' => $deviceModel['monthly_fee'],
                        'annual_fee' => $deviceModel['annual_fee'],
                        'last_bill_date' => date('Y-m-d'),
                        'next_bill_date' => date("Y-m-d",strtotime("+1 month"))
                    );

                    $this->db->insert('t_service_detail', $insertableData);
                }

            }

            foreach($addon_service_ids as $addon_service_id)
            {
                $addon_serviceModelQuery = $this->db->get_where('t_addon_service', array(
                    'id' => $addon_service_id
                ));
                if($addon_serviceModelQuery->num_rows > 0)
                {
                    $addon_serviceModel = $addon_serviceModelQuery->row_array();

                    $insertableData = array(
                        'service_id' => $service_id,
                        'type_id' => $addon_serviceModel['id'],
                        'type' => 'addon_service',
                        'name' => $addon_serviceModel['name'],
                        'qty' => $addon_serviceModel[0],
                        'pay_frequency' => 'monthly',
                        'lump_fee' => $addon_serviceModel['lump_fee'],
                        'weekly_fee' => $addon_serviceModel['weekly_fee'],
                        'monthly_fee' => $addon_serviceModel['monthly_fee'],
                        'annual_fee' => $addon_serviceModel['annual_fee'],
                        'last_bill_date' => date('Y-m-d'),
                        'next_bill_date' => date("Y-m-d",strtotime("+1 month"))
                    );

                    $this->db->insert('t_service_detail', $insertableData);
                }
            }


        }
        echo $jsonAlert->result();
    }

}