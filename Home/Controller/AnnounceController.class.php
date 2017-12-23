<?php

//公告控制器

namespace Home\Controller;

use Think\Controller;

class AnnounceController extends Controller {
    /*
     * 发布公告
     * @return json
     */

    public function issue() {
        $arrUser = getData();
        if ($arrUser['title'] == '' || $arrUser['content'] == '' || $arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiError("400", "参数有误");
            return false;
        }
        $intPower = power($arrUser["token"], $arrUser['user_id']);
        if ($intPower) {
            $arrUser['create_time'] = date("Y-m-d H:i:s");
            $arrRoot[0] = "announce_id";
            $arrRoot[1] = "announce_pic_rel";
            $objAnn = D("announce");
            $objAnn->startTrans();
            $arrRel['announce_id'] = $objAnn->add($arrUser);
            if ($_FILES != null) {
                $intInfo = picture("Announce", $arrRel['announce_id'], $arrRoot, "announce_pic");
                if ($intInfo && $arrRel["announce_id"]) {
                    $objAnn->commit();
                    echo returnApiCheck("200", "发布成功");
                } else {
                    $objAnn->rollback();
                    echo returnApiCheck("500", "发布失败");
                }
            } else {
                if ($arrRel["announce_id"]) {
                    $objAnn->commit();
                    echo returnApiCheck("200", "发布成功");
                } else {
                    $objAnn->rollback();
                    echo returnApiCheck("500", "发布失败");
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查看公告
     * @return json
     */

    public function see() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if ($intCheck) {
            $strSql = "select a.id,a.title,a.content,a.create_time,u.user_name,p.pic_url from tb_users as u,tb_announce as a,tb_user_pic as p where p.user_id=u.id and u.id=a.user_id  ORDER BY a.id desc ";
            $arrData = D("announce")->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            $arrId = D("announce_read")->where("user_id='" . $arrUser['user_id'] . "'")->field("announce_id")->select();
            if ($arrId == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            foreach ($arrData as $k => $v) {
                foreach ($arrId as $k1 => $v1) {
                    if ($v["id"] == $v1["announce_id"]) {
                        $arrData[$k]['state'] = '1';
                        break;
                    }
                }
                if ($arrData[$k]['state'] == '') {
                    $arrData[$k]['state'] = '0';
                }
                $strSql2 = "select p.pic_url from tb_announce_pic_rel r,tb_announce_pic p where r.pic_id=p.id and r.announce_id='" . $v["id"] . "'";
                $arrPic = D("announce_pic_rel")->query($strSql2);
                if ($arrPic == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                if ($arrPic[0] == null) {
                    $arrData[$k]['ann_pic_url'] = '';
                } else {
                    foreach ($arrPic as $k2 => $v2) {
                        if ($arrData[$k]['ann_pic_url'] == '') {
                            $arrData[$k]['ann_pic_url'] = $v2["pic_url"];
                        } else {
                            $arrData[$k]['ann_pic_url'] = $arrData[$k]['ann_pic_url'] . ',' . $v2["pic_url"];
                        }
                    }
                }
            }
            echo returnApiSuccess("200", "请求成功", $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 记录用户阅读的公告
     * @return json
     */

    public function read() {
        $arrUser = getData();
        //$arrUser=$_GET;
        if ($arrUser["user_id"] == '' || $arrUser["announce_id"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $objRead = D("announce_read");
        $objRead->startTrans();
        if ($objRead->add($arrUser)) {
            $objRead->commit();
            echo returnApiCheck("200", "请求成功");
        } else {
            $objRead->rollback();
            echo returnApiCheck("500", "请求失败");
            return false;
        }
    }

    /*
     * 删除公告
     * @return json
     */

    public function delete() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '' || $arrUser['announce_id'] == '') {
            echo returnApiCheck("400", "请求参数有误");
            return false;
        }
        $intPower = power($arrUser["token"], $arrUser['user_id']); //权限认证
        if ($intPower) {
            $objAnn = D("announce");
            $objRel = D("announce_pic_rel");
            $objRead = D("announce_read");
            $objAnn->startTrans();
            $strSql1 = "delete a from tb_announce a where a.id='" . $arrUser['announce_id'] . "'";
            $strSql3 = "select p.pic_url from tb_announce_pic p, tb_announce_pic_rel r where r.announce_id='" . $arrUser['announce_id'] . "' and r.pic_id=p.id";
            $arrPic_id = D("announce_pic_rel")->query($strSql3);
            if ($arrPic_id == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            if ($arrPic_id[0] != null) {
                foreach ($arrPic_id as $k => $v) {
                    $str = substr($v["pic_url"], strrpos($v["pic_url"], "/"));
                    $str = "./Public/Announce" . $str;
                    unlink($str);
                }
                $strSql2 = "delete r,p from tb_announce_pic_rel r,tb_announce_pic p where p.id=r.pic_id and r.announce_id='" . $arrUser['announce_id'] . "'";
                $intRes1 = $objRel->execute($strSql2);
                $intRes2 = $objAnn->execute($strSql1);
                $arrId = $objRead->where("announce_id='" . $arrUser['announce_id'] . "'")->field("id")->select();
                if ($arrId == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                if ($arrId[0] != null) {
                    $intRes3 = $objRead->where("announce_id='" . $arrUser['announce_id'] . "'")->delete();
                    if ($intRes1 && $intRes2 && $intRes3) {
                        $objAnn->commit();
                        echo returnApiCheck("200", "删除成功");
                    } else {
                        $objAnn->rollback();
                        echo returnApiCheck("500", "删除失败");
                        return false;
                    }
                } else {
                    if ($intRes1 && $intRes2) {
                        $objAnn->commit();
                        echo returnApiCheck("200", "删除成功");
                    } else {
                        $objAnn->rollback();
                        echo returnApiCheck("500", "删除失败");
                        return false;
                    }
                }
            } else {
                $intRes1 = $objAnn->execute($strSql1);
                $arrId = $objRead->where("announce_id='" . $arrUser['announce_id'] . "'")->field("id")->select();
                if ($arrId == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                if ($arrId[0] != null) {
                    $intRes2 = $objRead->where("announce_id='" . $arrUser['announce_id'] . "'")->delete();
                    if ($intRes1 && $intRes2) {
                        $objAnn->commit();
                        echo returnApiCheck("200", "删除成功");
                    } else {
                        $objAnn->rollback();
                        echo returnApiCheck("500", "删除失败");
                        return false;
                    }
                } else {
                    $objAnn->commit();
                    echo returnApiCheck("200", "删除成功");
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

}
