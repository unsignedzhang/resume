<?php
// 获取用户的IP地址作为文件名
$userId = $_SERVER['REMOTE_ADDR'];

// 用户的心跳记录文件路径
$heartbeatFilePath = "heartbeats/{$userId}.txt";

// 获取当前时间戳
$currentTime = time();

// 检查心跳记录文件是否存在，如果不存在则创建
// 同时发送邮件提醒
if (!file_exists($heartbeatFilePath)) {
    touch($heartbeatFilePath);
	error_reporting(0);
	$date = date("Y-m-d H:i:s", time());
	$ip = $_SERVER["REMOTE_ADDR"];
	$wz = urldecode(file_get_contents("http://unsignedzhang.cn/apis/ip/index.php?ip=".$ip));//获取ip对应地址，你也可以换成其他接口
	$ua = $_SERVER["HTTP_USER_AGENT"];
	//引入配置文件
	$config = include 'config.php';
	// 引入邮箱类
	include 'mail.php';
	//初始化邮件发送信息及收件人
	$mailReceiver = "你的邮箱地址";//发送给谁
	$mailSubject = "您的简历已被查看!";//邮件主题
	$mailContent = "查看时间：".$date .PHP_EOL . "<br>查看者ip：".$ip ."(".$wz.")". PHP_EOL . "<br>查看者设备：". $ua;//邮件内容
	send_email($to=$mailReceiver, $subject=$mailSubject, $content=$mailContent);
	}

// 将当前时间戳写入用户的心跳记录文件
file_put_contents($heartbeatFilePath, $currentTime . PHP_EOL, FILE_APPEND);

// 返回成功响应
header('Content-Type: application/json');
echo json_encode(array('status' => 'success', 'message' => 'Heartbeat received.'));
?>