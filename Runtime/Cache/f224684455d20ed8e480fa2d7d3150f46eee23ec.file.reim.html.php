<?php /* Smarty version Smarty-3.1.6, created on 2016-06-01 19:03:00
         compiled from "D:/xampp/htdocs/office/Home/View\Index\reim.html" */ ?>
<?php /*%%SmartyHeaderCode:24730572d855ce018d9-93459964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f224684455d20ed8e480fa2d7d3150f46eee23ec' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\reim.html',
      1 => 1462601172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24730572d855ce018d9-93459964',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572d855ced868',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572d855ced868')) {function content_572d855ced868($_smarty_tpl) {?><!DOCTYPE html>
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
            审批人：<input type="text" name="approver"/><br><br>   
            <input type="file" name="file1"/>
            <input type="file" name="file2"/>
            <input type="file" name="file3"/>
            <input type="hidden" name="user_id" value="51"/><br><br>
            <input type="hidden" name="token" value="1cf369faa9b8f1f5845d94025b0528a3"/>
            <input type="hidden" name="app_type" value="2"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>
<?php }} ?>