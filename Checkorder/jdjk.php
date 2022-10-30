<?php

function processCx($oid)
{
	global $DB;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,user,pass from qingka_wangke_order where oid='{$oid}' ");
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$b["hid"]}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$user = $b["user"];
	$pass = $b["pass"];
	$kcname = $d["kcname"];
	$school = $d["school"];
	$pt = $d["noun"];
	$kcid = $d["kcid"];
	
	//27同步状态接口
	if ($type == "27") {
		$data = array("username" => $user);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=chadan";
		$result = get_url($eq_url, $data);
		$result = json_decode($result, true);
		if ($result["code"] == "1") {
			foreach ($result["data"] as $res) {
				$yid = $res["id"];
				$kcname = $res["kcname"];
				$status = $res["status"];
				$process = $res["process"];
				$remarks = $res["remarks"];
				$kcks = $res["courseStartTime"];
				$kcjs = $res["courseEndTime"];
				$ksks = $res["examStartTime"];
				$ksjs = $res["examEndTime"];
				$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks);
			}
		} else {
			$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
		}
		return $b;}
	//欧巴进度
 else if($type == "ouba"){
    $token = $a['token'];
    $pt = $d['noun'];
    $data = array("optoken" =>$token,"type" => $pt ,"account" => $user);
     $ob_rl = $a["url"];
  $ob_url = "$ob_rl/openApi/getProgress.jsp";
  $result = get_url($ob_url, $data);
     $result = json_decode($result, true);
    if ($result["code"] == 0) {
         for ($i = 0; $i < count($result["data"]); $i++) {
             $id = $result["data"][$i]["ctid"];
    $yuser = $result["data"][$i]["phone"];
    $ypass = $result["data"][$i]["pwd"];
    $kcname = $result["data"][$i]["cName"];
    $ksks ='';
    $ksjs = '';
    $kszt = '';
    $status_text = '';
    $status = $result["data"][$i]["cStatus"];;
    $remarks = "";
    $process =$result["data"][$i]["mStatus"];
    if ($status == 3) {
      $status_tex = "已完成";
     } else {
      $status_tex = "进行中";
     }
     
    if ($process == 3) {
      $process = "考试已完成";
     } else if($process == 0) {
      $process = "考试待处理";
     }else {
      $process = "考试处理中";
     }
         } 
          $b[] = array("code" => 1, "msg" => "查询成功", "yid" => $id, "kcname" => $kcname, "user" => $yuser, "pass" => $ypass, "school" => '',"status"=>$status_tex ,"status_text" => $status_tex, "ksks" => $ksks, "ksjs" => $ksjs, "process" => $status_tex, "remarks" => $process);
   } else {
    $b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
   }
   return $b;  
 }
    // wklmcookie进度接口
    else if($type == "wklmcookie"){
        $filter = ["studentnumber" =>$user];
        $data = array("addtabs" => 1, "sort"=> "id","order"=>"desc","offset"=>0,"limit"=>10,"filter"=>json_encode($filter));
	    $wklm_rl = $a["url"];
		$wklm_url =  "$wklm_rl/orderrecord/index";
		$header = ["X-Requested-With:XMLHttpRequest"];
		$result = get_url($wklm_url, $data, $cookie,$header);
		$result = json_decode($result, true);
	    if ($result["total"] != null) {
			for ($i = 0; $i < count($result["rows"]); $i++) {
				$id = $result["rows"][$i]["id"];
				$yuser = $result["rows"][$i]["studentnumber"];
				$ypass = $result["rows"][$i]["studentpwd"];
				$kcname = $result["rows"][$i]["name"];
				$ksks = $result["rows"][$i]["ksks"];
				$ksjs = $result["rows"][$i]["ksjs"];
				$kszt = $result["rows"][$i]["kszt"];
				$status_text = $result["rows"][$i]["status_text"];
				$status = $result["rows"][$i]["status"];;
				$remarks = "";
				$process =$result["rows"][$i]["process"];
				if ($status == 2) {
						$status_tex = "已完成";
					} else {
						$status_tex = "进行中";
					}
				$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $id, "kcname" => $kcname, "user" => $yuser, "pass" => $ypass, "school" => '',"status"=>$status_tex ,"status_text" => $status_tex, "ksks" => $ksks, "ksjs" => $ksjs, "process" => $status_tex, "remarks" => $process);
			 
			}
		} else {
			$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
		}
		return $b;} 
    //00 虚假进度接口
    else if($type == "00"){
        $result["code"] == 0;
	    if ($result["code"] == 0) {
					$b[] = array("code" => 1, "msg" => "查询成功", "yid" => 8888, "kcname" => $kcname, "user" => $user, "pass" => $pass, "school" => $school,"status_text"=>"已完成", "status" => "已完成", "ksks" => $ksks, "ksjs" => $ksjs, "process" => "已经加入服务器","remarks" => "完成日常任务中,有更新点补刷"); 
					 
			} else {
				$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
			}
			return $b; 
    }
    //wklmtoken进度接口
    else if($type == "wklmtoken"){
        $wklm_surl = $a["url"];
	    $token = $a['token'];
        $std_name = $d['user'];
        $course_name= $d['kcname'];
        $result =json_decode(file_get_contents("$wklm_surl/api/order?token=$token&status=&ptid=&course_name=&std_name=$std_name&std_school=&id=&size=&page="),true);
        if($result['code'] == 200){
            	for ($i = 0; $i < count($result['data']['data']); $i++) {
				$id = $result['data']['data'][$i]["id"];
				$yuser = $result['data']['data'][$i]["std_name"];
				$ypass = $result['data']['data'][$i]["std_pwd"];
				$kcname = $result['data']['data'][$i]["course_name"];
				$ksks = $result['data']['data'][$i]["ksks"];
				$ksjs = $result['data']['data'][$i]["ksjs"];
				$kszt = $result['data']['data'][$i]["kszt"];
				$status_text = $result['data']['data'][$i]["status_text"];
				$status = $result['data']['data'][$i]["status"];;
				$remarks = "";
				$process =$result['data']['data'][$i]["process"];
				if ($status == 2) {
						$status_tex = "已完成";
					} else {
						$status_tex = "进行中";
					}
				$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $id, "kcname" => $kcname, "user" => $yuser, "pass" => $ypass, "school" => '',"status"=>$status_tex ,"status_text" => $status_tex, "ksks" => $ksks, "ksjs" => $ksjs, "process" => $status_tex, "remarks" => $process);
			}
            
        }
        else {
			$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
		}
        return $b;
        
    }

	else {
       $b[] = array("code" => -1, "msg" => "查询失败,请联系管理员"); 
	}
	
	
	  
	
}

?>