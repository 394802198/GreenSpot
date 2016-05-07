<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 2015/7/22
 * Time: 15:24
 */

require_once 'PxPayConfig.php';

class GenerateRequest
{
    private $PxPayUserId = "";
    private $PxPayKey = "";
    private $AmountInput = "";
    private $CurrencyInput = "";
    private $MerchantReference = "";
    private $EmailAddress = "";
    private $TxnData1 = "";
    private $TxnData2 = "";
    private $TxnData3 = "";
    private $TxnType = "";
    private $TxnId = "";
    private $BillingId = "";
    private $EnableAddBillCard = "";
    private $UrlSuccess = "";
    private $UrlFail = "";
    private $Opt = "";

    private function notNullAndEmpty($val)
    {
        return $val!=null && $val!="";
    }

    public function buildXML()
    {
        // Prepare data for DPS (array keys use DPS naming convention)
        $xml['PxPayUserId']         = $this->notNullAndEmpty($this->getPxPayUserId()) ? $this->getPxPayUserId() : PxPayConfig::$PxPayUserId;
        $xml['PxPayKey']            = $this->notNullAndEmpty($this->getPxPayKey()) ? $this->getPxPayKey() : PxPayConfig::$PxPayKey;
        $xml['AmountInput'] 		= $this->getAmountInput();
        $xml['CurrencyInput'] 		= $this->notNullAndEmpty($this->getCurrencyInput()) ? $this->getCurrencyInput() : "NZD";
        $xml['MerchantReference'] 	= $this->getMerchantReference(); // order_id
        $xml['EmailAddress'] 		= $this->getEmailAddress();
        $xml['TxnData1'] 			= $this->getTxnData1(); # order_id important! (used to find transaction in db when customer returns from hosted payment page)
        $xml['TxnData2'] 			= $this->getTxnData2(); // payment_firstname. ' ' . payment_lastname
        $xml['TxnData3'] 			= $this->getTxnData3(); // telephone
        $xml['TxnType']				= $this->notNullAndEmpty($this->getTxnType()) ? $this->getTxnType() : "Purchase"; // dps_pxpay_txn_type
        $xml['BillingId'] 			= $this->getBillingId();
        $xml['EnableAddBillCard'] 	= $this->notNullAndEmpty($this->getEnableAddBillCard()) ? $this->getEnableAddBillCard() : 0;
        $xml['TxnId'] 				= substr(rand(1000,9999) . uniqid(), 0, 16);
        $xml['UrlSuccess']			= $this->getUrlSuccess(); // HTTPS_SERVER . 'dps_return.php'
        $xml['UrlFail']				= $this->getUrlFail(); // HTTPS_SERVER . 'dps_return.php'
        $xml['Opt']				    = $this->getOpt();

        // Build <GenerateRequest> XML
        $generate_request = new SimpleXmlElement("<GenerateRequest></GenerateRequest>");
        foreach ($xml as $element => $value) {
            if($value!=null || $value===0)
            {
                $generate_request->addChild($element, $value);
            }
        }
        $t_xml = new DOMDocument();
        $t_xml->loadXML($generate_request->asXML());
        $xml_out = $t_xml->saveXML($t_xml->documentElement);

        return $xml_out;
    }

    /**
     * @return string
     */
    public function getPxPayUserId()
    {
        return $this->PxPayUserId;
    }

    /**
     * @param string $PxPayUserId
     */
    public function setPxPayUserId($PxPayUserId)
    {
        $this->PxPayUserId = $PxPayUserId;
    }

    /**
     * @return string
     */
    public function getPxPayKey()
    {
        return $this->PxPayKey;
    }

    /**
     * @param string $PxPayKey
     */
    public function setPxPayKey($PxPayKey)
    {
        $this->PxPayKey = $PxPayKey;
    }

    /**
     * @return string
     */
    public function getAmountInput()
    {
        return $this->AmountInput;
    }

    /**
     * @param string $AmountInput
     */
    public function setAmountInput($AmountInput)
    {
        $this->AmountInput = $AmountInput;
    }

    /**
     * @return string
     */
    public function getCurrencyInput()
    {
        return $this->CurrencyInput;
    }

    /**
     * @param string $CurrencyInput
     */
    public function setCurrencyInput($CurrencyInput)
    {
        $this->CurrencyInput = $CurrencyInput;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->MerchantReference;
    }

    /**
     * @param string $MerchantReference
     */
    public function setMerchantReference($MerchantReference)
    {
        $this->MerchantReference = $MerchantReference;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->EmailAddress;
    }

    /**
     * @param string $EmailAddress
     */
    public function setEmailAddress($EmailAddress)
    {
        $this->EmailAddress = $EmailAddress;
    }

    /**
     * @return string
     */
    public function getTxnData1()
    {
        return $this->TxnData1;
    }

    /**
     * @param string $TxnData1
     */
    public function setTxnData1($TxnData1)
    {
        $this->TxnData1 = $TxnData1;
    }

    /**
     * @return string
     */
    public function getTxnData2()
    {
        return $this->TxnData2;
    }

    /**
     * @param string $TxnData2
     */
    public function setTxnData2($TxnData2)
    {
        $this->TxnData2 = $TxnData2;
    }

    /**
     * @return string
     */
    public function getTxnData3()
    {
        return $this->TxnData3;
    }

    /**
     * @param string $TxnData3
     */
    public function setTxnData3($TxnData3)
    {
        $this->TxnData3 = $TxnData3;
    }

    /**
     * @return string
     */
    public function getTxnType()
    {
        return $this->TxnType;
    }

    /**
     * @param string $TxnType
     */
    public function setTxnType($TxnType)
    {
        $this->TxnType = $TxnType;
    }

    /**
     * @return string
     */
    public function getTxnId()
    {
        return $this->TxnId;
    }

    /**
     * @param string $TxnId
     */
    public function setTxnId($TxnId)
    {
        $this->TxnId = $TxnId;
    }

    /**
     * @return string
     */
    public function getBillingId()
    {
        return $this->BillingId;
    }

    /**
     * @param string $BillingId
     */
    public function setBillingId($BillingId)
    {
        $this->BillingId = $BillingId;
    }

    /**
     * @return string
     */
    public function getEnableAddBillCard()
    {
        return $this->EnableAddBillCard;
    }

    /**
     * @param string $EnableAddBillCard
     */
    public function setEnableAddBillCard($EnableAddBillCard)
    {
        $this->EnableAddBillCard = $EnableAddBillCard;
    }

    /**
     * @return string
     */
    public function getUrlSuccess()
    {
        return $this->UrlSuccess;
    }

    /**
     * @param string $UrlSuccess
     */
    public function setUrlSuccess($UrlSuccess)
    {
        $this->UrlSuccess = $UrlSuccess;
    }

    /**
     * @return string
     */
    public function getUrlFail()
    {
        return $this->UrlFail;
    }

    /**
     * @param string $UrlFail
     */
    public function setUrlFail($UrlFail)
    {
        $this->UrlFail = $UrlFail;
    }

    /**
     * @return string
     */
    public function getOpt()
    {
        return $this->Opt;
    }

    /**
     * @param string $Opt
     */
    public function setOpt($Opt)
    {
        $this->Opt = $Opt;
    }
}