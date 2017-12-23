<?php

//签到控制器
namespace Home\Controller;

use Think\Controller;

class SignController extends Controller {
    /*
     * 签到
     * @return json
     */

    public function sign() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '' || $arrUser["x"] == '' || $arrUser["y"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if (!$intCheck) {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
        $arrData["user_id"] = $arrUser["user_id"];
        $arrData["time"] = date("Y-m-d H:i:s");
        if ($arrData["time"] > (date("Y-m-d") . " 12:00:00") && $arrData["time"] < (date("Y-m-d") . " 18:00:00")) {
            $arrData["mon_after"] = "2";
        } else if ($arrData["time"] > (date("Y-m-d") . " 18:00:00")) {
            $arrData["mon_after"] = "3";
        } else {
            $arrData["mon_after"] = "1";
        }
        $arrWeek = array("日", "一", "二", "三", "四", "五", "六");
        $arrData["week"] = $arrWeek[date("w")];
        $arrData["x"] = $arrUser["x"];
        $arrData["y"] = $arrUser["y"];
        $arrData["remarks"] = $arrUser["remarks"];
        $objSign=D('sign');
        $objSign->startTrans();
        //公司签到
        if ($arrUser["type"] == '1') {
            //如果place为空,说明是得去数据库的表查询地点
            if ($arrUser["place"] == '') {
                $place = D("place")->select();
                foreach ($place as $k => $v) {
                    if ($v["x1"] > $v["x2"]) {
                        $s = $v["x1"];
                        $v["x1"] = $v["x2"];
                        $v["x2"] = $s;
                    }
                    if ($v["y1"] > $v["y2"]) {
                        $s = $v["y1"];
                        $v["y1"] = $v["y2"];
                        $v["y2"] = $s;
                    }
                    if ((($arrUser["x"] >= $v["x1"]) && ($arrUser["x"] <= $v["x2"])) && (($arrUser["y"] >= $v["y1"]) && ($arrUser["y"] <= $v["y2"]))) {
                        $arrData["place"] = $v["place"];
                        break;
                    }
                }
                if ($arrData["sign_id"] = $objSign->add($arrData)) { 
                    $objSign->commit();
                    echo returnApiCheck("200", "签到成功");
                } else {
                    $objSign->rollback();
                    echo returnApiCheck("500", "签到失败");
                    return false;
                }
            } else {//有地点
                $arrData["place"] = $arrUser["place"];
                if ($arrData["sign_id"] = $objSign->add($arrData)) {  
                    $objSign->commit();
                    echo returnApiCheck("200", "签到成功");
                } else {
                    $objSign->rollback();
                    echo returnApiCheck("500", "签到失败");
                    return false;
                }
            }
        }
        //外勤签到
        else {
            $arrData["place"] = $arrUser["place"];
            if ($arrData["sign_id"] = $objSign->add($arrData)) {        
                $objSign->commit();
                echo returnApiCheck("200", "签到成功");
            } else {
                $objSign->rollback();
                echo returnApiCheck("500", "签到失败");
                return false;
            }
        }
    }

    /*
     *   签到记录
     * @return json
     */

    public function see() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if (!$intCheck) {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
        $strDate = $arrUser['date'];
        $strSql = "select time,week,x,y,place,remarks from tb_sign  where time like '%$strDate%' and user_id='" . $arrUser["user_id"] . "' order by time desc";
        $arrData = D("sign")->query($strSql);
        if ($arrData == 'false') {
            echo returnApiCheck('500', '查询失败');
            return false;
        }
        if ($arrData[0] == null) {
            echo returnApiCheck("400", "无记录");
            return false;
        } else {
            echo returnApiSuccess("200", "请求成功", $arrData);
        }
    }
    /*
     * 签到天数
     * @return json
     */
    public function date() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if (!$intCheck) {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
        $strDate = date("Y-m");
        $strSql = "select time from tb_sign  where time like '%$strDate%' and user_id='" . $arrUser["user_id"] . "' order by time desc";
        $arrData = D("sign")->query($strSql);
        if ($arrData == 'false') {
            echo returnApiCheck('500', '查询失败');
            return false;
        }
        if ($arrData[0] == null) {
            echo returnApiCheck("500", "请求失败");
            return false;
        } else {
            echo returnApiSuccess("200", "请求成功", $arrData);
        }
    }

}
