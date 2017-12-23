<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="<?php echo ($smarty["const"]["/index.php/Home"]); ?>/Login/login" method="post">
            用户名：<input type="text" name="user_name"/><br>
            密码：<input type="password" name="user_pass"/><br>
            <input type="submit" value="登录"/>
        </form>
    </body>
</html>