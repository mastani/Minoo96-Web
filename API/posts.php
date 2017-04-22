<?php
require_once 'loader.php';

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->posts = $model->query('SELECT *, (SELECT count(*) FROM likes WHERE posts.id = likes.post_id) As likes FROM posts');
echo json_encode($json);