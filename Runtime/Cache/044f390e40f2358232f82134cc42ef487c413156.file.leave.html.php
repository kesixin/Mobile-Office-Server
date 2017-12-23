<?php /* Smarty version Smarty-3.1.6, created on 2016-06-05 12:29:40
         compiled from "D:/xampp/htdocs/office/Home/View\Index\leave.html" */ ?>
<?php /*%%SmartyHeaderCode:8517572d80cebdfd96-65672783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '044f390e40f2358232f82134cc42ef487c413156' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\leave.html',
      1 => 1465100977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8517572d80cebdfd96-65672783',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572d80cecf14d',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572d80cecf14d')) {function content_572d80cecf14d($_smarty_tpl) {?><!DOCTYPE html>
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
/Approval/app_leave" method="post" enctype="multipart/form-data">
            请假类型：<input type="radio" name="type" value="事假"/>事假 
            <input type="radio" name="type" value="病假"/>病假<br><br>
            开始时间：<input type="text" name="start"/><br><br>
            结束时间：<input type="text" name="end"/><br><br>
            请假天数:<input type="text" name="day"/><br><br>
            请假事由:<textarea name="reason"></textarea><br><br>
            审批人：<input type="text" name="approver"/><br><br>
            
            <input type="hidden" name="user_id" value="51"/><br><br>
            <input type="hidden" name="token" value="1cf369faa9b8f1f5845d94025b0528a3"/>
            <input type="hidden" name="app_type" value="1"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>
<?php }} ?>