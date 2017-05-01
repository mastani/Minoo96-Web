<?php
require_once 'loader.php';

$offset = 0;
if (isset($_REQUEST['offset']) && !empty($_REQUEST['offset'])) {
    $offset = $_REQUEST['offset'];
}

$start = $offset;
$end = $offset + 5;

$user_id = 0;
if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
}

$where = "";
if (isset($_REQUEST['candidate_id']) && !empty($_REQUEST['candidate_id'])) {
    $candidate_id = $_REQUEST['candidate_id'];
    $where = "WHERE candidate_id = $candidate_id ORDER BY id DESC";
} else {
    $where = "ORDER BY id DESC LIMIT $start, $end";
}

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->posts = $model->query("SELECT id,candidate_id,content,title,time,CONCAT('http://www.minoo96.ir/images/',image) as image , (SELECT count(*) FROM likes WHERE posts.id = likes.post_id) AS likes, (SELECT count(*) FROM comments WHERE posts.id = comments.post_id) AS comments, (SELECT count(*) FROM likes WHERE posts.id = likes.post_id AND likes.user_id = $user_id) AS liked FROM posts $where");
echo json_encode($json);