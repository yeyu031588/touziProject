<?php 
$redis = new \redis();
$redis->connect('127.0.0.1', 6379);
$redis->hSet('test',10010,json_encode(array('ip'=>'120.25.322.12')));

?>
