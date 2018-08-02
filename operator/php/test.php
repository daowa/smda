<?php
$SAE_MYSQL_USER = "45lj0k2255";
$SAE_MYSQL_PASS = "kmk0zh001mz4zk1wziz43z4530xjxyiwlwxmx35y";
$SAE_MYSQL_HOST_M = "w.rdc.sae.sina.com.cn";
$SAE_MYSQL_HOST_S = "r.rdc.sae.sina.com.cn";
$SAE_MYSQL_PORT = 3307;
$SAE_MYSQL_DB = "app_instory";

echo "开始连接数据库";
// 连主库
$db = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
echo "开始连接数据库1";

// 连从库
// $db = mysql_connect(SAE_MYSQL_HOST_S.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

if ($db) {
	mysql_select_db(SAE_MYSQL_DB, $db);
	echo "连接成功";
	// ...
}