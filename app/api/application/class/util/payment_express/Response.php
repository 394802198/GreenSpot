<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 5/08/2015
 * Time: 12:28 PM
 */
class Response
{
    private $valid;
    private $amountSettlement;
    private $authCode;
    private $cardName;
    private $cardNumber;
    private $dateExpiry;
    private $dpsTxnRef;
    private $success;
    private $responseText;
    private $dpsBillingId;
    private $cardHolderName;
    private $currencySettlement;
    private $txnData1;
    private $txnData2;
    private $txnData3;
    private $txnType;
    private $currencyInput;
    private $merchantReference;
    private $clientInfo;
    private $txnId;
    private $emailAddress;
    private $billingId;
    private $txnMac;
    private $cardNumber2;
    private $dateSettlement;
    private $issuerCountryId;
    private $cvc2ResultCode;
    private $reCo;
    private $productSku;
    private $shippingName;
    private $shippingAddress;
    private $shippingPostalCode;
    private $shippingPhoneNumber;
    private $shippingMethod;
    private $billingName;
    private $billingPostalCode;
    private $billingAddress;
    private $billingPhoneNumber;
    private $phoneNumber;
    private $accountInfo;

    public function getAccountInfo()
    {
        return $this->accountInfo;
    }
    public function setAccountInfo($accountInfo)
    {
        $this->accountInfo = $accountInfo;
    }

    public function getAmountSettlement()
    {
        return $this->amountSettlement;
    }
    public function setAmountSettlement($amountSettlement)
    {
        $this->amountSettlement = $amountSettlement;
    }

    public function getAuthCode()
    {
        return $this->authCode;
    }
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    public function getBillingId()
    {
        return $this->billingId;
    }
    public function setBillingId($billingId)
    {
        $this->billingId = $billingId;
    }

    public function getBillingName()
    {
        return $this->billingName;
    }
    public function setBillingName($billingName)
    {
        $this->billingName = $billingName;
    }

    public function getBillingPhoneNumber()
    {
        return $this->billingPhoneNumber;
    }
    public function setBillingPhoneNumber($billingPhoneNumber)
    {
        $this->billingPhoneNumber = $billingPhoneNumber;
    }

    public function getBillingPostalCode()
    {
        return $this->billingPostalCode;
    }
    public function setBillingPostalCode($billingPostalCode)
    {
        $this->billingPostalCode = $billingPostalCode;
    }

    public function getCardHolderName()
    {
        return $this->cardHolderName;
    }
    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;
    }

    public function getCardName()
    {
        return $this->cardName;
    }
    public function setCardName($cardName)
    {
        $this->cardName = $cardName;
    }

    public function getCardNumber()
    {
        return $this->cardNumber;
    }
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    public function getCardNumber2()
    {
        return $this->cardNumber2;
    }
    public function setCardNumber2($cardNumber2)
    {
        $this->cardNumber2 = $cardNumber2;
    }

    public function getClientInfo()
    {
        return $this->clientInfo;
    }
    public function setClientInfo($clientInfo)
    {
        $this->clientInfo = $clientInfo;
    }

    public function getCurrencyInput()
    {
        return $this->currencyInput;
    }
    public function setCurrencyInput($currencyInput)
    {
        $this->currencyInput = $currencyInput;
    }

    public function getCurrencySettlement()
    {
        return $this->currencySettlement;
    }
    public function setCurrencySettlement($currencySettlement)
    {
        $this->currencySettlement = $currencySettlement;
    }

    public function getCvc2ResultCode()
    {
        return $this->cvc2ResultCode;
    }
    public function setCvc2ResultCode($cvc2ResultCode)
    {
        $this->cvc2ResultCode = $cvc2ResultCode;
    }

    public function getDateExpiry()
    {
        return $this->dateExpiry;
    }
    public function setDateExpiry($dateExpiry)
    {
        $this->dateExpiry = $dateExpiry;
    }

    public function getDateSettlement()
    {
        return $this->dateSettlement;
    }
    public function setDateSettlement($dateSettlement)
    {
        $this->dateSettlement = $dateSettlement;
    }

    public function getDpsBillingId()
    {
        return $this->dpsBillingId;
    }
    public function setDpsBillingId($dpsBillingId)
    {
        $this->dpsBillingId = $dpsBillingId;
    }

    public function getDpsTxnRef()
    {
        return $this->dpsTxnRef;
    }
    public function setDpsTxnRef($dpsTxnRef)
    {
        $this->dpsTxnRef = $dpsTxnRef;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getIssuerCountryId()
    {
        return $this->issuerCountryId;
    }
    public function setIssuerCountryId($issuerCountryId)
    {
        $this->issuerCountryId = $issuerCountryId;
    }

    public function getMerchantReference()
    {
        return $this->merchantReference;
    }
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getProductSku()
    {
        return $this->productSku;
    }
    public function setProductSku($productSku)
    {
        $this->productSku = $productSku;
    }

    public function getReCo()
    {
        return $this->reCo;
    }
    public function setReCo($reCo)
    {
        $this->reCo = $reCo;
    }

    public function getResponseText()
    {
        return $this->responseText;
    }
    public function setResponseText($responseText)
    {
        $this->responseText = $responseText;
    }

    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    }

    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    public function getShippingName()
    {
        return $this->shippingName;
    }
    public function setShippingName($shippingName)
    {
        $this->shippingName = $shippingName;
    }

    public function getShippingPhoneNumber()
    {
        return $this->shippingPhoneNumber;
    }
    public function setShippingPhoneNumber($shippingPhoneNumber)
    {
        $this->shippingPhoneNumber = $shippingPhoneNumber;
    }

    public function getShippingPostalCode()
    {
        return $this->shippingPostalCode;
    }
    public function setShippingPostalCode($shippingPostalCode)
    {
        $this->shippingPostalCode = $shippingPostalCode;
    }

    public function getSuccess()
    {
        return $this->success;
    }
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getTxnData1()
    {
        return $this->txnData1;
    }
    public function setTxnData1($txnData1)
    {
        $this->txnData1 = $txnData1;
    }

    public function getTxnData2()
    {
        return $this->txnData2;
    }
    public function setTxnData2($txnData2)
    {
        $this->txnData2 = $txnData2;
    }

    public function getTxnData3()
    {
        return $this->txnData3;
    }
    public function setTxnData3($txnData3)
    {
        $this->txnData3 = $txnData3;
    }

    public function getTxnId()
    {
        return $this->txnId;
    }
    public function setTxnId($txnId)
    {
        $this->txnId = $txnId;
    }

    public function getTxnMac()
    {
        return $this->txnMac;
    }
    public function setTxnMac($txnMac)
    {
        $this->txnMac = $txnMac;
    }

    public function getTxnType()
    {
        return $this->txnType;
    }
    public function setTxnType($txnType)
    {
        $this->txnType = $txnType;
    }

    public function isValid()
    {
        return $this->valid;
    }
    public function setValid($valid)
    {
        $this->valid = $valid;
    }
}