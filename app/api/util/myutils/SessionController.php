<?php

class SessionController {

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setSession($name, $val)
    {
        $_SESSION[$name] = $val;
    }

    public function getSession($name)
    {
        if(isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
        else
        {
            return NULL;
        }
    }

    public function removeSession($name)
    {
        unset($_SESSION[$name]);
    }

}