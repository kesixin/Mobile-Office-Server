<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {
    /*
     * 用户登录
     * @return json
     */

    public function login() {
        $arrUser = getData();
        $strName = $arrUser["user_name"];
        $strPass = $arrUser["user_pass"];
        if ($strName == '' || $strPass == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $arrData = D('Users')->where("user_name='$strName'")->select();
        if ($arrData == null) {
            echo returnApiCheck("404", "用户名或者密码错误");
            return false;
        }
        if ($arrData[0]['user_pass'] == $strPass) {
            $strTime = date("Y-m-d H:i:s");
            $strToken = md5($arrUser['user_name'] . $arrUser['user_pass'] . $strTime);
            $strSql = "update tb_users set token='$strToken' where user_name ='" . $strName . "'";
            $objUsers = D('users');
            $objUsers->startTrans();
            $objUsers->rollback();
            $s = $objUsers->execute($strSql);
            if ($s) {
                $objUsers->commit();
            } else {
                $objUsers->rollback();
                echo returnApiCheck('500', '登录失败');
                return false;
            }
            $strNowtime = time();
            //账号还未激活
            if ($arrData[0]['status'] == '0' && $strNowtime < $arrData[0]['token_exptime']) {
                echo returnApiCheck("401", "账号未激活");
                return false;
            }
            //账号激活过期重新发送邮件
            else if ($arrData[0]['status'] == '0' && $strNowtime > $arrData[0]['token_exptime']) {
                if (sendMail($arrData[0]['email'], "active", "用户激活 http://www.office.com/index.php/Home/Login/active?verify={$arrData[0]['token']}")) {
                    $arrUser['token_exptime'] = time() + 60 * 60 * 24;
                    D('users')->where("user_name='$strName'")->setField("token_exptime", $arrUser['token_exptime']);
                    echo returnApiCheck("501", "邮件已重新发送"); //已经重新发送                   
                } else {
                    echo returnApiCheck("500", "服务器内部错误"); //发送失败
                    return false;
                }
            } else {
                $intId = $arrData[0]['id'];
                $strSql = "select u.id,u.name,u.email,u.mobile,u.sex,u.birthday,u.token,t.role_name,t.level,p.pic_url from "
                        . "tb_users u,tb_user_role r,tb_user_pic p,tb_role t where u.id='" . $intId . "' and "
                        . "u.id=r.user_id and u.id=p.user_id and t.id=r.role_id";
                $arrData = D("Users")->query($strSql);
                if ($arrData == 'false') {
                    echo returnApiCheck('500', '查询失败');
                }
                echo returnApiSuccess("200", "请求成功", $arrData[0]);
            }
        } else {
            echo returnApiCheck("404", "用户名或者密码错误");
            return false;
        }
    }

    /*
     * 用户注册
     * @return json
     */

    public function register() {
        $arrUser = getData();
        $user_name = $arrUser['user_name'];
        if ($arrUser['user_name'] == '' || $arrUser['user_pass'] == '' || $arrUser['email'] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        if (D('Users')->where("user_name='$user_name'")->select()) {
            echo returnApiCheck("406", "用户名已注册");
            return false;
        }
        $arrUser['create_date'] = date("Y-m-d H:i:s");
        $arrUser['status'] = '1';
        $arrUser['token'] = md5($arrUser['user_name'] . $arrUser['user_pass'] . $arrUser['create_date']);
        //$arrUser['token_exptime'] = time() + 60 * 60 * 24; //24小时后过期           
        $objUsers = D('users');
        $objRole = D('user_role');
        $objPic = D('user_pic');
        $objUsers->startTrans();
        $role['user_id'] = $objUsers->add($arrUser);
        $role['role_id'] = '2';
        $intS1 = $objRole->add($role);
        $intS2 = $objPic->add($role);
        if ($intS1 && $intS2 && $role['user_id']) {
            $objUsers->commit();
            echo returnApiCheck("200", "注册成功");
        } else {
            $objUsers->rollback();
            echo returnApiCheck("500", "服务器内部错误");
            return false;
        }
    }

    //激活账号
    public function active() {
        $verify = $_GET['verify'];
        $nowtime = time();
        $row = D('users')->query("select id,token_exptime from tb_users where status='0' and token='$verify'");
        if ($row) {
            if ($nowtime > $row[0]['token_exptime']) { //24hour 
                $msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
            } else {
                D('users')->execute("update tb_users set status=1 where id=" . $row[0]['id'] . "");
                $msg = '激活成功！';
                echo returnApiCheck("200", $msg);
                return;
            }
        } else {
            $msg = '服务器内部错误';
        }
        echo returnApiCheck("400", $msg);
    }

}
