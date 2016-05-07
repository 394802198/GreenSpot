<?php

require_once 'util/myutils/CIBeanUtil.php';

class Service extends CIBeanUtil {

    protected $id;
    protected $create_date;
    protected $total_amount;
    protected $first_name;
    protected $last_name;
    protected $company;
    protected $mobile;
    protected $street;
    protected $suburb;
    protected $city;
    protected $zip;
    protected $email;
    protected $business_type;
    protected $other_business_type;
    protected $is_new_shipping_address;
    protected $shipping_fee;
    protected $shipping_first_name;
    protected $shipping_last_name;
    protected $shipping_company;
    protected $shipping_mobile;
    protected $shipping_street;
    protected $shipping_suburb;
    protected $shipping_city;
    protected $shipping_zip;
    protected $plan_ids;
    protected $device_ids_and_qty;
    protected $addon_service_ids;
    protected $status;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('');
//        $config['int_fields']=array('id','level');
        parent::__construct($input, $this, $config);
    
    }
    
    function __get($property_name) {
        if (isset($this->$property_name)) {
            return ($this->$property_name);
        } else {
            return NULL;
        }
    }
    
    function __set($property_name, $value) {
        $this->$property_name = $value;
    }
    
    
}