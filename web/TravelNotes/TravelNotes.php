<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>我的足迹</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no,email=no" name="format-detection">
	<link rel="stylesheet" href="../../css/TravelNotes.css">
	<link rel="stylesheet" href="../../css/All.css">
	<script src="../../js/all.js"></script>
	
	<script type="text/javascript">
	function toTravelNotesDetail(){
		//self.location = ADDRESS + "web/TravelNotes/TravelNotesDetail.php";
		self.location = "http://instory.applinzi.com/web/TravelNotes/TravelNotesDetail.php";
	}
	</script>
</head>

<body>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://sh.sinaimg.cn/2015/0127/U11428P18DT20150127121811_1.jpeg">
				<h2 class="area">日本京都红色的寺</h2>
				<h3 class="time">2016年5月18日-19日</h3>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://img.tuniucdn.com/icons/place_photo/2012-02-111349938391800x600.jpg">
				<h2 class="area">河北玫瑰庄园温泉</h2>
				<h3 class="time">2016年2月24日-27日</h3>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://youimg1.c-ctrip.com/target/fd/tg/g4/M02/C7/DC/CggYHFYvavGATAHeAAR_dYuAI-E072.jpg">
				<h2 class="area">大理南诏风情岛</h2>
				<h3 class="time">2015年7月17日</h3>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://file110.mafengwo.net/s9/M00/82/BD/wKgBs1brhs-AezNtAAySqD09yqs14.jpeg?imageView2%2F2%2Fw%2F680%2Fq%2F90">
				<h2 class="area">伦敦塔桥</h2>
				<h3 class="time">2015年6月8日</h3>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://file108.mafengwo.net/s7/M00/8B/4C/wKgB6lS4toiAEHixADP-aXGvrRg23.jpeg?imageView2%2F2%2Fw%2F680%2Fh%2F9999%2Fq%2F100">
				<h2 class="area">云南四方镇</h2>
				<h3 class="time">2015年1月17日</h3>
			</div>
		</li>
	</ul>
</body>

<footer>
</footer>
</html>