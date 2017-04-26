<?php
defined('ACCESS') or die(header('HTTP/1.1 403 Forbidden'));

class Sessions extends BaseModel {
    public function __construct() {
        parent::__construct();

        session_start();

        if (!isset($_SESSION['welcome']))
        {
            $_SESSION['welcome'] = true;
            $this->visit_log('First visit');
        }
    }

    public function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    public function destroy()
    {
        session_destroy();
    }

}