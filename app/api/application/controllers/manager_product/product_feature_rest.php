<?php

require_once 'application/class/util/Pagination.php';
require_once 'application/class/ProductFeature.php';
require_once 'util/myutils/JSONAlert.php';

class Product_Feature_Rest extends MY_Controller {

    public function __construct()
    {
        parent::__construct('manager');
        $this->load->database();
    }

    public function getResultsPage(){

        $pagination = new Pagination($this->input);

        $this->db->select('id, name, sequence, is_on_home_page');
        $this->db->order_by('sequence asc');

        $this->db->like('name', $pagination->keywords);
        $this->db->or_like('sequence', $pagination->keywords);
        $this->db->or_like('is_on_home_page', $pagination->keywords);

        $productFeatureModel = $this->db->get('t_product_feature');

        echo json_encode($productFeatureModel->result_object());

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

    public function update()
    {
        $productFeature = new ProductFeature($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productFeature,
                'check_empty'=>array(
                    'id'=>'Id required!',
                    'name'=>'Name required!',
                    'sequence'=>'Sequence required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $this->db->update('t_product_feature', $productFeature->getEditableData(), array(
                'id'=>$productFeature->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Product Feature Updated!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

    public function create()
    {
        $productFeature = new ProductFeature($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productFeature,
                'check_empty'=>array(
                    'name'=>'Name required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $productFeatureModel = $this->db->get_where('t_product_feature', array(
                'name'=>$productFeature->name
            ));
            if($productFeatureModel->num_rows > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->select_max('sequence');
                $query = $this->db->get('t_product_feature');
                $productFeature->sequence =  $query->row_array()['sequence']+1;

                $this->db->insert('t_product_feature', $productFeature->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'Product Feature Created!'
                ), FALSE);

            }

        }

        echo $jsonAlert->result();
    }

    public function delete()
    {
        $productFeature = new ProductFeature($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productFeature,
                'check_empty'=>array(
                    'id'=>'Id required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $productFeatureModel = $this->db->get_where('t_product_feature', array(
                'id'=>$productFeature->id
            ));
            if($productFeatureModel->num_rows < 1)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Product Feature Not Found!'
                ), TRUE);
            }
            else
            {
                $this->db->delete('t_product_feature', array(
                    'id' => $productFeature->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product Feature Deleted!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

    public function go_up()
    {
        $productFeature = new ProductFeature($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model' => $productFeature,
                'check_empty' => array(
                    'id' => 'Id required!'
                )
            ));
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

        if(!$jsonAlert->hasErrors) {

            $productFeatureModel = $this->db->get_where('t_product_feature', array(
                'id' => $productFeature->id
            ));
            if($productFeatureModel->num_rows < 1)
            {
                if($productFeatureModel->num_rows < 1)
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Product Feature Not Found!'
                    ), TRUE);
                }
            }
            else
            {
                $currentProductFeatureSequence = $productFeatureModel->row_array()['sequence'];

                $this->db->where('sequence < ',$currentProductFeatureSequence);
                $this->db->order_by('sequence DESC');
                $this->db->limit('1');
                $upperProductFeatureModel = $this->db->get_where('t_product_feature');

                $upperProductFeatureSequence = $upperProductFeatureModel->row_array()['sequence'];

                /**
                 * Update upper Product feature sequence
                 */
                $this->db->update('t_product_feature', array(
                    'sequence' => $currentProductFeatureSequence
                ), array(
                    'id' => $upperProductFeatureModel->row_array()['id']
                ));
                /**
                 * Update current Product feature sequence
                 */
                $this->db->update('t_product_feature', array(
                    'sequence' => $upperProductFeatureSequence
                ), array(
                    'id' => $productFeature->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product Feature Sequence Changed!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

    public function go_down()
    {
        $productFeature = new ProductFeature($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model' => $productFeature,
                'check_empty' => array(
                    'id' => 'Id required!'
                )
            ));
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

        if(!$jsonAlert->hasErrors) {

            $productFeatureModel = $this->db->get_where('t_product_feature', array(
                'id' => $productFeature->id
            ));
            if($productFeatureModel->num_rows < 1)
            {
                if($productFeatureModel->num_rows < 1)
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Product Feature Not Found!'
                    ), TRUE);
                }
            }
            else
            {
                $currentProductFeatureSequence = $productFeatureModel->row_array()['sequence'];

                $this->db->where('sequence > ',$currentProductFeatureSequence);
                $this->db->order_by('sequence ASC');
                $this->db->limit('1');
                $upperProductFeatureModel = $this->db->get_where('t_product_feature');

                $lowerProductFeatureSequence = $upperProductFeatureModel->row_array()['sequence'];

                $lowerProductFeatureModel = $this->db->get_where('t_product_feature', array(
                    'sequence' => $lowerProductFeatureSequence
                ));
                /**
                 * Update current Product feature sequence
                 */
                $this->db->update('t_product_feature', array(
                    'sequence' => $lowerProductFeatureSequence
                ), array(
                    'id' => $productFeature->id
                ));
                /**
                 * Update upper Product feature sequence
                 */
                $this->db->update('t_product_feature', array(
                    'sequence' => $currentProductFeatureSequence
                ), array(
                    'id' => $lowerProductFeatureModel->row_array()['id']
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product Feature Sequence Changed!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

}