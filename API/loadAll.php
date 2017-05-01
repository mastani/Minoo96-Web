<?php
require_once 'loader.php';

$user_id = 0;
if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
}

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->news = $model->query('SELECT * FROM news ORDER BY id DESC LIMIT 10');
$json->candidates = $model->query('SELECT * FROM candidates ORDER BY id DESC');
$json->posts = $model->query("SELECT id,candidate_id,content,title,time,CONCAT('http://www.minoo96.ir/images/',image) as image , (SELECT count(*) FROM likes WHERE posts.id = likes.post_id) AS likes, (SELECT count(*) FROM comments WHERE posts.id = comments.post_id) AS comments, (SELECT count(*) FROM likes WHERE posts.id = likes.post_id AND likes.user_id = $user_id) AS liked FROM posts ORDER BY id DESC LIMIT 5");

echo json_encode($json);