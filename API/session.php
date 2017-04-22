<?php
require_once 'loader.php';

$json = new stdClass();
$json->success = false;
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['sessid'])) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['sessid']))
        $error = true;
}

if (!$error) {
    $sessid = $_POST['sessid'];

    $result = $model->query('SELECT * FROM app_auth WHERE sess_id = ?', array('s', $sessid));
    if (count($result) > 0) {
        $user = $model->query('SELECT * FROM users WHERE id = ?', array('i', $result[0]['user_id']));

        $json->success = true;
        unset($user[0]['password']);
        $json->user = $user;
    }
}

echo json_encode($json);