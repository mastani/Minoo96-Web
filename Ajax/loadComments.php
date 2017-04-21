<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->success = false;
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['id'])) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['id']))
        $error = true;
}

if (!$error) {
    $id = $_POST['id'];

    $cm = $model->query("SELECT *, (SELECT name FROM app_users WHERE comments.user_id = app_users.id) AS name FROM `comments` WHERE `post_id` = ?", array('i', $id));
    $json->comments = $cm;
    $json->success = true;
}

echo json_encode($json);