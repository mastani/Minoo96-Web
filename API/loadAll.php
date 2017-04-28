<?php
require_once 'loader.php';

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->news = $model->query('SELECT * FROM news');
$json->candidates = $model->query('SELECT * FROM candidates');
$json->posts = $model->query('SELECT id,candidate_id,content,title,time,CONCAT(\'http://www.minoo96.ir/images/\',image) as image , (SELECT count(*) FROM likes WHERE posts.id = likes.post_id) AS likes, (SELECT count(*) FROM comments WHERE posts.id = comments.post_id) AS comments FROM posts');

echo json_encode($json);