<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->success = false;
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['post']) ||
    !isset($_POST['user'])
) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['post']))
        $error = true;
    if (empty($_POST['user']))
        $error = true;
}

if (!$error) {
    $post = $_POST['post'];
    $user = $_POST['user'];

    $like = $model->query("SELECT id FROM likes WHERE post_id = ? AND user_id = ?", array('ii', $post, $user));
    if (count($like) == 0) {
        $model->query("INSERT INTO likes (post_id, user_id) VALUES (?, ?)", array('ii', $post, $user));
    }

    $json->success = true;
}

echo json_encode($json);