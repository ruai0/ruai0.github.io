<?php  
function budanWk($oid){
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,yid,user from qingka_wangke_order where oid='{$oid}' ");
	$hid = $b["hid"];
	$yid = $b["yid"];
	$user = $b["user"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];

	//27补刷
	if ($type == "27") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=budan";
		$result = get_url($eq_url, $data);
		$result = json_decode($result, true);
		return $result;
	} 
	//欧巴重新提交  会扣费 自己把握
// 	else if($type == "ouba"){
// 	    $data = array("optoken" => $token, "type" => $noun,"task" => 3,"school" => $school, "account" =>$user, "pwd" =>$pass, "courseName" =>$kcname, "num" =>1      );
//      	$ouba_ul = $a["url"];
// 		$ouba_dingdan = "https://$ouba_ul/Openapi/submitCourse.jsp";
// 		$result = get_url($ouba_dingdan, $data, $cookie);
// 		$result = json_decode($result, true);
// 		if ($result["code"] == 0) {
// 			$b = array("code" => 1, "msg" => "添加成功");
// 		} else {
// 			$b = array("code" => -1, "msg" => $result["message"]);
// 		}
// 		return $b;} 
	//欧巴虚假补刷	
	else if($type == "ouba") {
	    
	    $result["code"] = 0;
          if ($result["code"] == 0) {
					$b = array("code" => 1, "msg" => "操作成功");
				} else if($result["code"] == 1){
				    $b = array("code" => 1, "msg" => "订单完成无需操作，有问题联系管理");
				} else {
					$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
				}
	  return $b;   
	    
	    
	}
	//wklmcookie补刷
	else if($type == "wklmcookie"){
        $data = [];
	    $wklm_rl = $a["url"];
		$wklm_url =  "$wklm_rl/orderrecord/retry3/ids/$yid";
		$cookie = ["X-Requested-With: XMLHttpRequest",
		            "Cookie: $cookie" 
		                  ];
		$result = post($wklm_url,$data,$cookie);
		$result = json_decode($result, true);
		if ($result["code"] == 1) {
					$b = array("code" => 1, "msg" => "操作成功");
				} else {
					$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
				}
	  return $b;   
	}
	//00 补刷接口
    else if($type == "00"){
        $data = array("token" => $token, "value" => $noun, "school" => $school, "account" =>$user, "password" =>$pass, "coursename" =>$kcname);
        $ll_ul = $a["url"];
 		$ll_sur = "$ll_ul/resetcourse";
 		$result= post($ll_sur,$data);
 		if ($result["code"] == 0) {
					$b = array("code" => 1, "msg" => "操作成功");
				} else {
					$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
				}
	  return $b;   
         
    }
    //wklmtoken补刷
    else if($type == "wklmtoken"){
        $token = $a['token'];
        $wklm_surl = $a["url"];
        $result =json_decode(file_get_contents("$wklm_surl/api/reset?token=$token&id=$yid"),true);
        if ($result["code"] == 200) {
					$b = array("code" => 1, "msg" => "操作成功");
				} 
				else if($result["code"] == 201) {
					$b = array("code" => -1, "msg" => "当前状态已经待执行，无需重复执行");
				}else {
				    $b = array("code" => -1, "msg" => "接口异常，请联系管理员");
				}
	  return $b;   
	}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
}




?>