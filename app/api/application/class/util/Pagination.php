<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 2015/7/22
 * Time: 15:24
 */

require_once 'util/myutils/CIBeanUtil.php';

class Pagination extends CIBeanUtil {
    protected $keywords;
    protected $pageSize;
    protected $currentPage;
    protected $manager;

    function __construct($input=NULL) {

//        $config['auto_increment']=array('id');
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