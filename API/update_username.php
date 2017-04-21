<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['user']) ||
    !isset($_POST['name'])
) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['user']))
        $error = true;
    if (empty($_POST['name']))
        $error = true;
}

if (!$error) {
    $user = $_POST['user'];
    $name = $_POST['name'];

    $model->query("UPDATE app_users SET name = ? WHERE id = ?", array('si', $name, $user));
}

echo json_encode($json);