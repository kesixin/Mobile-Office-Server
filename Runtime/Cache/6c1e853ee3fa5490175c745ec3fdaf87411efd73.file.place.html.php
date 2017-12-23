<?php /* Smarty version Smarty-3.1.6, created on 2016-05-08 16:56:32
         compiled from "D:/xampp/htdocs/office/Home/View\Index\place.html" */ ?>
<?php /*%%SmartyHeaderCode:22952572eff40eb9fb7-73681917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c1e853ee3fa5490175c745ec3fdaf87411efd73' => 
    array (
      0 => 'D:/xampp/htdocs/office/Home/View\\Index\\place.html',
      1 => 1462697707,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22952572eff40eb9fb7-73681917',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_572eff412717e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572eff412717e')) {function content_572eff412717e($_smarty_tpl) {?><!DOCTYPE html>
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
/Sign/sign" method="post" enctype="multipart/form-data">
            <input type="text" name="remarks"/>
            <input type="hidden" name="user_id" value="51"/>
            <input type="hidden" name="token" value="1cf369faa9b8f1f5845d94025b0528a3"/>
            <input type="hidden" name="type" value="1"/>
            
            <input type="hidden" name="x" value="113.619881"/>
            <input type="hidden" name="y" value="23.291085"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>
<?php }} ?>