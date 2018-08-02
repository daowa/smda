<?php
header("Content-type: text/html; charset=utf-8");
$shopid = $_GET['shopid'];
$shopname = $_GET['shopname'];
//$shopid = '1454382456';
//$shopname = '德克士（万体店）';
error_reporting(0);
//定义常量
define(DB_HOST, '222.204.246.156');
define(DB_USER, 'mysqlsmda');
define(DB_PASS, '123456');
//define(DB_HOST, '127.0.0.1');
//define(DB_USER, 'root');
//define(DB_PASS, 'ilab2016');
define(DB_DATABASENAME, 'smda');
//mysql_connect
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("connect failed" . mysql_error());
$weather = '13,0,0,22,8,14,2.2,0,0';  //平均温度，最大降雨，总降雨，最高温度，最低温度，温差，风速，高峰时降雨量，是否工作日
//计算天气敏感特征参数
$feature = "";
$weatherfeature = explode(",",$weather);
if($weatherfeature[0] < 4.62918){
	$feature = $feature."0";
}else if($weatherfeature[0] < 15.15){
	$feature = $feature."1";
}else if($weatherfeature[0] < 26.275){
	$feature = $feature."2";
}else{
	$feature = $feature."3";
}
if($weatherfeature[5] < 2.8){
	$feature = $feature."0";
}else if($weatherfeature[5] < 6.7){
	$feature = $feature."1";
}else if($weatherfeature[5] < 11.6){
	$feature = $feature."2";
}else{
	$feature = $feature."3";
}
if($weatherfeature[2] = 0){
	$feature = $feature."0";
}else if($weatherfeature[2] < 25){
	$feature = $feature."1";
}else{
	$feature = $feature."2";
}
if($weatherfeature[8] = 0){
	$feature = $feature."0";
}else if($weatherfeature[8] = 1){
	$feature = $feature."1";
}else{
	$feature = $feature."2";
}
$cid = array('闵行'=>'CHSH000100','宝山'=>'CHSH000200','嘉定'=>'CHSH000300','南汇'=>'CHSH000400','金山'=>'CHSH000500',
	'青浦'=>'CHSH000600','松江'=>'CHSH000700','奉贤'=>'CHSH000800','崇明'=>'CHSH000900','徐家汇'=>'CHSH001000','浦东'=>'CHSH001100',);
mysql_select_db(DB_DATABASENAME, $conn);
mysql_query('set names utf8');
$sql = "SELECT locationname from tb_locationname where locationid = (select locationid from tb_shoplocation where shopid = ".$shopid." limit 0,1)";
$result = mysql_query($sql);
$location = "";
while($row = mysql_fetch_array($result))
{
	$location = $row['locationname'];
}
if($location == ""){
	$location = '徐家汇';
}
//
global $conn;
$sql11 = "select locationid from tb_shoplocation where shopid = '".$shopid."' limit 0,1";
$result11 = mysql_query($sql11,$conn);
$locationid="";
while($row11 = mysql_fetch_array($result11,MYSQL_BOTH))
{
	$locationid = $row11['locationid'];
}
//mysql_close($conn);

?>
<!DOCTYPE html>
<html lang="zh-cn" class="no-js" xmlns:ownhtml>
	<head>
		<METAHTTP-EQUIV="Pragma"CONTENT="no-cache">
		<METAHTTP-EQUIV="Cache-Control"CONTENT="no-cache">
		<METAHTTP-EQUIV="Expires"CONTENT="0">
		<meta http-equiv="Content-Type">
		<meta content="text/html; charset=utf-8">
		<meta charset="utf-8">
		<title><?php echo $shopname; ?></title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="email=no">
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/animations.css" />
		<style>
			ownhtml\:h7{color: black}
		</style>
<!--		<script src="js\echarts-all.js"></script>-->
		<script src="js\echarts-all.js"></script>
		</head>
	<body>
	<div class="spinner" id="loading">
		<div class="dot1"></div>
		<div class="dot2"></div>
	</div>
	<div style="display: none;"><?php echo $feature."+".$locationid ?></div>
		<div id="content" style="display: none">
			<div class="page page-1-1 page-current">
				<div class="wrap">
					<img class="img_1 pt-page-moveFromTop" src="img/cover.png" />
<!--					<img class="img_2 pt-page-moveFromLeft" src="img/weather.png" />-->
					<img class="img_3 pt-page-moveIconUp" src="img/icon_up.png" />
					<iframe style="position:absolute;top:46%;left:50%;margin-left:-150px;" src="http://www.thinkpage.cn/weather/weather.aspx?uid=UE3B1AADB3&cid=<?php echo $cid[$location]; ?>&l=zh-CHS&p=SMART&a=0&u=C&s=5&m=0&x=1&d=0&fc=&bgc=C6C6C6&bc=C6C6C6&ti=0&in=0&li=" frameborder="0" scrolling="no" width="300" height="180" allowTransparency="true"></iframe>
					<p class="page1_text">及时掌握店铺所在地天气情况</p>
				</div>
			</div>
			<div class="page page-2-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page2_logo.png" />
					<!--<img class="img_2 hide pt-page-moveCircle" src="img/circle.png" />-->
					<img class="img_31 hide pt-page-moveFromLeft" src="img/order_level.png" />
					<img class="img_32 hide pt-page-moveFromRight" src="img/cost_level.png" />
<!--					<img class="img_4 hide pt-page-scaleUp" src="img/dot1.png" />-->
					<!--<img class="img_5 hide pt-page-scaleUp" src="img/check_develop.png" />-->
					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />
					<img class="img_7 hide pt-page-scaleUp" src="img/floating_develop.png" />
					<div class="page2_text1">
						<?php
						if($shopid == '1454382456'){
						$countcomments = array("<p>评级：差。<br>在上海市处于落后群体，请积极检查各项原因！</p>",
							"<p>评级：较差。<br>今天销量不尽人意哦~看看有啥可以提升！</p>",
							"<p>评级：较好。<br>超过上海市一半商家，还有提升空间！</p>",
							"<p>评级：好。<br>处于金字塔顶峰的店铺！看看有没有画龙点睛之笔。</p>");

						//						$output1 = shell_exec('C:\Users\work\Anaconda2\python D:\gitsmda\web\takeout\predictShopInterval.py --i 1454382456 --t CommmentCount --f 0,0,0,1');
						//						$output1 = shell_exec('C:\Users\work\Anaconda2\python D:\gitsmda\web\takeout\predictShopInterval.py --i '.$shopid.' --t CommmentCount --f 0,0,0,1');
						$output1 = shell_exec('C:\Anaconda2\python C:\InforGate\InforGate\wwwroot\smda\web\takeout\predictShopInterval.py --i '.$shopid.' --t CommmentCount --f 0,0,0,1');
						$output1 = $output1 - 1;
						//						exec('C:\Users\work\Anaconda2\python predictShopInterval.py --i $shopid --t CommmentCount --f 0,0,0,1 2>&1',$res, $return_val);
						//						print $res;
						echo "
						$countcomments[$output1]";
						?>
					</div>
					<div class="page2_text2">
						<?php
						$costcomments = array("<p>评级：好。<br>配送速度和飞一样！外卖小哥是开飞机的吗。</p>",
							"<p>评级：较好。<br>在各种天气下配送速度都很稳定！继续保持。</p>",
							"<p>评级：较差。<br>是天气原因还是其他原因耽误了您的配送呢？</p>",
							"<p>评级：差。<br>顾客等的花儿都谢了！赶紧查缺补漏吧。</p>");
						//						$output2 = shell_exec('C:\Users\work\Anaconda2\python predictShopInterval.py --i '.$shopid.' --t CostTime --f 0,0,0,8.5,0');
						$output2 = shell_exec('C:\Anaconda2\python C:\InforGate\InforGate\wwwroot\smda\web\takeout\predictShopInterval.py --i '.$shopid.' --t CostTime --f 0,0,0,8.5,0');
						$output2 = $output2 - 1;
						echo "$costcomments[$output2]";
						}else{
						$countcomments = array("<p>评级：差。<br>在上海市处于落后群体，请积极检查各项原因！</p>",
							"<p>评级：较差。<br>今天销量不尽人意哦~看看有啥可以提升！</p>",
							"<p>评级：较好。<br>超过上海市一半商家，还有提升空间！</p>",
							"<p>评级：好。<br>处于金字塔顶峰的店铺！看看有没有画龙点睛之笔。</p>");
						$aa = rand(0,3);
						echo "
						$countcomments[$aa]";
						?>
					</div>
					<div class="page2_text2">
						<?php
						$costcomments = array("<p>评级：好。<br>配送速度和飞一样！外卖小哥是开飞机的吗。</p>",
							"<p>评级：较好。<br>在各种天气下配送速度都很稳定！继续保持。</p>",
							"<p>评级：较差。<br>是天气原因还是其他原因耽误了您的配送呢？</p>",
							"<p>评级：差。<br>顾客等的花儿都谢了！赶紧查缺补漏吧。</p>");
						$bb = rand(0,3);
						echo "
						$costcomments[$bb]";
						}
						?>
					</div>
				</div>
			</div>

			<div class="page page-6-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page3_logo.png" />
<!--					<img class="img_2 hide pt-page-moveCircle" src="img/circle-design.png" />-->
<!--					<img class="img_3 hide pt-page-moveCircle" src="img/page3_netmap.jpg" />-->
					<img class="img_4 hide pt-page-scaleUp" src="img/page3_tip.png" />
					<!--<img class="img_5 hide pt-page-scaleUp" src="img/check_design.png" />-->
					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />
					<!--<img class="img_7 hide pt-page-scaleUp" src="img/floating_design.png" />-->
					<div id="forcechart" class="chart1" style="background-color: #aaaaaa"></div>
					<div class="page3_text">
						<?php
//						$level1 = '评级：好。<br>本店在此项目上好于大多数对手';
//						$level1 = '评级：好。<br>本店在此项目上好于大多数对手';
//						$output3 = shell_exec('C:\Users\work\Anaconda2\python predictShopInterval.py --i 1447331829 --t CommmentCount --f 0,0,0,1');
//						$output4 = shell_exec('C:\Users\work\Anaconda2\python predictShopInterval.py --i 1454382456 --t CostTime --f 0,0,0,8.5,0');
						global $conn;
						$sql = sprintf("SELECT weight,(select shopname from net_node_new where net_node_new.shopid = net_line_new.target) as shopname from net_line_new where source = '%s' ORDER BY weight DESC limit 0,1", $shopid);
						$result = mysql_query($sql,$conn);
						$resshop = "";
						while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
							$resshop = $row['shopname'];
						}
//						mysql_close($conn);
						echo "<p>最大竞品：$resshop</p>
								<p>销量评级：较差</p>
								<p>配送评级：较好</p>
								";
						?>
					</div>
				</div>
			</div>
<!--			<div class="page page-3-2 hide">-->
<!--				<div class="wrap">-->
<!--					<img class="img_1 hide pt-page-flipInLeft" src="img/introduction_design.png" />-->
<!--					<img class="img_2 hide pt-page-flipInLeft" src="img/btn_design.png" />-->
<!--					<img class="img_3 hide pt-page-flipInLeft" src="img/dot2.png" />-->
<!--					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />-->
<!--				</div>-->
<!--			</div>-->
			
			<div class="page page-3-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page4_logo.png" />
					<img class="img_21 hide pt-page-moveCircle" src="img/page4_bg.png" />
					<!--<img class="img_3 pt-page-moveFromRight hide" src="img/people_production.png" />-->
					<!--<img class="img_4 hide pt-page-scaleUp" src="img/dot1.png" />-->
					<!--<img class="img_5 hide pt-page-scaleUp" src="img/check_production.png" />-->
					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />
					<img class="img_7 hide pt-page-scaleUp" src="img/floating_production.png" />
					<img class="img_8 hide pt-page-scaleUp" src="img/pic_shadow_production.png" />
<!--					<div class="page4_text">-->
<!--						<div style='text-align: left;margin-left: 30px'>-->
<!--							<p>历史上最接近的一天是：2016-02-29<br>平均温度：6.8度<br>降雨、风速相近的工作日</p>-->
<!--						</div>-->
<!--						<br>-->
<!--						<div style='text-align: left;margin-left: 30px'>-->
<!--							<p><ownhtml:h7>销售数量：</ownhtml:h7>14</p>-->
<!--							<p><ownhtml:h7>菜品评分：</ownhtml:h7>5</p>-->
<!--							<p><ownhtml:h7>服务评分：</ownhtml:h7>5</p>-->
<!--							<p><ownhtml:h7>配送时间：</ownhtml:h7>26.6</p>-->
<!--						</div>-->
<!--						<br>-->
<!--						<p style='color: black;text-align: left;margin-left: 30px'>精选评价：</p>-->
<!--						<div style='text-align: left;margin-left: 30px'>-->
<!--							<p>1、没有给好吃的调味包啊！！</p>-->
<!--							<p>2、还不错吧这个德克士比较喜欢的产品。</p>-->
<!--						</div>-->
<!--					</div>-->
					<div class="page4_text">
						<?php
//						$output = "历史上最接近的一天是：2016-03-01，平均温度：6.5度，降雨、风速相近的工作日;18;4.61111111111;4.94444444444;23.1667;点的是北海道送的是草莓，鸡翅买一送一，少一个，呵呵呵呵呵;外卖一如既往的速度。不过商家备菜的时候发生了一点意外，但是商家态度很好，马上解决了。冲着这态度，4星也变5星了。";
//						$output = shell_exec('C:\Users\work\Anaconda2\python D:\gitsmda\web\takeout\similarity1.py --i 1454382456 --f 6,0,0,11,2,9,1.5,0,0');
//						$output = shell_exec('C:\Users\work\Anaconda2\python D:\gitsmda\web\takeout\similarity.py --i '.$shopid.' --s '.iconv("utf-8","gbk//IGNORE",$location).' --f '.$weather);
						$output = shell_exec('C:\Anaconda2\python C:\InforGate\InforGate\wwwroot\smda\web\takeout\similarity.py --i '.$shopid.' --s '.iconv("utf-8","gbk//IGNORE",$location).' --f '.$weather);
						$res = explode(';',$output);
						$res[2] = round($res[2],2);
						$res[3] = round($res[3],2);
						$res[4] = round($res[4],2);
						if($res[5] == ""){
							$res[5] == "暂时没有评价";
						}
						if($res[6] == ""){
							$res[6] == "暂时没有评价";
						}
						echo "
								<div>
								  <p>$res[0]</p>
								</div>
								<br>
								<div style='text-align: left;margin-left: 30px'>
								  <p><ownhtml:h7>销售数量：</ownhtml:h7>$res[1]</p>
								  <p><ownhtml:h7>菜品评分：</ownhtml:h7>$res[2]</p>
								  <p><ownhtml:h7>服务评分：</ownhtml:h7>$res[3]</p>
								  <p><ownhtml:h7>配送时间：</ownhtml:h7>$res[4]</p>
								</div>
								<br>
								<p style='color: black;text-align: left;margin-left: 30px'>精选评价：</p>
								<div style='text-align: left;margin-left: 30px'>
								  <p>1、$res[5]</p>
								  <p>2、$res[6]</p>
								</div>

							";
						?>
					</div>


				</div>
			</div>
			
<!--			<div class="page page-4-2 hide">-->
<!--				<div class="wrap">-->
<!--					<img class="img_1 hide pt-page-flipInLeft" src="img/introduction_production.png" />-->
<!--					<img class="img_2 hide pt-page-flipInLeft" src="img/btn_production.png" />-->
<!--					<img class="img_3 hide pt-page-flipInLeft" src="img/dot2.png" />-->
<!--					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />-->
<!--				</div>-->
<!--			</div>-->
			<div class="page page-4-1 hide">
				<div class="wrap">
						<img class="img_3 hide pt-page-moveFromBottom" src="img/page5_1_logo.png" />
<!--						<img id="changeimg" class="img_1 hide pt-page-rotateCubeBottomIn" src="img/page5_chart.png" />-->
<!--						<img class="img_2 hide pt-page-rotateCubeTopIn" src="img/page5_chart.png" />-->
						<img class="img_4 hide pt-page-scaleUp" src="img/dot1.png" />
						<img class="img_5 hide pt-page-scaleUp" src="img/tobarchart.png" />
						<div id="wordcloudchart" class="img_1"></div>
<!--						<img id="wordcloud" class="img_1" style="display: none" src="img/page5_cloud.jpg"/>-->
<!--						<img id="changeimg" class="img_5 hide pt-page-scaleUp" src="img/tocloud.png" />-->
				</div>
			</div>

			<div class="page page-4-2 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page5_2_logo.png" />
<!--					<img class="img_1 hide pt-page-flipInLeft" src="img/introduction_production.png" />-->
<!--					<img class="img_2 hide pt-page-flipInLeft" src="img/btn_production.png" />-->
					<img class="img_3 hide pt-page-flipInLeft" src="img/dot2.png" />
					<div id="barchart" class="img_4"></div>
				</div>
			</div>

			<div class="page page-5-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page6_1_logo.png" />
					<img class="img_4 hide pt-page-scaleUp" src="img/dot1.png" />
					<img class="img_5 hide pt-page-scaleUp" src="img/tosensitivedishes.png" />
<!--					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />-->
					<div id="funnelchart" class="img_7"></div>
				</div>
			</div>

			<div class="page page-5-2 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page6_2_logo.png" />
<!--					<img class="img_2 hide pt-page-flipInLeft" src="img/page6_2_bkgd.png" />-->
					<img class="img_3 hide pt-page-flipInLeft" src="img/dot2.png" />
					<div id="funnelchart2" class="img_7"></div>
				</div>
			</div>

			<div class="page page-7-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page7_logo.png" />
					<img class="img_2 hide pt-page-moveFromBottom" src="img/new_y.png" />

					<div class="div_3">
						 <textarea rows="3" cols="30">请在此输入营销短信……</textarea>
					</div>
					<div class="div_4">
						<input type="button" value="  一键发送营销短信  ">
					</div>
<!--					<img class="img_4 hide pt-page-scaleUp" src="img/dot1.png" />-->
<!--					<img class="img_5 hide pt-page-scaleUp" src="img/tosensitivedishes.png" />-->
					<!--					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />-->
					<div id="page7chart" class="img_7"></div>
				</div>
			</div>

			<div class="page page-8-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-moveFromBottom" src="img/page6_1_logo.png" />
					<img class="img_4 hide pt-page-scaleUp" src="img/dot1.png" />
					<img class="img_5 hide pt-page-scaleUp" src="img/tosensitivedishes.png" />
					<!--					<img class="img_6 hide pt-page-moveIconUp" src="img/icon_up.png" />-->
					<div id="funnelchart" class="img_7"></div>
				</div>
			</div>


		</div>	
		<script src="js/zepto.min.js"></script>
		<script src="js/touch.js"></script>
		<script src="js/index.js"></script>
		<script type="text/javascript">
			document.onreadystatechange = loading;
			function loading() {
				if (document.readyState == "complete") {
					$("#loading").hide();
					$("#content").show();
				}
			}
		</script>
		<script>

			var oImg = document.getElementById('changeimg');
			var onOff = true;
			oImg.onclick = function() {
//				if ( onOff ) {
//					oImg.src = 'img/page5_cloud.jpg';
//					onOff = false;
//				}
//				else {
//					oImg.src = 'img/page5_chart.png';
//					onOff = true;
//				}
				if ( onOff ) {
					$("#chart").hide();
					$("#wordcloud").show();
					oImg.src = 'img/torecommend.png';
					onOff = false;
				}
				else {
					$("#wordcloud").hide();
					$("#chart").show();
					oImg.src = 'img/tocloud.png';
					onOff = true;
				}
			};
		</script>
		<script type="text/javascript">
			// 基于准备好的dom，初始化echarts实例
			var myChart = echarts.init(document.getElementById('barchart'));

//			 指定图表的配置项和数据
			option = {
				title : {
					text: '高推荐菜品',
					subtext: '数据来自百度外卖',
					textStyle: {
						color: "#ffffff",
					},
					subtextStyle: {
						color: "#ffffff",
					}
				},

				tooltip : {
					trigger: 'axis',
					textStyle: {
						fontSize: 12
					}
				},
				legend: {
					data:['推荐数']
				},
				toolbox: {
					show : true,
					feature : {
//						magicType : {show: true, type: ['line', 'bar']},
					}
				},
				calculable : true,
				yAxis : [
					{
						axisLine:{
							lineStyle:{
								color:"#ffffff"
							}
						},
						axisLabel:{
							textStyle:{
								color:"#ffffff",
							}
						},
						type : 'category',
						data : [
							<?php
							global $conn;
							$sql = sprintf("select dishes from tb_baiduwaimaishop where shop_id = '%s' limit 0,1", $shopid);
							$result = mysql_query($sql,$conn);
							while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
								$arr = explode(";",$row["dishes"]);
								for($i=0;$i<count($arr);$i++){
									echo "'".explode(":",$arr[$i])[0]."',";
								}

							}
							?>
						]
					}
				],
				xAxis : [
					{
						axisLine:{
							lineStyle:{
								color:"#ffffff"
							}
						},
						axisLabel:{
							textStyle:{
								color:"#ffffff"
							}
						},
						type : 'value'
					}
				],
				series : [
					{
						name:'推荐数',
						type:'bar',
						data:[
							<?php
							global $conn;
							$sql = sprintf("select dishes from tb_baiduwaimaishop where shop_id = '%s' limit 0,1", $shopid);
							$result = mysql_query($sql,$conn);
							while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
								$arr = explode(";",$row["dishes"]);
								for($i=0;$i<count($arr);$i++){
									echo "'".explode(":",$arr[$i])[1]."',";
								}

							}
							?>
						],
						markPoint : {
							data : [
								{type : 'max', name: '最大值'},
								{type : 'min', name: '最小值'}
							]
						},
					}
				]
			};
//			option = {
//				title : {
//					text: '高推荐菜品',
//				},
//				tooltip : {
//					trigger: 'axis'
//				},
//				legend: {
//					data:['推荐数']
//				},
//				toolbox: {
//					show : true,
//					feature : {
//						mark : {show: true},
//						dataView : {show: true, readOnly: false},
//						magicType : {show: true, type: ['line', 'bar']},
//						restore : {show: true},
//						saveAsImage : {show: true}
//					}
//				},
//				calculable : true,
//				xAxis : [
//					{
//						type : 'category',
//						data : ["番茄肥牛锅饭","招牌特大鸡排","甘梅地瓜薯条","台湾盐酥鸡","五花肉石锅拌饭套餐"],
//						axisLine:{
//							lineStyle:{
//								color:'#F8F8FF',
//								width:2,//这里是为了突出显示加上的，可以去掉
//							}
//						},
//						axisLabel: {
//							show: true,
//							textStyle: {
//								color: '#F8F8FF'
//							}
//						}
//					}
//				],
//				yAxis : [
//					{
//						type : 'value'
//					}
//				],
//				series : [
//					{
//						name:'推荐数',
//						type:'bar',
//						data:[41, 38, 37, 34, 31],
//						markPoint : {
//							data : [
//								{type : 'max', name: '最大值'},
//								{type : 'min', name: '最小值'}
//							]
//						},
//						markLine : {
//							data : [
//								{type : 'average', name: '平均值'}
//							]
//						}
//					},
//				]
//			};
			// 使用刚指定的配置项和数据显示图表。
			myChart.setOption(option);
		</script>
			<script type="text/javascript">
					var myChart = echarts.init(document.getElementById('forcechart'));
					option = {
						title : {
							text: '商家竞争格局',
							subtext: '数据来自百度外卖',
							x:'right',
							y:'bottom'
						},
						backgroundColor : '#fff',
						tooltip : {
							trigger: 'item',
							formatter: '{a} : {b}',
							textStyle: {
								fontSize: 12
							}
						},
						toolbox: {
							show : true,
							feature : {
								magicType: {show: true, type: ['force', 'chord']},
							}
						},
						legend: {
							x: 'left',
							data:['餐厅']
						},
						series : [
							{
								type:'force',
								name : "竞争关系",
								ribbonType: false,
								categories : [
									{

									},
								],
								itemStyle: {
									normal: {
										label: {
											show: true,
											textStyle: {
												color: '#333'
											}
										},
										nodeStyle : {
											brushType : 'both',
											borderColor : 'rgba(255,215,0,0.4)',
											borderWidth : 1
										},
										linkStyle: {
											type: 'curve'
										}
									},
									emphasis: {
										label: {
											show: false
											// textStyle: null      // 默认使用全局文本样式，详见TEXTSTYLE
										},
										nodeStyle : {
											//r: 30
										},
										linkStyle : {}
									}
								},
								useWorker: false,
								minRadius : 15,
								maxRadius : 25,
								gravity: 1.1,
								scaling: 1.1,
								roam: 'move',
								nodes:[
									{category:0, name: '<?php echo $shopname ?>', value : 1000},
									<?php
									global $conn;
									$sql = sprintf("select shopname,value,weight from net_line,net_node where net_line.target=net_node.shopid and source='%s' order by weight desc limit 0,8", $shopid);
									$result = mysql_query($sql,$conn);
									$posts = array();
									while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
										echo "{category:0, name:'".$row[0]."',value :".$row[1]."},";
									}
									?>
								],
								links : [
									{source : '丽萨-乔布斯', target : '乔布斯', weight : 1},
									<?php
									global $conn;
									$sql = sprintf("select shopname,value,weight from net_line,net_node where net_line.target=net_node.shopid and source='%s' order by weight desc limit 0,8", $shopid);
									$result = mysql_query($sql,$conn);
									$posts = array();
									while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
										echo "{source : '".$shopname."', target : '".$row[0]."', weight :".$row[2]."},\r\n";
									}
									$sql1 = sprintf("select (select shopname from net_node where shopid=source),(select shopname from net_node where shopid=target),weight from net_line where source in (select m.target from (select * from net_line where source = '%s' order by weight desc limit 0,8) as m) and target in (select n.target from (select * from net_line where source = '%s' order by weight desc limit 0,8) as n) ORDER BY weight desc limit 0,10", $shopid,$shopid);
									$result1 = mysql_query($sql1,$conn);
									$posts1 = array();
									while ($row1 = mysql_fetch_array($result1, MYSQL_BOTH)) {
										echo "{source : '".$row1[0]."', target : '".$row1[1]."', weight :".$row1[2]."},\r\n";
									}


									?>


								]
							}
						]
					};

					var ecConfig = echarts.config;
					function focus(param) {
						var data = param.data;
						var links = option.series[0].links;
						var nodes = option.series[0].nodes;
						if (
							data.source !== undefined
							&& data.target !== undefined
						) { //点击的是边
							var sourceNode = nodes.filter(function (n) {return n.name == data.source})[0];
							var targetNode = nodes.filter(function (n) {return n.name == data.target})[0];
							console.log("选中了边 " + sourceNode.name + ' -> ' + targetNode.name + ' (' + data.weight + ')');
						} else { // 点击的是点
							console.log("选中了" + data.name + '(' + data.value + ')');
						}
					}
					myChart.on(ecConfig.EVENT.CLICK, focus)

					myChart.on(ecConfig.EVENT.FORCE_LAYOUT_END, function () {
						console.log(myChart.chart.force.getPosition());
					});
					myChart.setOption(option);
			</script>
		<script type="text/javascript">
				function createRandomItemStyle() {
					return {
						normal: {
							color: 'rgb(' + [
								Math.round(Math.random() * 160),
								Math.round(Math.random() * 160),
								Math.round(Math.random() * 160)
							].join(',') + ')'
						}
					};
				}
				var myChart = echarts.init(document.getElementById('wordcloudchart'));
				var option = {
					title: {
						text: '店铺评价热词图',
					},
					tooltip: {
						show: true,
						textStyle: {
							fontSize: 12
						}
					},
					backgroundColor : '#fff',
					textStyle :{
						fontSize: 12
					},
					series: [{
						name: '店铺评价热词图',
						type: 'wordCloud',
						size: ['80%', '80%'],
						textRotation : [0, 45, 90, -45],
						textPadding: 0,
						autoSize: {
							enable: true,
							minSize: 14
						},
						data: [
							<?php
							global $conn;
							$sql = sprintf("select wordcloud from tb_baiduwaimaishop where shop_id = '%s' limit 0,1", $shopid);
							$result = mysql_query($sql,$conn);
							$posts = array();
							while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
								$arr = explode(";",$row["wordcloud"]);
								$value = 10000;
								$itemStyle = '{
									normal: {
										color: \'black\'
									}
								}';
								for($i=0;$i<count($arr);$i++){
									echo "{name:'".explode(":",$arr[$i])[0]."',value :".$value.",itemStyle :".$itemStyle."},";
									$itemStyle = 'createRandomItemStyle()';
									$value -=1000;
								}

							}
							?>
						]
					}]
				};
				myChart.setOption(option);
		</script>
	<script type="text/javascript">
		var myChart = echarts.init(document.getElementById('funnelchart'));
		option = {
			color : [
				'rgba(255, 69, 0, 0.8)',
				'rgba(255, 150, 0, 0.8)',
				'rgba(255, 200, 0, 0.8)',
				'rgba(155, 200, 50, 0.8)',
				'rgba(55, 200, 100, 0.8)',
				'rgba(0, 200, 0, 0.8)'
			],
			title : {
				text: '',
			},
			tooltip : {
				trigger: 'item',
				formatter: "{a} <br/>{b}",
				textStyle: {
					fontSize: 12
				}
			},
			toolbox: {
				show : true,
				feature : {
				}
			},
			calculable : true,
			series : [
				{

					name:'天气敏感人群手机',
					type:'funnel',
					x: '15%',
					y: '0%',
					width: '70%',
					height: '95%',
					data:[
						<?php
						global $conn;
						$sql = sprintf("select increase from weather_userincrease where weather = '%s' and locationid = '%s'", $feature,$locationid);
						$result = mysql_query($sql,$conn);
						$posts = array();
						$l = 87;
						$ll = 7;
						while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
							$arr = explode(",",$row["increase"]);
							for($i=0;$i<count($arr);$i++){
								echo "{value:'".($l-$ll)."',name :'".explode(":",$arr[$i])[0]."  ↑".round(explode(":",$arr[$i])[1])."%'},";
								$l=$l-$ll;
								$ll-=1;
								if($l<=63){
									break;
								}
							}

						}
						?>
						{value:61, name:'……'}
					],
					itemStyle: {
						normal: {
							label: {
								position: 'inner',
							}
						}
					}
				},
			],
		};
		myChart.setOption(option);
	</script>
	<script type="text/javascript">
		var myChart = echarts.init(document.getElementById('page7chart'));
		option = {
			title : {
				text: '',
				subtext: ''
			},
			tooltip : {
				trigger: 'item',
				formatter: "{a} <br/>{b} ",
				textStyle: {
					fontSize: 12
				}
			},

			calculable : true,
			series : [
				{
					name:'漏斗图',
					type:'funnel',
					x: '20%',
					y: 0,
					//x2: 80,
					y2:10,
					width: '60%',
					// height: {totalHeight} - y - y2,
					min: 0,
					max: 100,
					minSize: '100%',
					maxSize: '100%',
					sort : 'descending', // 'ascending', 'descending'
					gap : 10,
					itemStyle: {
						normal: {
							// color: 各异,
							borderColor: '#fff',
							borderWidth: 1,
							label: {
								show: true,
								position: 'inside'
								// textStyle: null      // 默认使用全局文本样式，详见TEXTSTYLE
							},
							labelLine: {
								show: false,
								length: 10,
								lineStyle: {
									// color: 各异,
									width: 1,
									type: 'solid'
								}
							}
						},
						emphasis: {
							// color: 各异,
							borderColor: 'red',
							borderWidth: 5,
							label: {
								show: true,
								formatter: '{b}:{c}%',
								textStyle:{
									fontSize:20
								}
							},
							labelLine: {
								show: true
							}
						}
					},
					data:[
						<?php
						global $conn;
						$sql = sprintf("select pass_name from tb_baiduwaimai where waimai_release_id = '%s' limit 0,5",$shopid );
						$result = mysql_query($sql,$conn);
						$posts = array();

						while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
							echo "{value:'100',name :'".$row["pass_name"]."%'},";
						}
						?>
					]
				}
			]
		};

		myChart.setOption(option);
	</script>
	<script type="text/javascript">
		var myChart = echarts.init(document.getElementById('funnelchart2'));
		option = {
			color : [
				'rgba(255, 69, 0, 0.8)',
				'rgba(255, 150, 0, 0.8)',
				'rgba(255, 200, 0, 0.8)',
				'rgba(155, 200, 50, 0.8)',
				'rgba(55, 200, 100, 0.8)',
				'rgba(0, 200, 0, 0.8)'
			],
			title : {
				text: '',
			},
			tooltip : {
				trigger: 'item',
				formatter: "{a} <br/>{b}",
				textStyle: {
					fontSize: 12
				}
			},
			toolbox: {
				show : true,
				feature : {
				}
			},
			calculable : true,
			series : [
				{

					name:'天气敏感菜品',
					type:'funnel',
					x: '15%',
					y: '0%',
					width: '70%',
					height: '95%',
					data:[
						<?php
						global $conn;
						$sql = sprintf("select increase from weather_foodincrease where weather = '%s'", $feature);
						$result = mysql_query($sql,$conn);
						$l = 87;
						$ll = 7;
						while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
							$arr = explode(",",$row["increase"]);
							for($i=0;$i<count($arr);$i++){
								echo "{value:".($l-$ll).",name :'".explode(":",$arr[$i])[0]."  ↑".round(explode(":",$arr[$i])[1])."%'},";
								$l=$l-$ll;
								$ll-=1;
								if($l<=63){
									break;
								}
							}

						}
						?>
						{value:61, name:'……'}
					],
					itemStyle: {
						normal: {
							label: {
								position: 'inner',
							}
						}
					}
				},
			],
		};
		myChart.setOption(option);
	</script>
	</body>
</html>
