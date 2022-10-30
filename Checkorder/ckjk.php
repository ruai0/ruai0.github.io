<?php 
// 查课接口设置
function getWk($type, $noun, $school, $user, $pass, $name = false){
	global $DB;
	global $wk;
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$type}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	//27查课接口
	if ($type == "27") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "school" => $school, "user" => $user, "pass" => $pass, "platform" => $noun);
		$eq_rl = $a["url"];
		$er_url = "$eq_rl/api.php?act=get";
		$result = get_url($er_url, $data);
		$result = json_decode($result, true);
		return $result;
	}
	//wklm查课接口
	else if($type == "wklmcookie"){
       $data = array("ptid" => $noun, "school"=>$school, "studentnumber" => $user,"studentpwd" => $pass); 
       
       $wklm_surl = $a["url"];
       $wklm_url = "$wklm_surl/order/search";
       // 在后台设置接口里面填cookie
       $header = ["Cookie:$cookie"];
       $result = post($wklm_url, $data, $header); 
       
       $result = json_decode($result, true); 
    if ($result["code"] != 1 ) {
                        $b = ["code" => -1, 'msg' => "信息错误或者重试"];
                    }else{
                     $courseList = $result["data"]["courseList"]; 
                      
                     foreach ($courseList as $key => $value) {
                         
                         $json_data[] = [
                                'id' => "",
                                'name' => $value['name'],
                            ]; 
                             
                     }
                       $b  = [
                        'code' => 0,
                        'msg' => '查询成功',
                        'data' => $json_data
                    ];  
                  
        }
  return $b;}
	// 00查课接口 	
	else if($type == "00"){
	    $data = array("school"=>$school,"account" => $user,"password" => $pass,"token" => $token,"value" => $noun, ); 
	    $ll_surl = $a["url"];
	    $ll_url = "$ll_surl/querycourse";
        $result = get_url($ll_url, $data, $cookie); 
	    $result = json_decode($result, true);
	    
	 
	    if ($result["code"] != 0 ) {
	        $b = ["code" => -1, 'msg' => "信息错误或者重试"];
	    }else{
	         $courseList = $result["msg"]["data"];
                      
                     foreach ($courseList as $key => $value) {
                         
                         $json_data[] = [
                                'id' => "",
                                'name' => $value['coursename'],
                            ]; 
                             
                     }
                       $b  = [
                        'code' => 0,
                        'msg' => '查询成功',
                        'data' => $json_data
                    ];  
	    }
	    return $b;	}
	//捐赠接口
    else if($type == "jz"){
        $data = array("school_name"=>$school,"username" => $user,"password" => $pass ); 
	    $jz_surl = $a["url"];
	    $jz_url = "$jz_surl/api/$noun";
        $result = get_url($jz_url, $data, $cookie);
	    $result = json_decode($result, true);  
	    $code = $result["code"];
	    $resultd = explode("\n",$result["data"]);
       if ($code != 0 ) {
	        $b = ["code" => -1, 'msg' => "信息错误或者重试"];
	    }else{
	         $courseList = $resultd;
                     foreach ($courseList as $key => $value) {
                         $json_data[] = [
                                
                                'name' => $value ,
                            ]; 
                     }
                       $b  = [
                        'code' => 0,
                        'msg' => '查询成功',
                        'data' => $json_data
                    ];  
	    }
	    return $b;	} 
	//职教云官方
	else if($type == "zjygf"){
       $url = $_SERVER['HTTP_HOST'] ;
	   $gf_url = "http://$url/Checkorder/zjygf.php?py=1&school=$school&user123456=$user&pwd123456=$pass";
	   $result=file_get_contents($gf_url); 
	   $result = json_decode($result, true);
	   return $result;
     	}
	//mooc官方
	else if($type == "moocgf"){
       $url = $_SERVER['HTTP_HOST'] ;
	   $gf_url = "http://$url/Checkorder/zjygf.php?py=2&school=$school&user123456=$user&pwd123456=$pass";
	   $result=file_get_contents($gf_url); 
	   $result = json_decode($result, true);
	   return $result;
     	}  
    //资源库官方
	else if($type == "zykgf"){
       $url = $_SERVER['HTTP_HOST'] ;
	   $gf_url = "http://$url/Checkorder/zjygf.php?py=3&school=$school&user123456=$user&pwd123456=$pass";
	   $result=file_get_contents($gf_url); 
	   $result = json_decode($result, true);
	   return $result;
     	} 
    //学习通官方查课接口
	else if($type == "xxtgf"){
       $url = $_SERVER['HTTP_HOST'] ;
	   $gf_url = "http://$url/Checkorder/xxtgf.php?school=$school&name=$user&pwd=$pass";
	   $result=file_get_contents($gf_url); 
	   $result = json_decode($result, true);
	   return $result;
     	}
    //ayck查课接口
    else if($type == "ayck"){
        $data = array("platform" => $noun, "school"=>$school, "account" => $user,"pwd" => $pass); 
        $ay_surl = $a["url"];
        $result = post($ay_surl, $data,); 
        $result = json_decode($result, true);
         
        if ($result["code"] != 0 ) {
                        $b = ["code" => -1, 'msg' => "信息错误或者重试"];
                    }else{
                     $courseList = $result["data"]; 
                      
                     foreach ($courseList as $key => $value) {
                         
                         $json_data[] = [
                                'id' => "",
                                'name' => $value['name'],
                            ]; 
                             
                     }
                       $b  = [
                        'code' => 0,
                        'msg' => '查询成功',
                        'data' => $json_data
                    ];  
                  
        }
  return $b;}
    // 哆啦a梦接口
    else if($type == "dlam"){
        $sign = md5($noun.$user." ".$pass."|"."sign2022");
        $data = "coursename=$noun&accont=$user+$pass%7C&sign=$sign&warning=%E8%AF%B7%E4%B8%8D%E8%A6%81%E5%AF%B9%E6%9C%AC%E6%9D%A1%E6%95%B0%E6%8D%AE%E8%BF%9B%E8%A1%8C%E9%87%8D%E6%94%BE%2C%E4%BF%AE%E6%94%B9%2C%E5%90%8E%E6%9E%9C%E8%87%AA%E8%B4%9F%EF%BC%81";
        $dlam_surl = $a["url"];
        $dlam_url = "$dlam_surl/admin/sysUser/chake";
       // 在后台设置接口里面填cookie
        $header = ["Cookie:$cookie","Content-Type:application/x-www-form-urlencoded","User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36"];
        $result = post($dlam_url, $data, $header);
        $result = json_decode($result, true);
        if($result["code"]==200){
             $result =json_decode($result['message'],true);
           foreach ($result[0]['children'] as $key => $value) {
                         $json_data[] = [
                                'id' => $value['id'],
                                'name' => $value['title'],
                            ]; 
                     }
                     $b  = [
                        'code' => 0,
                        'msg' => '查询成功',
                        'data' => $json_data
                    ];  
        }
  return $b;}
	else {
    print_r("没有了,文件ckjk.php,可能故障：参数缺少，比如平台名错误！！！");die;
	}
}
 

?>