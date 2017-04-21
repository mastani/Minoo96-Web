<?php
require_once 'loader.php';

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->news = $model->query('SELECT * FROM news');
echo json_encode($json);