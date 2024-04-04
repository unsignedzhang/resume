<?php
// **********发件人配置************
$config['mailUsername']  = ''; //邮箱发件人账号
$config['mailPassword']  = ''; //邮箱发件人SMTP密码
$config['mailFromName']  = ''; //邮箱发件人昵称
$config['mailHost']      = 'smtp.qq.com'; //邮箱服务器
$config['mailPort']      = '465'; //邮箱端口号，以qq邮箱为例，若不使用SSL加密方式则端口号为25，否则为465

// ***********发件内容及收件人配置******
$config['mailReceiver']  = '收件邮箱'; //收件人配置，可设置单个收件人，若需多个收件人则以数组['***', '***']形式。
$config['mailSubject']   = '邮件主题'; //所发邮件主题
$config['mailContent']   = '邮件内容'; //所发邮件内容

return $config;
?>