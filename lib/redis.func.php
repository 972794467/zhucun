<?php
function redis(){
$redis=new Redis();
$redis->connect(REDIS_HOST,REDIS_PORT);
return $redis;
}