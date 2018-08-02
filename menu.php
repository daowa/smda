<?php

require 'weixin.class.php';

$ret=wxcommon::getToken();
$ACCESS_TOKEN=$ret['access_token'];
$menuPostData='{
"button":[
{
"name":"行业报告",
"sub_button":[
	{
	"type":"view",
	"name":"外卖行业",
	"url":"http://note.youdao.com/noteshare?id=0e6af664e1f965424ea50164383a35b9"
	}
	]
},
{
"name":"我的天气预报",
"type":"click",
"key":"V142857_Mine"
}';
 
// create new menu
$wxmenu=new wxmenu($ACCESS_TOKEN);
$create=$wxmenu->createMenu($menuPostData);

//get current menu
// $get=$wxmenu->getMenu();
// var_dump($get);

//delete current menu
// $del=$wxmenu->deleteMenu();
// var_dump($del);

?>