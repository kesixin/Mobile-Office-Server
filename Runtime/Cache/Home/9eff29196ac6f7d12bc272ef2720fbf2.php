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
        <form action="<?php echo ($smarty["const"]["/index.php/Home"]); ?>/Announce/issue" method="post" enctype="multipart/form-data">
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