<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>景点</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no,email=no" name="format-detection">
	<link rel="stylesheet" href="../../css/All.css">
	<link rel="stylesheet" href="../../css/SpotDetail.css">
	<script src="../../js/all.js"></script>
	<script src="../../js/jquery.js"></script>
	
	<script type="text/javascript">
	$(function() {
		$("#buttonVoice").mousedown(function() {
			$("#buttonVoice").css("background-color", "#ececec");
		});
		$("#buttonVoice").mouseup(function() {
			$("#buttonVoice").css("background-color", "#ffffff");
		});
	});
	</script>
</head>

<body>
<div class="divImg">
	<img src="http://static.panoramio.com/photos/large/25625969.jpg"/>
	<div class="divSpotName">
		<h2 class="spotName">正德太岚殿</h2>
	</div>
</div>

<div class="divButtons">
	<div id="buttonVoice" class="divButton">
		<img src="../../img/SpotDetail_Voice.png"/>
		<p>自动讲解</p>
	</div>
	<div class="line0"></div>
	<div id="buttonMap" class="divButton">
		<img src="../../img/SpotDetail_Map.png"/>
		<p>路线导航</p>
	</div> 
</div>

<div class="line1"></div>

<ul>
	<li>
		<div class="divText divLeft">
			<h2>太和门三大殿</h2>
			<p class="pSmall">故宫宫殿的建筑布局有外朝、内廷之分。内廷与外朝的建筑气氛迥然不同。外朝以太和、中和、保和三大殿为中心，是封建皇帝行使权力、举行盛典...</p>
		</div>
		<a href="http://instory.sinaapp.com/web/SpotList/StoryDetail.php">
			<img class="divRight" src="http://img2.imgtn.bdimg.com/it/u=2001513216,1506955274&fm=21&gp=0.jpg"/>
		</a>
	</li>
	<li>
		<a href="http://instory.sinaapp.com/web/SpotList/StoryDetail.php">
			<img class="divLeft" src="http://img5.imgtn.bdimg.com/it/u=2750712910,1928934221&fm=21&gp=0.jpg"/>
		</a>
		<div class="divText divRight">
			<h2>东华门</h2>
			<p class="pSmall">东华门是紫禁城东门，始建于明永乐十八年（1420年）。东华门东向，与西华门遥相对应，门外设有下马碑石，门内金水河南北流向，上架石桥1座，桥北为...</p>
		</div>
	</li>
	<li>
		<a href="http://instory.sinaapp.com/web/SpotList/StoryDetail.php">
			<img class="divLeft" src="http://img0.imgtn.bdimg.com/it/u=2269844107,563276045&fm=21&gp=0.jpg"/>
		</a>
		<div class="divText divRight">
			<h2>午门来历</h2>
			<p class="pSmall">午门是紫禁城的正门。东西北三面城台相连，环抱一个方形广场。北面门楼，面阔九间，重檐黄瓦庑殿顶。东西城台上各有庑房十三间，从门楼两侧向南...</p>
		</div>
	</li>
</ul>

<div class="space"></div>

<div>
	<div class="divTop">
		<p class="textPhoto textColorMiddle">最美照片</p>
		<p class="textMore textColorMiddle">查看更多</p>
	</div>
	<div class="line"></div>
	<div class="divContent">
		<div class="divImg">
			<img src="http://file27.mafengwo.net/M00/64/70/wKgB6lTJpc-Af9fzAAUrqJNxdVM40.jpeg"/>
		</div>
		<div class="text">
			<p class="pSmall">@青玄："傍晚，像油画"</p>
		</div>
	</div>
</div>

<div class="space"></div>
</body>

<footer>
</footer>
</html>