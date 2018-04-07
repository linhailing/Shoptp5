<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 2018/4/7
 * Time: 19:20
 */
namespace phpmailer;
use \phpmailer\Phpmailer;

class Email{
    /**
     * @param $to 发送人邮件地址
     * @param $title 发送标题
     * @param $body 发送内容
     * @return bool
     */
    public static function send($to,$title,$body){
        date_default_timezone_set('PRC');
        try {
            $mail = new Phpmailer(true);
            $mail->IsSMTP();
            //$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
            $mail->SMTPAuth   = true;                  //开启认证
            //$mail->SMTPDebug = 2;
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
            $mail->AddAddress($to);
            $mail->Subject  = $title;
            //	$mail->Body = "test.....";
            //	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
            //	$mail->WordWrap   = 80; // 设置每行字符串的长度
            //$mail->AddAttachment("f:/test.png");  //可以添加附件
            //$mail->IsHTML(true);
            $mail->msgHTML($body);
            $mail->Send();
            return true;
        } catch (phpmailerException $e) {
            //echo "邮件发送失败：".$e->errorMessage();
            return false;
        }

    }
}