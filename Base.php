<?php
defined('ACCESS') or die(header('HTTP/1.1 403 Forbidden'));

class BaseController {
    static $page;
    var $smarty;
    var $session;
    var $model;
    var $config;

    public function __construct() {
        $this->smarty = new Smarty;
        $this->session = new Sessions();
        $this->model = NULL;
        $this->config = NULL;

        if( file_exists('Modules/'.self::$page.'/Model.php') ) {
            require 'Modules/'.self::$page.'/Model.php';
            $this->model = new Model();
        }

        if( file_exists('Modules/'.self::$page.'/Config.php') ) {
            require 'Modules/'.self::$page.'/Config.php';
            $this->config = new Config();
        }
    }

    public function render($view = 'View') {
        $this->smarty->display('Modules/'.self::$page.'/'.$view.'.tpl');
    }

    public function hasPermission($permission) {
        switch($permission) {
            case 'admin':

                break;
            case 'user':
                if( $this->session->get('user_id') ) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'guest':
                if( $this->session->get('user_id') ) {
                    return false;
                } else {
                    return true;
                }
                break;
        }
    }

    public static function loadLibrary($library) {
        switch ($library) {
            case 'Jalali':
                require 'Libraries/Jalali/jdf.php';
                break;
        }
    }
}

class BaseModel {
    var $db;

    public function __construct() {

    }

    private function prepare_database() {
        if (isset($this->db)) return;

        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

        /* check connection */
        if ($this->db->connect_errno) {
            printf("Connect failed: %s\n", $this->db->connect_error);
            exit();
        }

        $this->db->set_charset("utf8");
    }

    public function query($sql, $params = array(), $execution_result = false) {
        $this->prepare_database();
        $stmt = $this->db->prepare($sql);

        if( count($params) > 0 ) {
            $tmp = array();
            foreach($params as $key => $value) $tmp[$key] = &$params[$key];
            call_user_func_array(array($stmt, 'bind_param'), $tmp);
        }

        $exe_res = $stmt->execute();

        if($execution_result) {
            $stmt->close();
            return $exe_res;
        }

        $res = $this->get_result($stmt);

        $a_data = $res;

//        if( count($res) > 0 ) {
//            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
//                $a_data[] = $row;
//            }
//        }

        $stmt->close();

        return $a_data;
    }

    function get_result( $Statement ) {
        $RESULT = array();
        $Statement->store_result();
        for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
            $Metadata = $Statement->result_metadata();
            $PARAMS = array();
            while ( $Field = $Metadata->fetch_field() ) {
                $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
            }
            call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
            $Statement->fetch();
        }
        return $RESULT;
    }

    public function visit_log($action)
    {
        $this->query(
            'INSERT INTO visit_log (session_id, ip, user_agent, action) VALUES (?, ?, ?, ?)'
            , array('ssss', session_id(), get_user_ip(), $_SERVER['HTTP_USER_AGENT'], $action), true
        );
    }
}

function getAddress() {
    return 'http://'.$_SERVER['HTTP_HOST'].DEFAULT_PATH;
}

function get_user_ip()
{
    if (!empty($_SERVER['REMOTE_ADDR']))
        return $_SERVER['REMOTE_ADDR'];
    else
        return '0.0.0.0';
}
