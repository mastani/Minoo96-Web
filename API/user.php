<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->success = false;
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['serial']) ||
    !isset($_POST['model'])
) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['serial']))
        $error = true;
    if (empty($_POST['model']))
        $error = true;
}

if (!$error) {
    $serial = $_POST['serial'];
    $device = $_POST['model'];

    $user = $model->query('SELECT * FROM app_users WHERE serial = ?', array('s', $serial));

    if (count($user) == 0) {
        $model->query('INSERT INTO app_users (name, serial, device) VALUES (?, ?, ?)', array('sss', '', $serial, $device));
        $json->success = true;
        $json->id = $model->db->insert_id;
        $json->name = '';
        $json->serial = $serial;
    } else {
        $json->success = true;
        $json->id = $user[0]['id'];
        $json->name = $user[0]['name'];
        $json->serial = $serial;

        $model->query('UPDATE app_users SET run_num = run_num + 1 WHERE id = ?', array('i', $user[0]['id']));
    }
}

echo json_encode($json);