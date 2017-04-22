<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');

$error = false;

if (!isset($_POST['post']) ||
    !isset($_POST['content']) ||
    !isset($_POST['user'])
) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['post']))
        $error = true;
    if (empty($_POST['content']))
        $error = true;
    if (empty($_POST['user']))
        $error = true;
}

if (!$error) {
    $post = $_POST['post'];
    $content = $_POST['content'];
    $user = $_POST['user'];

    $cm = $model->query("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)", array('iis', $post, $user, $content));
}

echo json_encode($json);