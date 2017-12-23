<?php /* Smarty version Smarty-3.1.6, created on 2016-05-07 13:44:21
         compiled from "D:/xampp/htdocs/office/Home/View\Index\approval.html" */ ?>
<?php /*%%SmartyHeaderCode:4196572d80b5c01544-83792613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e173fc04fe5b48569137e22cad0cc08487ae3ad' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\approval.html',
      1 => 1461116633,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4196572d80b5c01544-83792613',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572d80b5e66a5',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572d80b5e66a5')) {function content_572d80b5e66a5($_smarty_tpl) {?><!DOCTYPE html>
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
/Approval/approval" method="post">
            <input type="radio" value="1" name="state"/>同意
            <input type="radio" value="2" name="state"/>不同意<br>
            评论：<input type="text" name="view" />
            <input type="hidden" name="token" value="69ab755f00875231953814393662aabb"/>
            <input type="hidden" name="app_id" value="33"/>
            <input type="hidden" name="user_id" value="49"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>
<?php }} ?>