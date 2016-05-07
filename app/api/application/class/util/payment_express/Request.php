<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 5/08/2015
 * Time: 12:01 PM
 */

class Request
{
    private $valid;
    private $uri;

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
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