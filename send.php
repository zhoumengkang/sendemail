<?php
set_time_limit(0);
require_once(dirname(__FILE__).'/mailmodel.php');

//从数据库取出所有联系人信息
$con = mysql_connect("localhost","root","zmkzmk");
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('contact'); 
$result = mysql_query("set names 'utf8'");
$totalNumRes =  mysql_query("select count(*) as num from `test`");
while($row = mysql_fetch_assoc($totalNumRes)){
    $totalNum = $row['num'];
}
$page = intval($_POST['page']) ? intval($_POST['page']) : 0;

//这就是最后一封了
if(intval($totalNum) - intval($page) <2){
    $data['flag'] = 1;
}

$num = 1;
$start = 0 + ($num*$page);
$sql = "select `id`,`email`,`name` from `test` order by id asc limit {$start} , {$num}";
$result = mysql_query($sql); 

//导入配置
$configArr = include dirname(__FILE__).'/config.php';

$mailmodel = new MailModel($configArr['email'],$configArr['password'],$configArr['name']);

while($row = mysql_fetch_assoc($result)){
    $email = trim($row['email']);
    $data['info'] =  '<div> '.$row['name'].' : '.$email.' </div>';
    if($configArr['attachment']){
        $mailmodel->send($email,$row['name'],$configArr['title'],$configArr['body'],$configArr['attachment']);
    }else{
        $mailmodel->send($email,$row['name'],$configArr['title'],$configArr['body']);
    }
    
    echo json_encode($data);
    //数据库里做标记
    $sql = "INSERT INTO `mark` (`uid`) VALUES (".$row['id'].")";
    mysql_query($sql);
}

mysql_close($con);