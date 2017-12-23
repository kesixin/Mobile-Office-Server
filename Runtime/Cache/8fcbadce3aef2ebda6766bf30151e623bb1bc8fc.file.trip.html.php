<?php /* Smarty version Smarty-3.1.6, created on 2016-06-02 12:29:08
         compiled from "D:/xampp/htdocs/office/Home/View\Index\trip.html" */ ?>
<?php /*%%SmartyHeaderCode:1751574fb614296267-94316736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8fcbadce3aef2ebda6766bf30151e623bb1bc8fc' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\trip.html',
      1 => 1461737891,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1751574fb614296267-94316736',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_574fb61430f40',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574fb61430f40')) {function content_574fb61430f40($_smarty_tpl) {?><!DOCTYPE html>
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
/Approval/apply" method="post" enctype="multipart/form-data">            
            请假天数:<input type="text" name="day"/><br><br>
            请假事由:<textarea name="reason"></textarea><br><br>
            审批人：<input type="text" name="approver"/><br><br>
            <input type="file" name="file1"/>
            <input type="file" name="file2"/>
            <input type="file" name="file3"/>
            <input type="hidden" name="user_id" value="51"/><br><br>
            <input type="hidden" name="token" value="1cf369faa9b8f1f5845d94025b0528a3"/>
            <input type="hidden" name="app_type" value="3"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>
<?php }} ?>