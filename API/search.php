<?php
require_once 'loader.php';

$json = new stdClass();

$user_id = 0;
if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
}

if (isset($_REQUEST['q']) && !empty($_REQUEST['q'])) {
    $query = '%'.$_REQUEST['q'].'%';

    $q1 = $model->query("SELECT * FROM candidates WHERE name LIKE ?", array('s', $query));
    if (count($q1) > 0) {
        foreach ($q1 as &$row) {
            $json->candidates[] = $row['id'];
        }
    }

    $q2 = $model->query("SELECT id,candidate_id,content,title,time,CONCAT('http://www.minoo96.ir/images/',image) as image , (SELECT count(*) FROM likes WHERE posts.id = likes.post_id) AS likes, (SELECT count(*) FROM comments WHERE posts.id = comments.post_id) AS comments, (SELECT count(*) FROM likes WHERE posts.id = likes.post_id AND likes.user_id = $user_id) AS liked FROM posts WHERE content LIKE ? ORDER BY id DESC", array('s', $query));
    if (count($q2) > 0) {
        $json->posts = $q2;
    }
}

$json->time = date('Y-m-d G:i:s');
echo json_encode($json);