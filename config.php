<?php
date_default_timezone_set('Asia/Jakarta');
$db_connection = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'etl_mapping_3_4',
    'host' => 'localhost'
);

$con = mysqli_connect($db_connection['host'], $db_connection['user'], $db_connection['pass'], $db_connection['db']);
?>