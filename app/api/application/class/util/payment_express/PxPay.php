<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 2015/7/22
 * Time: 15:24
 */

require_once 'PxPayConfig.php';
require_once 'GenerateRequest.php';
require_once 'ProcessResponse.php';
require_once 'Request.php';
require_once 'Response.php';

class PxPay
{
    private $response;
    private $responseArray;
    private $request;

    static $REQUEST_INPUT = 'REQUEST_INPUT';
    static $RESPONSE_INPUT = 'RESPONSE_INPUT';

    // A quick helper function to handle background posts to DPS using cURL
    public function doCurl($content, $input_type) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PxPayConfig::$PxPayUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $responseXML = new SimpleXMLElement(curl_exec($ch));

        if($responseXML['valid']==TRUE)
        {
            switch($input_type)
            {
                case PxPay::$REQUEST_INPUT :
                    $this->request = new Request();
                    $this->request->setValid($responseXML['valid']);
                    $this->request->setUri($responseXML->URI);
                    break;
                case PxPay::$RESPONSE_INPUT :
                    $this->response = new Response();
                    $this->response->setValid($responseXML['valid']);
                    $this->response->setAmountSettlement($responseXML->AmountSettlement);
                    $this->response->setAuthCode($responseXML->AuthCode);
                    $this->response->setCardName($responseXML->CardName);
                    $this->response->setCardNumber($responseXML->CardNumber);
                    $this->response->setDateExpiry($responseXML->DateExpiry);
                    $this->response->setDpsTxnRef($responseXML->DpsTxnRef);
                    $this->response->setSuccess($responseXML->Success);
                    $this->response->setResponseText($responseXML->ResponseText);
                    $this->response->setDpsBillingId($responseXML->DpsBillingId);
                    $this->response->setCardHolderName($responseXML->CardHolderName);
                    $this->response->setCurrencySettlement($responseXML->CurrencySettlement);
                    $this->response->setTxnData1($responseXML->TxnData1);
                    $this->response->setTxnData2($responseXML->TxnData2);
                    $this->response->setTxnData3($responseXML->TxnData3);
                    $this->response->setTxnType($responseXML->TxnType);
                    $this->response->setCurrencyInput($responseXML->CurrencyInput);
                    $this->response->setMerchantReference($responseXML->MerchantReference);
                    $this->response->setClientInfo($responseXML->ClientInfo);
                    $this->response->setTxnId($responseXML->TxnId);
                    $this->response->setEmailAddress($responseXML->EmailAddress);
                    $this->response->setBillingId($responseXML->BillingId);
                    $this->response->setTxnMac($responseXML->TxnMac);
                    $this->response->setCardNumber2($responseXML->CardNumber2);
                    $this->response->setDateSettlement($responseXML->DateSettlement);
                    $this->response->setIssuerCountryId($responseXML->IssuerCountryId);
                    $this->response->setCvc2ResultCode($responseXML->Cvc2ResultCode);
                    $this->response->setReCo($responseXML->ReCo);
                    $this->response->setProductSku($responseXML->ProductSku);
                    $this->response->setShippingName($responseXML->ShippingName);
                    $this->response->setShippingAddress($responseXML->ShippingAddress);
                    $this->response->setShippingPostalCode($responseXML->ShippingPostalCode);
                    $this->response->setShippingPhoneNumber($responseXML->ShippingPhoneNumber);
                    $this->response->setShippingMethod($responseXML->ShippingMethod);
                    $this->response->setBillingName($responseXML->BillingName);
                    $this->response->setBillingPostalCode($responseXML->BillingPostalCode);
                    $this->response->setBillingAddress($responseXML->BillingAddress);
                    $this->response->setBillingPhoneNumber($responseXML->BillingPhoneNumber);
                    $this->response->setPhoneNumber($responseXML->PhoneNumber);
                    $this->response->setAccountInfo($responseXML->AccountInfo);

                    $responseArray = array(
                        'valid'                     => $responseXML['valid']==TRUE ? 'YES' : 'NO',
                        'amount_settlement'         => (string) $responseXML->AmountSettlement,
                        'auth_code'                 => (string) $responseXML->AuthCode,
                        'card_name'                 => (string) $responseXML->CardName,
                        'card_number'               => (string) $responseXML->CardNumber,
                        'date_expiry'               => (string) $responseXML->DateExpiry,
                        'dps_txn_ref'               => (string) $responseXML->DpsTxnRef,
                        'success'                   => $responseXML->Success==TRUE ? 'YES' : 'NO',
                        'response_text'             => (string) $responseXML->ResponseText,
                        'dps_billing_id'            => (string) $responseXML->DpsBillingId,
                        'card_holder_name'          => (string) $responseXML->CardHolderName,
                        'currency_settlement'       => (string) $responseXML->CurrencySettlement,
                        'txn_data1'                 => (string) $responseXML->TxnData1,
                        'txn_data2'                 => (string) $responseXML->TxnData2,
                        'txn_data3'                 => (string) $responseXML->TxnData3,
                        'txn_type'                  => (string) $responseXML->TxnType,
                        'currency_input'            => (string) $responseXML->CurrencyInput,
                        'merchant_reference'        => (string) $responseXML->MerchantReference,
                        'client_info'               => (string) $responseXML->ClientInfo,
                        'txn_id'                    => (string) $responseXML->TxnId,
                        'email_address'             => (string) $responseXML->EmailAddress,
                        'billing_id'                => (string) $responseXML->BillingId,
                        'txn_mac'                   => (string) $responseXML->TxnMac,
                        'card_number2'              => (string) $responseXML->CardNumber2,
                        'date_settlement'           => (string) $responseXML->DateSettlement,
                        'issuer_country_id'         => (string) $responseXML->IssuerCountryId,
                        'cvc_2_result_code'         => (string) $responseXML->Cvc2ResultCode,
                        're_co'                     => (string) $responseXML->ReCo
                    );

                    $this->setResponseArray($responseArray);

                    break;
            }
        }
        else
        {
            switch($input_type)
            {
                case PxPay::$REQUEST_INPUT :
                    $this->request = new Request();
                    $this->request->setValid($responseXML['valid']);
                    break;
                case PxPay::$RESPONSE_INPUT :
                    $this->response = new Response();
                    $this->response->setValid($responseXML['valid']);
                    break;
            }
        }

        if (curl_errno($ch) != 0) {
            $error = curl_error($ch) . " (cURL error # " . curl_errno($ch) . ")";
            curl_close($ch);
            exit($error);
        }
        else {
            curl_close ($ch);
        }
    }

    public function doRequestInputCurl($content)
    {
        $this->doCurl($content, PxPay::$REQUEST_INPUT);
    }

    public function doResponseInputCurl($content)
    {
        $this->doCurl($content, PxPay::$RESPONSE_INPUT);
    }

    public function postRequest($detail)
    {
        /*
         * GenerateRequest (Input XML Document)
         */
        $generateRequest = new GenerateRequest();

        $generateRequest->setAmountInput($detail['amountInput']);
        $generateRequest->setMerchantReference($detail['merchantReference']);
        $generateRequest->setTxnData1($detail['txnData1']);
        $generateRequest->setTxnData2($detail['txnData2']);
        $generateRequest->setTxnData3($detail['txnData3']);
        $generateRequest->setUrlSuccess($detail['urlSuccess']);
        $generateRequest->setUrlFail($detail['urlFail']);

        /*
         * Request (Output XML Document)
         */
        $this->doRequestInputCurl($generateRequest->buildXML());
        $request = $this->getRequest();

        if($request->isValid())
        {
            redirect($request->getUri());
        }
    }

    public function postResponse()
    {
        // Step 1: Grab the encrypted transaction result that DPS would append to this page
        $result = isset($_GET['result']) ? (string) $_GET['result'] : FALSE;
        if ( ! $result)
        {
            die('This page expected to receive an encrypted transaction result.');
        }
        else
        {
            /*
             * ProcessResponse (Input XML Document)
             */
            $processResponse = new ProcessResponse();
            $processResponse->setResponse($result);

            /*
             * Response (Output XML Document)
             */
            $this->doResponseInputCurl($processResponse->buildXML());
        }
    }


    /**
     * Getter Setter
     */
    public function getResponse()
    {
        return $this->response;
    }
    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getRequest()
    {
        return $this->request;
    }
    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getResponseArray()
    {
        return $this->responseArray;
    }
    public function setResponseArray($responseArray)
    {
        $this->responseArray = $responseArray;
    }

}