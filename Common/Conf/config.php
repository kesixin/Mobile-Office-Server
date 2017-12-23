<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE' => 'mysql',     // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'move',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => 'root',          // 密码
    'DB_PORT' => '3306',        // 端口
    'DB_PREFIX' => 'tb_',    // 数据库表前缀
    'DB_CHARSET' => 'utf8',     // 数据库编码默认采用utf8
       
    'TMPL_ENGINE_TYPE'      =>  'Smarty', 
    
    // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.sina.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'kesixin@sina.com',//你的邮箱名
    'MAIL_FROM' =>'kesixin@sina.com',//发件人地址
    'MAIL_FROMNAME'=>'kesixin@sina.com',//发件人姓名
    'MAIL_PASSWORD' =>'aa18819201898aa',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

);