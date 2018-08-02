<?php

require 'weixin.class.php';

//定义常量



class DefaultWeixin extends wxmessage {
	private function text($text) {
		$xml = $this->outputText($text);
		header('Content-Type: application/xml');
		echo $xml;
	}

	public function processRequest($data) {
		// $input is the content that user inputs
		$input = $data->Content;
		// deal with text msg from user
		if ($this->isTextMsg()) {
			switch ($input) {
				case 'subscribe':
					$this->text("欢迎使用商家天气助手

商家天气助手结合上海市气象局提供的气象数据，以及公开数据源采集的商业数据，经过数据分析与挖掘生成行业报告。同时，商家气象助手还为每个商家提供了定制的每日气象
报告，根据当天的天气情况，为商家提供经营建议。

点击“行业报告”菜单可以看到天气助手已经生成的行业报告。
对话框输入商家名称，可以查看为您专门准备的天气预报，并可订阅。");
					break;
				default:
					$this->getStore($input);
					break;

			}
		}
		//判断并处理事件推送
		else if($this->isEventMsg()){
			switch($data->Event){
				case 'subscribe':
					$this->text("欢迎使用商家天气助手

商家天气助手结合上海市气象局提供的气象数据，以及公开数据源采集的商业数据，经过数据分析与挖掘生成行业报告。同时，商家气象助手还为每个商家提供了定制的每日气象
报告，根据当天的天气情况，为商家提供经营建议。

点击“行业报告”菜单可以看到天气助手已经生成的行业报告。
对话框输入商家名称，可以查看为您专门准备的天气预报，并可订阅。");
				case 'CLICK':
					$this->click($data);
					break;
			}
		}
		else {
		}
	}

	/**
	 * 分类处理点击事件
	 * @param type $data 微信消息体
	 */
	private function click($data){
		$eventKey = $data->EventKey;
		switch($eventKey){
			case 'V142857_Mine':
				$posts = array();
				$posts[] = array(
					'title' => '德克士（万体店）',
					'picurl' =>
						'http://e.hiphotos.baidu.com/bainuo/crop=0,0,720,451;w=690;q=89;c=nuomi,95,95/sign=d0a67e82163853439880dd61ae239c4e/48540923dd54564e77d469d7b5de9c82d0584faf
.jpg',
					'url' => 'http://shixun.bs.ecnu.edu.cn/wwwroot/smda/web/takeout/forecast.php?shopid=1454382456&shopname=德克士（万体
店）',
				);
				$posts[] = array(
					'title' => '超级鸡车（天钥桥店）',
					'picurl' => 'https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=144817283,1299499292&fm=23&gp=0.jpg',
					'url' => 'http://shixun.bs.ecnu.edu.cn/wwwroot/smda/web/takeout/forecast.php?shopid=1447331829&shopname=超级鸡车（天
钥桥店）',
				);
				$posts[] = array(
					'title' => 'CoCo都可（天钥桥店）',
					'picurl' => 'https://timgsa.baidu.com/timg?
image&quality=80&size=b9999_10000&sec=1490720828858&di=4f219b823f713e3be1a5621e5f7c76f1&imgtype=0&src=http%3A%2F%2Fimages4.c-ctrip.com%2Ftarget%2Ffd%
2Ftuangou%2Fg6%2FM07%2F5E%2F46%2FCggYtFbqXXaAIBPbAAA5wgxCSPw025_720_480_s.jpg',
					'url' => 'http://shixun.bs.ecnu.edu.cn/wwwroot/smda/web/takeout/forecast.php?shopid=1545221518&shopname=CoCo都可（天
钥桥店）',
				);
				$xml = $this->outputNews($posts);
				header('Content-Type: application/xml');
				echo $xml;
				break;
			default:
				getStore($data);
				break;
		}
	}

	private function getStore($input){
		$conn = mysql_connect('222.204.246.156', 'mysqlsmda', '123456') or die("connect failed" . mysql_error());
		mysql_query("set names 'utf8'");
		mysql_select_db('smda', $conn);
		$sql = sprintf("select shop_name,shop_id from tb_baiduwaimaishop where shop_name like '%%%s%%' limit 0,5", $input);
		$result = mysql_query($sql,$conn);
		$posts = array();
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			$posts[] = array(
				'title' => $row[0],
				'picurl' =>
					'http://e.hiphotos.baidu.com/bainuo/crop=0,0,720,451;w=690;q=89;c=nuomi,95,95/sign=d0a67e82163853439880dd61ae239c4e/48540923dd54564e77d469d7b5de9c82d0584faf
.jpg',
				'url' => 'http://shixun.bs.ecnu.edu.cn/wwwroot/smda/web/takeout/forecast.php?shopid='.$row[1].'&shopname='.$row[0],
			);
		}

		//$this->text($resultname);

		$xml = $this->outputNews($posts);
		header('Content-Type: application/xml');
		echo $xml;
	}


	/**
	 * Pre processing锛宑ommon usage:save the request into your database.
	 * Because weixin save your msgs only 5 days.
	 * @return boolean
	 */
	protected function beforeProcess($postData) {

		return true;
	}

	protected function afterProcess() {
	}

	public function errorHandler($errno, $error, $file = '', $line = 0) {
		$msg = sprintf('%s - %s - %s - %s', $errno, $error, $file, $line);
	}

	public function errorException(Exception $e) {
		$msg = sprintf('%s - %s - %s - %s', $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
	}

	private function saveRequest($request) {

	}

}




