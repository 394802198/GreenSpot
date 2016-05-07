<?php

require_once 'util/myutils/CIBeanUtil.php';

class AddonService extends CIBeanUtil {

    protected $id;
    protected $brief_description;
    protected $name;
    protected $lump_fee;
    protected $weekly_fee;
    protected $monthly_fee;
    protected $annual_fee;
    protected $is_lump_accepted;
    protected $is_weekly_accepted;
    protected $is_monthly_accepted;
    protected $is_annual_accepted;
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