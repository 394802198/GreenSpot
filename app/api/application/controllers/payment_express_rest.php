<?php

require_once 'application/class/util/payment_express/PxPay.php';
require_once 'util/myutils/JSONAlert.php';

class Payment_Express_Rest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->pxPay = new PxPay();
    }

    public function make_payment_service($id, $total_amount)
    {
        // Step 1: Grab the encrypted transaction result that DPS would append to this page
        $id = isset($id) ? (string) $id : FALSE;
        $total_amount = isset($total_amount) ? $total_amount : FALSE;

        if ( ! $id && ! $total_amount)
        {
            die('This page expected to receive an encrypted transaction result.');
        }
        else
        {
            $detail = array(
                'amountInput'           => $total_amount,
                'merchantReference'     => 'Service Payment',
                'txnData1'              => $id,
                'urlSuccess'            => 'http://www.greenspot.net.nz/api/payment_express_rest/payment_success/service',
                'urlFail'               => 'http://www.greenspot.net.nz/api/payment_express_rest/payment_fail/service'
            );

            $this->pxPay->postRequest($detail);
        }

    }

    public function payment_success($type)
    {
        $this->pxPay->postResponse();

        if($this->pxPay->getResponse()->isValid())
        {
            switch($type)
            {
                case "service":
                    $where = array(
                        'txn_id' => (string) $this->pxPay->getResponse()->getTxnId()
                    );
                    $query = $this->db->get_where('t_dps_response', $where);
                    /**
                     * If existed then do nothing, Else insert transaction and continue
                     */
                    if($query->num_rows > 0)
                    {

                    }
                    else
                    {
                        $responseArray = $this->pxPay->getResponseArray();

                        $this->db->update('t_service',array(
                            'status' => 'payed'
                        ), array(
                            'id' => $responseArray['txn_data1']
                        ));

                        $this->db->insert('t_dps_response', $responseArray);
                    }
                    break;
            }
        }

        $this->load->view('payment_success');
    }

    public function payment_fail($type)
    {
        // Step 1: Grab the encrypted transaction result that DPS would append to this page
        $result = isset($_GET['result']) ? (string) $_GET['result'] : FALSE;
        if ( ! $result)
        {
            die('This page expected to receive an encrypted transaction result.');
        }
        else
        {
            if($type=="order")
            {
                var_dump($result);
            }
        }

        $this->load->view('payment_fail');
    }

}