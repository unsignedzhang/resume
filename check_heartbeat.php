<?php
// 设置心跳超时时间（例如，1分钟）
define('HEARTBEAT_TIMEOUT', 60);

// 遍历心跳记录目录
$heartbeatDir = 'heartbeats/';
if ($handle = opendir($heartbeatDir)) {
    while (false !== ($entry = readdir($handle))) {
        if (pathinfo($entry, PATHINFO_EXTENSION) === 'txt') {
            // 获取用户的IP地址
            $userId = pathinfo($entry, PATHINFO_FILENAME);

            // 获取用户的心跳记录文件路径
            $heartbeatFilePath = "{$heartbeatDir}{$entry}";

            // 读取用户的心跳记录
            $heartbeatContent = file_get_contents($heartbeatFilePath);
            $heartbeats = explode("\n", $heartbeatContent); // PHP_EOL 用于跨平台的换行符

            // 确保数组中至少有一个元素
            if (count($heartbeats) > 0) {
                // 获取最后一个心跳时间戳，排除最后的换行符
                $lastHeartbeatTime = intval($heartbeats[count($heartbeats) - 2]);
                // 获取第一个心跳时间戳
                $firstHeartbeatTime = intval($heartbeats[0]);

                // 检查最后心跳时间是否超过超时时间
                if ((time() - $lastHeartbeatTime) > HEARTBEAT_TIMEOUT) {
                    // 计算会话持续时间
                    $sessionDuration = $lastHeartbeatTime - $firstHeartbeatTime;

                    // 记录访问时长
                    recordSessionDuration($userId, $sessionDuration);

                    // 删除用户的心跳记录文件
                    unlink($heartbeatFilePath);
                }
            }
        }
    }
}
closedir($handle);

function recordSessionDuration($userId, $duration) {
	//引入配置文件
	$config = include 'config.php';
	// 引入邮箱类
	include 'mail.php';
	//初始化邮件发送信息及收件人
	$mailReceiver = "你的邮箱地址";//发送给谁
	$mailSubject = "您的简历已被浏览完毕!";//邮件主题
	$mailContent = "浏览时长：".$duration." s";//邮件内容
	send_email($to=$mailReceiver, $subject=$mailSubject, $content=$mailContent);
    // 记录用户的访问时长到日志文件
    //$logEntry = date('Y-m-d H:i:s') . " - IP: {$userId} - Duration: {$duration} seconds\n";
    //file_put_contents('session_durations.log', $logEntry, FILE_APPEND);
}
?>