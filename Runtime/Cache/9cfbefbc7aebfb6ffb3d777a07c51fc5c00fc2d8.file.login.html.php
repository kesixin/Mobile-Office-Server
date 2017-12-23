<?php /* Smarty version Smarty-3.1.6, created on 2016-05-05 21:08:28
         compiled from "D:/xampp/htdocs/office/Home/View\Index\login.html" */ ?>
<?php /*%%SmartyHeaderCode:7482572b3d4e074d64-83873676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cfbefbc7aebfb6ffb3d777a07c51fc5c00fc2d8' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\login.html',
      1 => 1462453699,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7482572b3d4e074d64-83873676',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572b3d4e0f1d7',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572b3d4e0f1d7')) {function content_572b3d4e0f1d7($_smarty_tpl) {?><!DOCTYPE html>
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
        <form action="<?php echo @__MODULE__;?>
/Index/index" method="post">
            用户名：<input type="text" name="user_name"/><br>
            密码：<input type="password" name="user_pass"/><br>
            <input type="submit" value="登录"/>
        </form>
    </body>
</html>
<?php }} ?>