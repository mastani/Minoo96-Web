<?php
require_once 'loader.php';

$json = new stdClass();
$json->time = date('Y-m-d G:i:s');
$json->candidates = $model->query('SELECT * FROM candidates');
echo json_encode($json);