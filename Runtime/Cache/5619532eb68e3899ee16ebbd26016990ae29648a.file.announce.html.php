<?php /* Smarty version Smarty-3.1.6, created on 2016-05-05 20:11:41
         compiled from "D:/xampp/htdocs/office/Home/View\Index\announce.html" */ ?>
<?php /*%%SmartyHeaderCode:27749572b387d408cf8-28590220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5619532eb68e3899ee16ebbd26016990ae29648a' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\announce.html',
      1 => 1461681722,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27749572b387d408cf8-28590220',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572b387d57bed',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572b387d57bed')) {function content_572b387d57bed($_smarty_tpl) {?><!DOCTYPE html>
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
/Announce/issue" method="post" enctype="multipart/form-data">
            标题：<input type="text" name="title"/><br>
            内容:<textarea name="content"></textarea><br>
            <input type="hidden" value="50" name="user_id"/>
            <input type="hidden" value="2562bc5a1585da904a8ac89acf213a18" name="token"/>
            <input type="file" name="file1"/>
            <input type="file" name="file2"/>
            <input type="file" name="file3"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>
<?php }} ?>