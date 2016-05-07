<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 5/08/2015
 * Time: 11:23 AM
 */

require_once 'PxPayConfig.php';

class ProcessResponse
{
    private $PxPayUserId = "";
    private $PxPayKey = "";
    private $Response = "";

    private function notNullAndEmpty($val)
    {
        return $val!=null && $val!="";
    }

    public function buildXML()
    {
        // Prepare data for DPS (array keys use DPS naming convention)
        $xml['PxPayUserId']         = $this->notNullAndEmpty($this->getPxPayUserId()) ? $this->getPxPayUserId() : PxPayConfig::$PxPayUserId;
        $xml['PxPayKey']            = $this->notNullAndEmpty($this->getPxPayKey()) ? $this->getPxPayKey() : PxPayConfig::$PxPayKey;
        $xml['Response']            = $this->getResponse();

        // Build <ProcessResponse> XML
        $process_response = new SimpleXmlElement("<ProcessResponse></ProcessResponse>");
        foreach ($xml as $element => $value) {
            if($value!=null || $value===0)
            {
                $process_response->addChild($element, $value);
            }
        }
        $t_xml = new DOMDocument();
        $t_xml->loadXML($process_response->asXML());
        $xml_out = $t_xml->saveXML($t_xml->documentElement);

        return $xml_out;

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
    public function getResponse()
    {
        return $this->Response;
    }

    /**
     * @param string $Response
     */
    public function setResponse($Response)
    {
        $this->Response = $Response;
    }



}