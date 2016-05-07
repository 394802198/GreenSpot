<?php

require_once 'util/myutils/CIBeanUtil.php';

class Manager extends CIBeanUtil {

    protected $id;
    protected $role;
    protected $account;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $mobile;
    protected $landline;
    protected $authorized_paths;

    // IRRELEVANT FIELDS
    protected $password_confirm;
    protected $new_password;
    protected $original_password;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('password_confirm', 'new_password', 'original_password');
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