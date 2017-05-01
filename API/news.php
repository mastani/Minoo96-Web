<?php
require_once 'loader.php';

$offset = 0;
if (isset($_REQUEST['offset']) && !empty($_REQUEST['offset'])) {
    $offset = $_REQUEST['offset'];
}

$start = $offset;
$end = $offset + 10;

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->news = $model->query("SELECT * FROM news ORDER BY id DESC LIMIT $start, $end");
echo json_encode($json);