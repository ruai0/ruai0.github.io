<?php  

function wkname()
{
	$data = array(
	    "27" => "27", 
	    "ouba" => "欧巴仅下单", 
	    "wklmtoken" => "网课联盟token", 
	    "wklmcookie" => "网课联盟cookie",
	    "00" => "00",
	    "jz" => "捐赠接口",
	    "xxtgf" => "学习通(官方查课)",
	    "zjygf" => "智慧职教职教云(官方查课)",
	    "moocgf" => "智慧职教MOOC(官方查课)",
	    "zykgf" => "智慧职教资源库(官方查课)",
	    "ayck"=>"ay查课插件调用查课",
	    "dlam"=>"哆啦a梦cookie",
	    );
	return $data;
}
// 这里也要添加相应的接口数据  比如  "shenwei" => "神威",  后他设置里面才能看到

function addWk($oid){
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];
	$b = $DB->get_row("select * from qingka_wangke_class where cid='{$cid}' ");
	$hid = $b["docking"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	
	/*****
	 自己可以根据规则增加下单接口    
	 
	//XXXX下单接口
	else if ($type == "XXXX") {
	$data = array("optoken" => $token,"type" => $noun);  请求体参数自己加
	$XXXX_ul = $a["url"];      变量XXXX自己命名    获取顶级域名
	$XXXX_dingdan = "http://$XXXX_ul/api/CourseQuery/api/";    请求接口   XXXX自己命名
	$result = get_url($XXXX_dingdan, $data, $cookie); 
	$result = json_decode($result, true);
	
	if ($result["code"] == "0") {
		$b = array("code" => 1, "msg" => $result["msg"]);
	} else {
		$b = array("code" => -1, "msg" => $result["msg"]);
	}
	return $b;
    }
	
	
	$token  传的token
	$school  传的学校
	$user    传的账号
	$pass    传的密码
	$noun    传的平台里面的接口编号 
	$kcid    传的课程id
	****/ 
	
 
	
	//27下单接口
    if ($type == "27") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=add";
		$result = get_url($eq_url, $data,$cookie);
		$result = json_decode($result, true);
		if ($result["code"] == "0") {
			$b = array("code" => 1, "msg" => "下单成功");
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} 
	//欧巴下单接口	
	else if ($type == "ouba") {
	    $data = array("optoken" => $token, "type" => $noun,"task" => 3,"school" => $school, "account" =>$user, "pwd" =>$pass, "courseName" =>$kcname, "num" =>1      );
     	$ouba_ul = $a["url"];
		$ouba_dingdan = "$ouba_ul/Openapi/submitCourse.jsp"; 
		$result = get_url($ouba_dingdan, $data, $cookie);
		$result = json_decode($result, true);
		if ($result["code"] == 0) {
			$b = array("code" => 1, "msg" => "添加成功");
		} else {
			$b = array("code" => -1, "msg" => $result["message"]);
		}
		return $b;} 
	//wklmcookie下单接口
	else if($type == "wklmcookie") {
	    $data = array("row[courses_id]_text"=>"","row[courses_id]" =>$noun, "row[school]" => $school, "row[studentnumber]" =>$user, "row[studentpwd]" =>$pass,"courseids" =>$kcid,"row[name]" =>$kcname,"row[accountinfo]"=>"考试","row[hour]"=> 0);
     	$wklm = $a["url"];
		$wklm_dingdan = "$wklm/orderrecord/add?dialog=1";
		$header = ["X-Requested-With:XMLHttpRequest"];
		$result = get_url($wklm_dingdan, $data, $cookie,$header);  
		$result = json_decode($result, true);
      	if ($result["code"] == 1) {
			$b = array("code" => 1, "msg" => "添加成功");
		} else {
			$b = array("code" => -1, "msg" => $result["message"]);
		}
		return $b;}
	//00下单接口
	else if($type == "00"){
	    $data = array("school"=>$school,"account"=>$user,"password"=>$pass,"coursename"=>$kcname,"value"=>$noun,"token"=> $token);
	$ll_ul = $a["url"];
	$ll_dingdan = "$ll_ul/submit";
	$result = get_url($ll_dingdan, $data, $cookie);
	$result = json_decode($result, true);
	if ($result["code"] == 0) {
		$b = array("code" => 1, "msg" => "添加成功");
	} else {
		$b = array("code" => -1, "msg" => $result["message"]);
	}
	return $b;}
	//wklmtoken下单接口	
	else if($type == "wklmtoken") {
	    $wklm_surl = $a["url"];
	    $token = $a['token'];
        $std_name = $d['user'];
        $std_pwd = $d['pass'];
        $std_school = $d['school'];
        $ptid = $noun;
        $course_name= $d['kcname'];
        $is_exam = 1;
	    if(json_decode(file_get_contents("$wklm_surl/api/batch?token=".$token."&std_name=".$std_name."&std_pwd=".$std_pwd."&std_school=".$std_school."&ptid=".$ptid."&course_name=".$course_name."&is_exam=".$is_exam),true)['code']==200){
            	$b = array("code" => 1, "msg" => "添加成功");
        	} else {
        		$b = array("code" => -1, "msg" => "发生错误");
        	}
        return $b;
	}
	else{
	    print_r("没有了,文件xdjk.php,可能故障：参数缺少，比如平台名错误！！！");die;
	
	}
	
}


?>