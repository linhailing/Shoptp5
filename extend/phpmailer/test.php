<?php
/**
* by www.phpddt.com
*/
header("content-type:text/html;charset=utf-8");
ini_set("magic_quotes_runtime",0);
require 'Phpmailer.php';
require 'Smtp.php';
date_default_timezone_set('PRC');
try {
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	//$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
	$mail->SMTPAuth   = true;                  //开启认证
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
	$mail->Port       = 25;
	$mail->Host       = "smtp.163.com";
	$mail->Username   = "henrylin2015@163.com";
	$mail->Password   = "Lhl883236";
	//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
	//$mail->AddReplyTo("henrylin2015@163.com","henry");//回复地址
	//$mail->From       = "henrylin2015@163.com";
	//$mail->FromName   = "www.phpddt.com";
	$mail->setFrom('henrylin2015@163.com','henry');
	$to = "462211958@qq.com";
	$mail->AddAddress($to,'henry');
	$mail->Subject  = "phpmailer测试标题";
//	$mail->Body = "test.....";
//	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
//	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	//$mail->IsHTML(true);
    $mail->msgHTML('TEST....');
	$mail->Send();
	echo '邮件已发送';
} catch (phpmailerException $e) {
	echo "邮件发送失败：".$e->errorMessage();
}
?>