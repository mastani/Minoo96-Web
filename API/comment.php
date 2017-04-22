<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['post'])) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['post']))
        $error = true;
}

if (!$error) {
    $post = $_POST['post'];

    $cm = $model->query("SELECT *, (SELECT name FROM app_users WHERE comments.user_id = app_users.id) AS name FROM `comments` WHERE `post_id` = ?", array('i', $post));
    $json->comments = $cm;
}

echo json_encode($json);