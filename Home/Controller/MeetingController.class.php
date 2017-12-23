<?php

//会议室控制器

namespace Home\Controller;

use Think\Controller;

class MeetingController extends Controller {
    /*
     * 申请会议室
     * @return json
     */

    public function apply() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '' || $arrUser['app_type'] == '' || $arrUser['room_id'] == '' || $arrUser['start'] == '' || $arrUser['end'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $objAPP = D('approval');
            $objMeet = D('meeting_app');
            $objAPP->startTrans();
            $arrData1['app_type'] = $arrUser['app_type'];
            $arrData1['user_id'] = $arrUser['user_id'];
            $arrData1['approver'] = 'admin';
            $arrData1['state'] = '0';
            $arrData1['app_time'] = date('Y-m-d H:i:s');
            $intRes1 = $objAPP->add($arrData1);
            $arrData2['app_id'] = $intRes1;
            $arrData2['room_id'] = $arrUser['room_id'];
            $arrData2['start'] = $arrUser['start'];
            $arrData2['end'] = $arrUser['end'];
            $arrData2['title'] = $arrUser['title'];
            $arrData2['content'] = $arrUser['content'];
            $intRes2 = $objMeet->add($arrData2);
            if ($intRes1 && $intRes2) {
                $objAPP->commit();
                echo returnApiCheck('200', '申请成功，等待审批');
            } else {
                $objAPP->rollback();
                echo returnApiCheck('500', '申请失败');
                return false;
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 审批会议室
     * @return json
     */

    public function approval() {
        $arrUser = getData();
        //$user = $_GET;
        if ($arrUser["user_id"] == '' || $arrUser["token"] == '' || $arrUser["app_id"] == '' || $arrUser["state"] == '' || $arrUser['view'] == '') {
            echo returnApiCheck("400", "参数有误");
            return false;
        }
        $intPower = power($arrUser["token"], $arrUser["user_id"]); //权限认证
        if ($intPower) {
            $objApp = D("approval");
            $objApp->startTrans();
            if ($arrUser['state'] == '2') {
                $strSql2 = "update tb_approval set state='" . $arrUser['state'] . "',view='" . $arrUser['view'] . "',approval_time='" . date('Y-m-d H:i:s') . "' where id=" . $arrUser["app_id"] . "";
                if ($objApp->execute($strSql2)) {
                    $objApp->commit();
                    echo returnApiCheck('200', '审批通过');
                    return;
                } else {
                    $objApp->rollback();
                    echo returnApiCheck('400', '审批失败');
                    return false;
                }
            } else {
                $arrData1 = D('meeting_app')->field(array('room_id', 'start', 'end'))->where("app_id='" . $arrUser['app_id'] . "'")->select();
                if ($arrData1 == 'false') {
                    echo returnApiCheck('500', '审批失败');
                    return false;
                }
                $strDate = substr($arrData1[0]['start'], strpos($str, " "), strlen($arrData1[0]['start']) - strpos($arrData1[0]['start'], " ") + 1);
                $strSql = "select m.start,m.end from tb_meeting_app m,tb_approval a where a.app_type=4 and a.state=1 and m.room_id='" . $arrData1[0]['room_id'] . "' and a.id=m.app_id and m.start like '%$strDate%'";
                $arrData2 = D('meeting_app')->query($strSql);
                if ($arrData2 == 'false') {
                    echo returnApiCheck('500', '审批失败');
                    return false;
                }
                foreach ($arrData2 as $k => $v) {
                    if (($arrData1[0]['start'] < $v['start'] && $arrData1[0]['end'] <= $v['end'] && $arrData1[0]['end'] > $v['start']) ||
                            ($arrData1[0]['start'] >= $v['start'] && $arrData1[0]['end'] <= $v['end'] && $arrData1[0]['start'] < $v['end']) ||
                            ($arrData1[0]['start'] > $v['start'] && $arrData1[0]['end'] >= $v['end'] && $arrData1[0]['start'] < $v['end']) ||
                            ($arrData1[0]['start'] <= $v['start'] && $arrData1[0]['end'] > $v['end'] && $arrData1[0]['end'] > $v['start'])
                    ) {
                        $strSql2 = "update tb_approval set state='2',view='该房间这个时间段已被占用',approval_time='" . date('Y-m-d H:i:s') . "' where id=" . $arrUser["app_id"] . "";
                        if ($objApp->execute($strSql2)) {
                            $objApp->commit();
                            echo returnApiCheck('400', '审批不通过');
                            return;
                        } else {
                            $objApp->rollback();
                            echo returnApiCheck('400', '审批失败');
                            return false;
                        }
                    }
                }
                $strSql3 = "update tb_approval set state='" . $arrUser['state'] . "',view='" . $arrUser['view'] . "',approval_time='" . date('Y-m-d H:i:s') . "' where id='" . $arrUser["app_id"] . "'";
                if ($objApp->execute($strSql3)) {
                    $objApp->commit();
                    echo returnApiCheck('200', '审批通过');
                } else {
                    $objApp->rollback();
                    echo returnApiCheck('400', '审批失败');
                    return false;
                }
            }
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查看会议的详情
     * @return json
     */

    public function seeOne() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '' || $arrUser['app_id'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = "select u.user_name,a.id,a.approver,a.state,a.app_time,a.view,a.approval_time,"
                    . "m.start,m.end,m.title,m.content "
                    . "from tb_approval a,tb_meeting_app m,tb_users u where u.id=a.user_id and a.id=m.app_id  and a.id='" . $arrUser['app_id'] . "'";
            $arrData = D("approval")->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查询房间信息
     * @return json
     */

    public function rooms() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = 'select id,floor_id,room_num,seat,wifi,air_con,projector from tb_meeting_room ';
            $arrData = D('meeting_room')->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查询楼层信息
     * @return json
     */

    public function floors() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = 'select id,floor_num,floor_name from tb_meeting_floor ';
            $arrData = D('meeting_floor')->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查看我的申请
     * @return json
     */

    public function myApply() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = "select u.user_name,a.id,a.approver,a.state,a.app_time,a.view,a.approval_time,m.room_id,m.start,m.end,m.title,m.content "
                    . "from tb_approval a,tb_meeting_app m,tb_users u where "
                    . "u.id=a.user_id and a.user_id='" . $arrUser['user_id'] . "' and app_type=4 and a.id=m.app_id order by a.id desc";
            $arrData = D('approval')->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查看我的审批
     * @return json
     */

    public function already_approval() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = "select u.user_name,a.id,a.approver,a.state,a.app_time,a.view,a.approval_time,m.room_id,m.start,m.end,m.title,m.content "
                    . "from tb_approval a,tb_meeting_app m,tb_users u where "
                    . "u.id=a.user_id and a.approver='admin' and a.state in('1','2') and a.app_type=4 and a.id=m.app_id order by a.id desc";
            $arrData = D('approval')->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 查看待我审批
     * @return json
     */

    public function wait_approval() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strDate = date("Y-m-d");
            $strSql = "select u.user_name,a.id,a.approver,a.state,a.app_time,m.room_id,m.start,m.end,m.title,m.content "
                    . "from tb_approval a,tb_meeting_app m,tb_users u where "
                    . "u.id=a.user_id and a.state=0 and m.start>'$strDate' and a.app_type=4 and a.id=m.app_id  order by a.id desc";
            $arrData = D('approval')->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /**
     * 根据楼层和时间查询符合条件的房间
     * @return json
     */
    public function findRooms() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '' || $arrUser['floor_id'] == '' || $arrUser['start'] == '' || $arrUser['limit'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $arrMeet['start'] = strtotime("" . $arrUser['start'] . ""); //转换为秒数形式
            $arrMeet['end'] = date('Y-m-d H:i:s', ($arrMeet['start'] + $arrUser['limit'] * 60)); //最早的结束时间
            $arrMeet['start'] = $arrUser['start']; //会议的开始时间    
            $strDate = substr($arrUser['start'], strpos(" "), strlen($arrUser['start']) - strpos($arrUser['start'], " ") + 1); //截取日期
            if ($arrUser['floor_id'] == -1) {
                $strSql1 = "select r.id from tb_meeting_room r,tb_meeting_floor f where r.floor_id=f.id";
            } else {
                $strSql1 = "select id from tb_meeting_room where floor_id= " . $arrUser['floor_id'] . "";
            }
            $arrData1 = D('meeting_room')->query($strSql1);
            if ($arrData1 == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            foreach ($arrData1 as $k => $v) {
                if ($strIds == '') {
                    $strIds = $v['id'];
                } else {
                    $strIds = $strIds . ',' . $v['id'];
                }
            }
            $strSql2 = "select m.room_id,m.start,m.end from tb_approval a,tb_meeting_app m where m.start like '%$strDate%' and m.room_id in($strIds) and a.state in(0,1) and a.app_type=4 and a.id=m.app_id order by m.room_id desc";
            $arrData2 = D('meeting_app')->query($strSql2);
            if ($arrData2 == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            foreach ($arrData1 as $k1 => $v1) {
                $intI = 0;
                foreach ($arrData2 as $k2 => $v2) {
                    if ($v1['id'] == $v2['room_id']) {
                        $arrData1[$k1]['apply'][$intI++] = $v2;
                    }
                }
                $arrRooms_id[$k1] = $v1['id'];
            }
            foreach ($arrData1 as $k2 => $v2) {
                if ($v2['apply'] != null) {
                    foreach ($v2['apply'] as $k3 => $v3) {
                        if (($arrMeet['start'] < $v3['start'] && $arrMeet['end'] <= $v3['end'] && $arrMeet['end'] > $v3['start']) ||
                                ($arrMeet['start'] >= $v3['start'] && $arrMeet['end'] <= $v3['end'] && $arrMeet['start'] < $v3['end']) ||
                                ($arrMeet['start'] > $v3['start'] && $arrMeet['end'] >= $v3['end'] && $arrMeet['start'] < $v3['end']) ||
                                ($arrMeet['start'] <= $v3['start'] && $arrMeet['end'] > $v3['end'] && $arrMeet['end'] > $v3['start'])
                        ) {
                            $arrKey = array_search($v2['id'], $arrRooms_id);
                            array_splice($arrRooms_id, $arrKey, 1);
                            break;
                        }
                    }
                }
            }
            echo returnApiSuccess('200', '查询成功', $arrRooms_id);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 根据房间号查询会议 room_id
     * @return json 
     */

    public function seeMeeting() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '' || $arrUser['room_id'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $strDate = date('Y-m-d');
        $strTime = date('Y-m-d H:i:s');
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strSql = "select a.id,u.user_name,a.approver,a.state,a.app_time,a.view,a.approval_time"
                    . ",m.room_id,m.start,m.end,m.title,m.content"
                    . " from tb_approval a,tb_meeting_app m,tb_users u where a.id=m.app_id and u.id=a.user_id"
                    . " and m.room_id='" . $arrUser['room_id'] . "' and a.state in('0','1') and m.start >'" . $strDate . "' or m.start='" . $strDate . "' order by a.app_time asc";
            $arrData = D("approval")->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            foreach ($arrData as $k => $v) {
                if ($v['state'] == '1') {
                    //会议正在进行
                    if ($v['start'] < $strTime && $v['end'] > $strTime) {
                        $arrData[$k]['state'] = '2';
                    }
                    //会议已结束
                    if ($v['end'] < $strTime) {
                        $arrData[$k]['state'] = '3';
                    }
                }
            }
            echo returnApiSuccess('200', '查询成功', $arrData);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

    /*
     * 
     * 根据时间和房间判断是否房间占用
     * @return json
     */

    public function judge_room() {
        $arrUser = getData();
        if ($arrUser['user_id'] == '' || $arrUser['token'] == '' || $arrUser['room_id'] == '' || $arrUser['start'] == '' || $arrUser['end'] == '') {
            echo returnApiCheck('400', '参数有误');
            return false;
        }
        $intCheck = check($arrUser['user_id'], $arrUser['token']);
        if ($intCheck) {
            $strDate = substr($arrUser['start'], strpos(" "), strlen($arrUser['start']) - strpos($arrUser['start'], " ") + 1); //截取日期
            $strSql = "select m.start,m.end from tb_approval a,tb_meeting_app m where a.id=m.app_id and m.room_id=" . $arrUser['room_id'] . " and a.app_type=4 and a.state in(0,1) and m.start like '%$strDate%'";
            $arrData = D('meeting_app')->query($strSql);
            if ($arrData == 'false') {
                echo returnApiCheck('500', '查询失败');
                return false;
            }
            if ($arrData == null) {
                $intState = 0; //房间状态0：空闲
                echo returnApiSuccess('200', '查询成功', $intState);
                return;
            }
            foreach ($arrData as $k => $v) {
                if (($arrUser['start'] < $v['start'] && $arrUser['end'] <= $v['end'] && $arrUser['end'] > $v['start']) ||
                        ($arrUser['start'] >= $v['start'] && $arrUser['end'] <= $v['end'] && $arrUser['start'] < $v['end']) ||
                        ($arrUser['start'] > $v['start'] && $arrUser['end'] >= $v['end'] && $arrUser['start'] < $v['end']) ||
                        ($arrUser['start'] <= $v['start'] && $arrUser['end'] > $v['end'] && $arrUser['end'] > $v['start'])
                ) {
                    $intState = 1; //房间状态1：占用
                    echo returnApiSuccess('200', '查询成功', $intState);
                    return;
                }
            }
            $intState = 0; //房间状态0：空闲
            echo returnApiSuccess('200', '查询成功', $intState);
        } else {
            echo returnApiCheck('403', '账号已被登录，您被迫下线');
            return false;
        }
    }

}
