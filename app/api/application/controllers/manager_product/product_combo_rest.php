<?php

require_once 'application/class/util/Pagination.php';
require_once 'application/class/ProductCombo.php';
require_once 'util/myutils/JSONAlert.php';

class Product_Combo_Rest extends MY_Controller {

    public function __construct()
    {
        parent::__construct('manager');
        $this->load->database();
    }

    public function getResultsPage(){

        $pagination = new Pagination($this->input);

        $this->db->select('id, name, shipping_fee, fee_on_home_page, pay_frequency_on_home_page, sequence, is_on_home_page, is_on_shelf');
        $this->db->order_by('sequence asc');

        $this->db->like('name', $pagination->keywords);
        $this->db->or_like('sequence', $pagination->keywords);
        $this->db->or_like('is_on_home_page', $pagination->keywords);

        $productComboModel = $this->db->get('t_product_combo');

        echo json_encode($productComboModel->result_object());

    }

    public function getAll(){

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

    public function update()
    {
        $productCombo = new ProductCombo($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productCombo,
                'check_empty'=>array(
                    'id'=>'Id required!',
                    'name'=>'Name required!',
                    'fee_on_home_page'=>'Fee On Home Page required!'
                ),
                'check_numeric'=>array(
                    'fee_on_home_page'=>'Fee On Home Page must be numeric!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $this->db->update('t_product_combo', $productCombo->getEditableData(), array(
                'id'=>$productCombo->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Product Combo Updated!'
            ), FALSE);

        }

        echo $jsonAlert->result();
    }

    public function create()
    {
        $productCombo = new ProductCombo($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productCombo,
                'check_empty'=>array(
                    'name'=>'Name required!',
                    'fee_on_home_page'=>'Fee On Home Page required!'
                ),
                'check_numeric'=>array(
                    'fee_on_home_page'=>'Fee On Home Page must be numeric!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $productComboModel = $this->db->get_where('t_product_combo', array(
                'name'=>$productCombo->name
            ));
            if($productComboModel->num_rows > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->select_max('sequence');
                $query = $this->db->get('t_product_combo');
                $productCombo->sequence =  $query->row_array()['sequence']+1;

                $this->db->insert('t_product_combo', $productCombo->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'Product Combo Created!'
                ), FALSE);

            }

        }

        echo $jsonAlert->result();
    }

    public function delete()
    {
        $productCombo = new ProductCombo($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productCombo,
                'check_empty'=>array(
                    'id'=>'Id required!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!$jsonAlert->hasErrors){

            $productComboModel = $this->db->get_where('t_product_combo', array(
                'id'=>$productCombo->id
            ));
            if($productComboModel->num_rows < 1)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Product Combo Not Found!'
                ), TRUE);
            }
            else
            {
                $this->db->delete('t_product_combo', array(
                    'id' => $productCombo->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product Combo Deleted!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

    public function go_up()
    {
        $productCombo = new ProductCombo($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model' => $productCombo,
                'check_empty' => array(
                    'id' => 'Id required!'
                )
            ));
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

        if(!$jsonAlert->hasErrors) {

            $productComboModel = $this->db->get_where('t_product_combo', array(
                'id' => $productCombo->id
            ));
            if($productComboModel->num_rows < 1)
            {
                if($productComboModel->num_rows < 1)
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Product Combo Not Found!'
                    ), TRUE);
                }
            }
            else
            {
                $currentProductComboSequence = $productComboModel->row_array()['sequence'];

                $this->db->where('sequence < ',$currentProductComboSequence);
                $this->db->order_by('sequence DESC');
                $this->db->limit('1');
                $upperProductComboModel = $this->db->get_where('t_product_combo');

                $upperProductComboSequence = $upperProductComboModel->row_array()['sequence'];

                /**
                 * Update upper Product Combo sequence
                 */
                $this->db->update('t_product_combo', array(
                    'sequence' => $currentProductComboSequence
                ), array(
                    'id' => $upperProductComboModel->row_array()['id']
                ));
                /**
                 * Update current Product Combo sequence
                 */
                $this->db->update('t_product_combo', array(
                    'sequence' => $upperProductComboSequence
                ), array(
                    'id' => $productCombo->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product Combo Sequence Changed!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

    public function go_down()
    {
        $productCombo = new ProductCombo($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model' => $productCombo,
                'check_empty' => array(
                    'id' => 'Id required!'
                )
            ));
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

        if(!$jsonAlert->hasErrors) {

            $productComboModel = $this->db->get_where('t_product_combo', array(
                'id' => $productCombo->id
            ));
            if($productComboModel->num_rows < 1)
            {
                if($productComboModel->num_rows < 1)
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Product Combo Not Found!'
                    ), TRUE);
                }
            }
            else
            {
                $currentProductComboSequence = $productComboModel->row_array()['sequence'];

                $this->db->where('sequence > ',$currentProductComboSequence);
                $this->db->order_by('sequence ASC');
                $this->db->limit('1');
                $upperProductComboModel = $this->db->get_where('t_product_combo');

                $lowerProductComboSequence = $upperProductComboModel->row_array()['sequence'];

                $lowerProductComboModel = $this->db->get_where('t_product_combo', array(
                    'sequence' => $lowerProductComboSequence
                ));
                /**
                 * Update current Product Combo sequence
                 */
                $this->db->update('t_product_combo', array(
                    'sequence' => $lowerProductComboSequence
                ), array(
                    'id' => $productCombo->id
                ));
                /**
                 * Update upper Product Combo sequence
                 */
                $this->db->update('t_product_combo', array(
                    'sequence' => $currentProductComboSequence
                ), array(
                    'id' => $lowerProductComboModel->row_array()['id']
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product Combo Sequence Changed!'
                ), FALSE);
            }

        }

        echo $jsonAlert->result();
    }

}