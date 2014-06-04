<?php
class MailModel {
    protected $mail;
    public function __construct($email,$password,$name) {
        require_once(dirname(__FILE__).'/phpmailer/class.phpmailer.php');
        $this->mail = new PHPMailer(); //实例化
        $this->mail->IsSMTP(); // 启用SMTP
        $this->mail->Host = "smtp.exmail.qq.com"; //SMTP服务器
        $this->mail->Port = 25;  //邮件发送端口
        $this->mail->SMTPAuth   = true;  //启用SMTP认证
        $this->mail->CharSet  = "UTF-8"; //字符集
        $this->mail->Encoding = "base64"; //编码方式
        $this->mail->Username = $email;
        $this->mail->Password = $password;
        $this->mail->From = $email;
        $this->mail->FromName = $name;
    }

    public function send($address,$nickname,$title,$boby,$attachment = null){
        $this->mail->AddAddress($address,$nickname);//添加收件人（地址，昵称）
        $this->mail->IsHTML(true);
        $this->mail->Subject = $title;
        $this->mail->Body = $boby;
        if($attachment){
            $this->mail->AddAttachment(dirname(__FILE__)."/attachement/".$attachement); // 添加附件,并指定名称 
        }
        if(!$this->mail->Send()) {
            $data['info'] = "发送失败: " .$this->mail->ErrorInfo;
            echo json_encode($data);
        }
    }
}