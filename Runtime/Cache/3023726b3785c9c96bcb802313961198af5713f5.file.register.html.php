<?php /* Smarty version Smarty-3.1.6, created on 2016-05-06 12:38:34
         compiled from "D:/xampp/htdocs/office/Home/View\Index\register.html" */ ?>
<?php /*%%SmartyHeaderCode:27127572c1fca488e72-23498300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3023726b3785c9c96bcb802313961198af5713f5' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\register.html',
      1 => 1462344113,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27127572c1fca488e72-23498300',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572c1fca67136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572c1fca67136')) {function content_572c1fca67136($_smarty_tpl) {?><!DOCTYPE html>
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
/Login/register" method="post">
            用户名：<input type="text" name="user_name"/><br>
            密码:<input type="text" name="user_pass"/><br>            
            邮箱:<input type="text" name="email"/><br>
            <input type="submit" value="注册"/>
        </form>
    </body>
</html>
<?php }} ?>