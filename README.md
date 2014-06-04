**程序结构以及文件介绍**

```
├── attachment                //附件存放目录
│   └── attachment.txt        //附件demo
├── config.php                //发送邮箱的账号密码配置，以及邮件群发的内容
├── index.html                //请求该文件开始循环发送
├── mailmodel.php             //邮件处理类
├── phpmailer                 //phpmailer扩展
│   ├── class.phpmailer.php
│   ├── class.pop3.php
│   └── class.smtp.php
└── send.php                  //index.html ajax 请求的文件
```

**需要配合的数据库**
数据库名：`contact`
数据库建表：`contact`

```sql
SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+08:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
 
DROP TABLE IF EXISTS contact;
CREATE TABLE test (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```
