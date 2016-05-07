<?php

require_once 'application/class/ProductFeature.php';
require_once 'util/myutils/JSONAlert.php';

class Product_Feature_Rest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll(){

        $this->db->order_by('sequence asc');

        $productFeatureModel = $this->db->get('t_product_feature');

        echo json_encode($productFeatureModel->result_object());

    }

    public function getProductFeatureById()
    {
        $productFeature = new ProductFeature($this->input);

        $productFeatureModel = $this->db->get_where('t_product_feature', array(
            'id'=>$productFeature->id
        ));

        echo json_encode($productFeatureModel->row_array());
    }

}