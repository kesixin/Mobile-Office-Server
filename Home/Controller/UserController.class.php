<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller {
    /*
     * 修改用户资料
     * @return json
     */

    public function update() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if ($intCheck) {
            foreach ($arrUser as $k => $v) {
                if ($k != "user_id" && $k != "token") {
                    $objUsers = D('users');
                    $objUsers->startTrans();
                    $intJudge = $objUsers->where("id='" . $arrUser['user_id'] . "'")->setField($k, $v);
                    if ($intJudge) {
                        $objUsers->commit();
                        echo returnApiCheck('200', '修改成功');
                    } else {
                        $objUsers->rollback();
                        echo returnApiCheck('500', '修改失败');
                        return false;
                    }
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }
    /*
     * 用户头像上传
     * @return json
     */
    public function head() {
        $arrUser = getData();
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if (!$intCheck) {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->autoSub = false;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->rootPath = './Public/' . "User" . '/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件 
        $intInfo = $upload->upload();
        if (!$intInfo) {// 上传错误提示错误信息
            echo returnApiCheck('500', '上传失败');
            return false;
        } else {
            foreach ($intInfo as $file) {
                $arrUrl["user_id"] = $arrUser["user_id"];
                $arrUrl["pic_url"] = "http://".$_SERVER['HTTP_HOST']."/Public/User/" . $file['savename'] . "";
                $objPic = D("user_pic");
                $objPic->startTrans();
                $intJudge = $objPic->where("user_id='" . $arrUser['user_id'] . "'")->setField('pic_url', $arrUrl['pic_url']);
                if ($intJudge) {
                    $objPic->startTrans();
                    $arrData=$objPic->where("user_id".$arrUser['user_id']);
                    echo returnApiCheck('200', '上传成功');
                } else {
                    $objPic->rollback();
                    echo returnApiCheck('500', '上传失败');
                    return false;
                }
            }
        }
    }
    /*
     * 查询用户资料
     * @return json
     */
    public function userInfo(){
        $arrUser=  getData();
        $intCheck=  check($arrUser["user_id"], $arrUser["token"]);
        if($intCheck){
            $strSql="select u.id,u.name,u.email,u.mobile,u.sex,u.birthday,u.token,t.role_name,t.level,p.pic_url from "
                    . "tb_users u,tb_user_role r,tb_user_pic p,tb_role t where u.id='".$arrUser['user_id']."' and "
                    . "u.id=r.user_id and u.id=p.user_id and t.id=r.role_id";
            $arrData=D("Users")->query($strSql);
            if($arrData=='false'){
                echo returnApiCheck('500','查询失败');
            }
            echo returnApiSuccess('200', '查询成功', $arrData[0]);
        }else{     
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }
}
