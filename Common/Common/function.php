<?php

/**
 * 邮件发送函数
 */
function sendMail($to, $title, $content) {

    Vendor('PHPMailer.PHPMailerAutoload');   
    $mail = new PHPMailer(); //实例化
    $mail->isSMTP(); // 启用SMTP
    $mail->Port = 25;//端口
    $mail->SMTPSecure = "ssl"; 
    $mail->SMTPDebug  = 1; 
    $mail->Host = C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD'); //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->addAddress($to);
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->isHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet = C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject = $title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    if(!$mail->send()){
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else{
        echo "fdas";
    }
}

//身份认证
function check($user_id, $token) {
    $u = D("users")->where("id='" . $user_id . "'")->field("token")->select();  
    if ($u[0]["token"] == $token) {
        return 1;
    } else {
        return 0;
    }
}

//管理员权限认证
function power($token, $user_id) {
    $sql = "select b.level from tb_users as a,tb_role as b,tb_user_role as c where a.token='" . $token . "' and a.id='" . $user_id . "' and a.id=c.user_id and b.id=c.role_id ";
    $row = D("role")->query($sql);
    if ($row == 'false') {
        return 0;
        exit;
    }
    if ($row[0]['level'] == '1') {
        return 1;
    } else {
        return 0;
    }
}

//照片存储
function picture($urls,$re,$r,$p) {
    $upload = new \Think\Upload(); // 实例化上传类
    $upload->maxSize = 8145728; // 设置附件上传大小
    $upload->autoSub = false;
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
    $upload->rootPath = './Public/' . "$urls" . '/'; // 设置附件上传根目录
    $upload->savePath = ''; // 设置附件上传（子）目录
    // 上传文件 
    $info = $upload->upload();
    $id=$r[0];
    $bo=$r[1];
    $rel["$id"]=$re;
    //return $info;
    if (!$info) {// 上传错误提示错误信息
        return "0";
        return false;
    } else {// 上传成功
        foreach ($info as $file) {
            //echo $_SERVER['HTTP_HOST'];
            $url["pic_url"] = "http://".$_SERVER['HTTP_HOST']."/Public/$urls/".$file['savename'].""; 
            //$url["pic_url"] = "http://110.64.211.42/Public/$urls/".$file['savename']."";         
            if ($rel["pic_id"] = D("$p")->add($url)) {
                if (D("$bo")->add($rel)) {
                    
                } else {
                    return "0";
                    return false;
                }
            } else {
                return "0";
                return false;
            }
        }
    }
    return "1";
}
//查询成功，返回数据
function returnApiSuccess($flag=null,$msg=null,$data=array()){
    $result=array(
        'flag'=>$flag,
        'msg'=>$msg,
        'data'=>$data
    );
    return json_encode($result);
}
//操作判断
function returnApiCheck($flag=null,$msg=null){
    $result=array(
        'flag'=>$flag,
        'msg'=>$msg
    );
    return json_encode($result);
}
//接收json数据
function getData(){
    $user=$_POST;
    $user=  json_decode($user["args"]);
    $data=(array)$user;
    return $data;
}

