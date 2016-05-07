<?php

require_once 'util/myutils/CIBeanUtil.php';

class ServiceDetail extends CIBeanUtil {

    protected $id;
    protected $service_id;
    protected $type_id;
    protected $type;
    protected $name;
    protected $qty;
    protected $pay_frequency;
    protected $lump_fee;
    protected $weekly_fee;
    protected $monthly_fee;
    protected $annual_fee;
    protected $last_bill_date;
    protected $next_bill_date;
    protected $days_beforehand;
    protected $days_postpone;
    protected $beforehand_or_normal_or_postpone;

    function __construct($input=NULL) {

        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('');
        $config['int_fields']=array('id','type_id');
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