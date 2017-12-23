<?php

//审批控制器

namespace Home\Controller;

use Think\Controller;

class ApprovalController extends Controller {
    /*
     * 申请请假
     * @return json
     */

    public function app_leave() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '' || $arrUser["app_type"] == '' || $arrUser["type"] == '' || $arrUser["start"] == '' || $arrUser["end"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if ($intCheck) {
            $arrApproval["app_type"] = $arrUser["app_type"];
            $arrApproval["user_id"] = $arrUser["user_id"];
            $arrApproval["approver"] = 'admin';
            $arrApproval["state"] = "0";
            $arrApproval["app_time"] = date("Y-m-d H:i:s");
            $objApp = D("approval");
            $objApp->startTrans();
            $intRes1 = $objApp->add($arrApproval);
            //申请请假          
            $objLeave = D("leave");
            $arrData["app_id"] = $intRes1;
            $arrData["type"] = $arrUser["type"];
            $arrData["start"] = $arrUser["start"];
            $arrData["end"] = $arrUser["end"];
            $arrData["day"] = $arrUser["day"];
            $arrData["reason"] = $arrUser["reason"];
            $intRes2 = $objLeave->add($arrData);
            //有无照片上传
            if ($_FILES != null) {
                $arrRoot[0] = "app_id";
                $arrRoot[1] = "leave_pic_rel";
                $intInfo = picture("Approval", $arrData["app_id"], $arrRoot, "approval_pic");
                if ($intRes1 && $intRes2 && $intInfo) {
                    $objApp->commit();
                    echo returnApiCheck("200", "申请成功");
                } else {
                    $objApp->rollback();
                    echo returnApiCheck("500", "申请失败");
                    return false;
                }
            } else {
                if ($intRes1 && $intRes2) {
                    $objApp->commit();
                    echo returnApiCheck("200", "申请成功");
                } else {
                    $objApp->rollback();
                    echo returnApiCheck("500", "申请失败");
                    return false;
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 申请报销
     * @return json
     */

    public function app_reim() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '' || $arrUser["app_type"] == '' || $arrUser['total'] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if ($intCheck) {
            $arrApproval["app_type"] = $arrUser["app_type"];
            $arrApproval["user_id"] = $arrUser["user_id"];
            $arrApproval["approver"] = 'admin';
            $arrApproval["state"] = "0";
            $arrApproval["app_time"] = date("Y-m-d H:i:s");
            $objApp = D("approval");
            $objApp->startTrans();
            $intRes1 = $objApp->add($arrApproval);
            foreach ($arrUser['explain'] as $i => $row) {
                $arrDet[$i]["money"] = $row->money;
                $arrDet[$i]["type"] = $row->type;
                $arrDet[$i]["detail"] = $row->detail;
            }
            $objReim = D("reim");
            $objDet = D("reim_det");
            $objDel = D("reim_det_rel");
            $arrData["total"] = $arrUser['total'];
            $arrData["app_id"] = $intRes1;
            $arrRel["app_id"] = $intRes1;
            $intRes2 = $objReim->add($arrData);
            foreach ($arrDet as $i) {
                $arrRel["det_id"] = $objDet->add($i);
                $intRes3 = $objDel->add($arrRel);
            }
            if ($_FILES != null) {
                $arrRoot[0] = "app_id";
                $arrRoot[1] = "reim_pic_rel";
                $intInfo = picture("Approval", $arrData["app_id"], $arrRoot, "approval_pic");
                if ($intRes1 && $intRes2 && $intRes3 && $arrRel["det_id"] && $intInfo) {
                    $objApp->commit();
                    echo returnApiCheck("200", "申请成功");
                } else {
                    $objApp->rollback();
                    echo returnApiCheck("500", "申请失败");
                    return false;
                }
            } else {
                if ($intRes1 && $intRes2 && $intRes3 && $arrRel["det_id"]) {
                    $objApp->commit();
                    echo returnApiCheck("200", "申请成功");
                } else {
                    $objApp->rollback();
                    echo returnApiCheck("500", "申请失败");
                    return false;
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 申请出差
     * @return json
     */

    public function app_trip() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '' || $arrUser["app_type"] == '' || $arrUser['day'] == '' || $arrUser['reason'] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intCheck = check($arrUser["user_id"], $arrUser["token"]);
        if ($intCheck) {
            $arrApproval["app_type"] = $arrUser["app_type"];
            $arrApproval["user_id"] = $arrUser["user_id"];
            $arrApproval["approver"] = 'admin';
            $arrApproval["state"] = "0";
            $arrApproval["app_time"] = date("Y-m-d H:i:s");
            $objApp = D("approval");
            $objApp->startTrans();
            $intRes1 = $objApp->add($arrApproval);
            foreach ($arrUser['explain'] as $i => $row) {

                $arrDet[$i]["place"] = $row->place;
                $arrDet[$i]["start"] = $row->start;
                $arrDet[$i]["end"] = $row->end;
            }
            $objReim = D("trip");
            $objDet = D("trip_det");
            $objDel = D("trip_det_rel");
            $arrData["day"] = $arrUser["day"];
            $arrData["reason"] = $arrUser["reason"];
            $arrData["app_id"] = $intRes1;
            $arrRel["app_id"] = $intRes1;
            $intRes2 = $objReim->add($arrData);
            foreach ($arrDet as $i) {
                $arrRel["det_id"] = $objDet->add($i);
                $intRes3 = $objDel->add($arrRel);
            }
            if ($_FILES != null) {
                $arrRoot[0] = "app_id";
                $arrRoot[1] = "trip_pic_rel";
                $intInfo = picture("Approval", $arrData["app_id"], $arrRoot, "approval_pic");
                if ($intRes1 && $intRes2 && $intRes3 && $arrRel["det_id"] && $intInfo) {
                    $objApp->commit();
                    echo returnApiCheck("200", "申请成功");
                } else {
                    $objApp->rollback();
                    echo returnApiCheck("500", "申请失败");
                    return false;
                }
            } else {
                if ($intRes1 && $intRes2 && $intRes3 && $arrRel["det_id"]) {
                    $objApp->commit();
                    echo returnApiCheck("200", "申请成功");
                } else {
                    $objApp->rollback();
                    echo returnApiCheck("500", "申请失败");
                    return false;
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查看已审批
     * @return json
     */

    public function already_approval() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $user_name = D("users")->where("id='" . $arrUser['user_id'] . "'")->field(array("user_name"))->find();
        if ($user_name == 'false') {
            echo returnApiCheck('500', '查询失败');
            return false;
        }
        $intCheck=  check($arrUser["user_id"], $arrUser["token"]);
        if(!$intCheck){
            echo returnApiCheck("403","账号已登录，您被迫下线");
            return false;
        }
        $intPower = power($arrUser["token"], $arrUser["user_id"]); //权限认证
        if ($intPower) {
            $strSql = "select a.id,a.app_type,a.approver,a.state,a.app_time,a.view,a.approval_time,u.user_name from "
                    . "tb_users as u,tb_approval as a where a.app_type in('1','2','3') and a.state in('1','2') and  "
                    . "a.user_id=u.id and a.approver='" . $user_name["user_name"] . "' order by a.id desc";
            $arrData = D("approval")->query($strSql);
            if ($arrData == null) {
                echo returnApiSuccess('200', '查询成功', $arrData);
                return;
            }
            $data_process = $this->data_process($arrData);
            echo returnApiSuccess("200", "请求成功", $data_process);
        } else {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
    }

    /*
     *  查看待我审批
     * @return json
     */

    public function wait_approval() {
        $user = getData();
        if ($user['user_id'] == '' || $user['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $user_name = D("users")->where("id='" . $user['user_id'] . "'")->field(array("user_name"))->find();
        if ($user_name == 'false') {
            echo returnApiCheck('500', '查询失败');
            return false;
        }
        $intCheck=  check($arrUser["user_id"], $arrUser["token"]);
        if(!$intCheck){
            echo returnApiCheck("403","账号已登录，您被迫下线");
            return false;
        }
        $intPower = power($user["token"], $user["user_id"]); //权限认证
        if ($intPower) {
            $strSql = "select a.id,a.app_type,a.approver,a.state,a.app_time,u.user_name from "
                    . "tb_users as u,tb_approval as a where a.app_type in('1','2','3') and a.state=0 and  "
                    . "a.user_id=u.id and a.approver='" . $user_name["user_name"] . "' order by a.id desc";
            $arrData = D("approval")->query($strSql);
            if ($arrData == null) {
                echo returnApiSuccess('200', '查询成功', $arrData);
                return;
            }
            $data_process = $this->data_process($arrData); //数据处理
            echo returnApiSuccess("200", "请求成功", $data_process);
        } else {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
    }

    /*
     * 查看我的申请
     * @return json
     */

    public function see_apply() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = "select a.id,a.app_type,a.approver,a.state,a.app_time,a.view,a.approval_time,u.user_name from "
                    . "tb_users as u,tb_approval as a where a.app_type in('1','2','3') and  "
                    . "a.user_id=u.id and a.user_id='" . $arrUser['user_id'] . "' order by a.id desc";
            $arrData = D("approval")->query($strSql);
            if ($arrData == null) {
                echo returnApiSuccess('200', '查询成功', $arrData);
                return;
            }
            $arrData_process = $this->data_process($arrData); //数据处理
            echo returnApiSuccess("200", "请求成功", $arrData_process);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 处理数据
     * @return array
     */

    public function data_process($arrData) {
        foreach ($arrData as $k => $v) {
            if ($v["app_type"] == "1") {
                $strSql1 = "select type,start,end,day,reason from tb_leave where app_id='" . $v["id"] . "'";
                $arrLeave = D("leave")->query($strSql1);
                if ($arrLeave == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                foreach ($arrLeave as $k1 => $v1) {
                    $arrData[$k]["type"] = $v1["type"];
                    $arrData[$k]["start"] = $v1["start"];
                    $arrData[$k]["end"] = $v1["end"];
                    $arrData[$k]["day"] = $v1["day"];
                    $arrData[$k]["reason"] = $v1["reason"];
                }
                $strSql2 = "select p.pic_url from tb_leave_pic_rel as r,tb_approval_pic as p where r.app_id='" . $v["id"] . "' and r.pic_id=p.id";
                $arrPic = D("approval_pic")->query($strSql2);
                if ($arrPic == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                if ($arrPic[0] == null) {
                    $arrData[$k]["pic_url"] = '';
                } else {
                    foreach ($arrPic as $k2 => $v2) {
                        if ($arrData[$k]["pic_url"] == '') {
                            $arrData[$k]["pic_url"] = $v2["pic_url"];
                        } else {
                            $arrData[$k]["pic_url"] = $arrData[$k]["pic_url"] . ',' . $v2["pic_url"];
                        }
                    }
                }
            } elseif ($v["app_type"] == "2") {
                $strSql1 = "select total from tb_reim where app_id='" . $v["id"] . "'";
                $arrReim = D("reim")->query($strSql1);
                foreach ($arrReim as $k2 => $v2) {
                    $arrData[$k]["total"] = $v2["total"];
                }
                $strSql2 = "select p.pic_url from tb_reim_pic_rel as r,tb_approval_pic as p where r.app_id='" . $v["id"] . "' and r.pic_id=p.id";
                $arrPic = D("approval_pic")->query($strSql2);
                if ($arrPic == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                if ($arrPic[0] == null) {
                    $arrData[$k]["pic_url"] = '';
                } else {
                    foreach ($arrPic as $k2 => $v2) {
                        if ($arrData[$k]["pic_url"] == '') {
                            $arrData[$k]["pic_url"] = $v2["pic_url"];
                        } else {
                            $arrData[$k]["pic_url"] = $arrData[$k]["pic_url"] . ',' . $v2["pic_url"];
                        }
                    }
                }
                $strSql3 = "select money,type,detail from tb_reim_det as d,tb_reim_det_rel as r where r.det_id=d.id and r.app_id='" . $v["id"] . "'";
                $arrDet = D("reim_det")->query($strSql3);
                if ($arrDet == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                foreach ($arrDet as $k3 => $v3) {
                    $arrData[$k]["explain"][$k3] = $v3;
                }
            } else {
                $strSql1 = "select day,reason from tb_trip where app_id='" . $v["id"] . "'";
                $arrTrip = D("trip")->query($strSql1);
                foreach ($arrTrip as $k2 => $v2) {
                    $arrData[$k]["day"] = $v2["day"];
                    $arrData[$k]["reason"] = $v2["reason"];
                }
                $strSql2 = "select p.pic_url from tb_trip_pic_rel as r,tb_approval_pic as p where r.app_id='" . $v["id"] . "' and r.pic_id=p.id";
                $arrPic = D("approval_pic")->query($strSql2);
                if ($arrPic == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                if ($arrPic[0] == null) {
                    $arrData[$k]["pic_url"] = '';
                } else {
                    foreach ($arrPic as $k2 => $v2) {
                        if ($arrData[$k]["pic_url"] == '') {
                            $arrData[$k]["pic_url"] = $v2["pic_url"];
                        } else {
                            $arrData[$k]["pic_url"] = $arrData[$k]["pic_url"] . ',' . $v2["pic_url"];
                        }
                    }
                }
                $strSql3 = "select place,start,end from tb_trip_det as d,tb_trip_det_rel as r where r.det_id=d.id and r.app_id='" . $v["id"] . "'";
                $arrDet = D("reim_det")->query($strSql3);
                if ($arrDet == 'false') {
                    echo returnApiCheck('500', '查询失败');
                    return false;
                }
                foreach ($arrDet as $k3 => $v3) {
                    $arrData[$k]["explain"][$k3] = $v3;
                }
            }
        }
        return $arrData;
    }

    /*
     *  审批
     * @return json
     */

    public function approval() {
        $arrUser = getData();
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '' || $arrUser["app_id"] == '' || $arrUser["view"] == '' || $arrUser["state"] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intPower = power($arrUser["token"], $arrUser["user_id"]); //权限认证
        if ($intPower) {
            $strTime = date("Y-m-d H:i:s");
            $strSql = "update tb_approval set state='" . $arrUser['state'] . "',view='" . $arrUser["view"] . "',approval_time='" . $strTime . "' where id='" . $arrUser["app_id"] . "'";
            if (D("approval")->execute($strSql)) {
                echo returnApiCheck("200", "审批成功");
            } else {
                echo returnApiCheck("500", "审批失败");
                return false;
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 撤销申请
     * @return json
     */

    public function cancel() {
        $arrUser = getData();
        $check = check($arrUser["user_id"], $arrUser["token"]);
        if ($check) {
            $strSql = "update tb_approval set state='3' where id='" . $arrUser['app_id'] . "' and state='0'";
            if (D("approval")->execute($strSql)) {
                echo returnApiCheck("200", "撤销成功");
            } else {
                echo returnApiCheck("500", "撤销失败");
                return false;
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

}
