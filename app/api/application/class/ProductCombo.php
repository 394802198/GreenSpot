<?php

require_once 'util/myutils/CIBeanUtil.php';

class ProductCombo extends CIBeanUtil {

    protected $id;
    protected $plan_ids;
    protected $feature_ids;
    protected $shipping_fee;
    protected $name;
    protected $fee_on_home_page;
    protected $pay_frequency_on_home_page;
    protected $is_on_home_page;
    protected $sequence;
    protected $is_on_shelf;
    
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