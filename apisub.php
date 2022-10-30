<?php
include('confing/common.php'); 
include('ayconfig.php');
switch($act){
    case 'yqprice_1':
	  $yqprice=trim(strip_tags(daddslashes($_POST['yqprice'])));  
	    if(!is_numeric($yqprice)){
	    	jsonReturn(-1,"请正确输入费率，必须为数字");
	    }
	  if($yqprice<$userrow['addprice']){
	  	jsonReturn(-1,"下级默认费率不能比你低哦");
	  }
	  if($yqprice<0.6){
	  	jsonReturn(-1,"邀请费率最低设置为0.6");
	  }	 
	  
	     if($yqprice*100 % 5 !=0){
    		jsonReturn(-1,"邀请费率必须为0.05的倍数");
	     }
	  
	  if($userrow['yqm']==""){
	  	$yqm=random(5,5);
	  	if($DB->get_row("select uid from qingka_wangke_user where yqm='$yqm' ")){
	  		$yqm=random(6,5);
	  	}
	  	$sql="yqm='{$yqm}',yqprice='$yqprice'";
	  }else{
	  	$sql="yqprice='$yqprice'";
	  }
	  $DB->query("update qingka_wangke_user set {$sql} where uid='{$userrow['uid']}' ");
	  jsonReturn(1,"设置成功");
	break;
	case 'wlogin_1':
	jsonReturn(1,"不写也罢");
	if($userrow['uid']==1){		
	    $uid=daddslashes($_POST['uid']);
	    $row = $DB->get_row("SELECT * FROM qingka_wangke_user WHERE uid='$uid' limit 1");			
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 3000);
		exit('{"code":1,"msg":"登录成功"}');
	}else{
		jsonReturn(-1,"你在干啥？");
	}	
	break;
	case 'userinfo_1':
	  if($islogin!=1){exit('{"code":-10,"msg":"请先登录"}');}
	  $a=$DB->get_row("select uid,user,notice from qingka_wangke_user where uid='{$userrow['uuid']}' ");
	  $dd=$DB->count("select count(oid) from qingka_wangke_order where uid='{$userrow['uid']}' ");
	  //$zcz=$DB->count("select sum(money) as money from qingka_wangke_log where type='上级充值' and uid='{$userrow['uid']}' ");

	  //安全验证1
	  if($userrow['addprice']<0.1){
	  	 $DB->query("update qingka_wangke_user set addprice='1' where uid='{$userrow['uid']}' ");
	     jsonReturn(-9,"大佬，我得罪不起您啊，有什么做的不好的地方尽管提出来，我小本生意，经不起折腾，还望多多包涵");
	  }
	  //安全验证2
	  if($userrow['uid']!=1){	  	
	  	if((int)$userrow['money']-(int)'0.1'>(int)$userrow['zcz']){
		  	$DB->query("update qingka_wangke_user set money='$zcz',active='0' where uid='{$userrow['uid']}' ");
		  	jsonReturn(-9,"账号异常，请联系你老大");
	    }
	  }
	     
	     //代理数据统计
	     $dlzs=$DB->count("select count(uid) from qingka_wangke_user where uuid='{$userrow['uid']}' ");
	     $dldl=$DB->count("select count(uid) from qingka_wangke_user where uuid='{$userrow['uid']}' and endtime>'$jtdate' ");
	  	 $dlzc=$DB->count("select count(uid) from qingka_wangke_user where uuid='{$userrow['uid']}' and addtime>'$jtdate' ");   
	  	 $jrjd=$DB->count("select count(uid) from qingka_wangke_order where uid='{$userrow['uid']}' and addtime>'$jtdate' ");   


//       while($dllist2=$DB->fetch($DB->query("select uid from qingka_wangke_user where uuid='{$userrow['uid']}'"))){
//       	  $dlxd+=$DB->count("select count(oid) from qingka_wangke_order where uid='{$ddlist2['uid']}' and addtime>'$jtdate' ");
//       }
     
          //$dlxd="emmmmmm";
          $dailitongji=array(
               'dlzc'=>$dlzc,
               'dldl'=>$dldl,
               'dlxd'=>$dlxd,
               'dlzs'=>$dlzs,
               'jrjd'=>$jrjd
          );

	      $data=array(
	          'code'=>1,
	          'msg'=>'查询成功',
	          'uid'=>$userrow['uid'],
	          'user'=>$userrow['user'],
	          'qq_openid'=>$userrow['qq_openid'],
	          'nickname'=>$userrow['nickname'],
	          'faceimg'=>$userrow['faceimg'],
	          'money'=>round($userrow['money'],2),
	          'addprice'=>$userrow['addprice'],
	          'key'=>$userrow['key'],
	          'sjuser'=>$a['user'],
	          'dd'=>$dd,
	          'zcz'=>$userrow['zcz'],
	          'yqm'=>$userrow['yqm'],
	          'yqprice'=>$userrow['yqprice'],
	          'notice'=>$conf['notice'],
	          'sjnotice'=>$a['notice'],
	          'dailitongji'=>$dailitongji                  
	      );
	   exit(json_encode($data));
	break;}
    $php_Self = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/")+1);
    if($php_Self!="apisub.php"){
        $msg = '%E6%96%87%E4%BB%B6%E9%94%99%E8%AF%AF';
        $msg = urldecode($msg);
       exit(json_encode(['code' => -1, 'msg' => $msg])); }
    switch($act){
    case 'status_order':
       $a=trim(strip_tags(daddslashes($_GET['a'])));
       $sex=daddslashes($_POST['sex']); 
       $type=trim(strip_tags(daddslashes($_POST['type'])));  
       if($a==" " or empty($sex)){
           jsonReturn(-1,"请先选择订单");
       }
       if($userrow['uid']!=1){
       	  jsonReturn(-1,"老铁，求您别干我");
       }
       
       if($type==1){
          $sql="`status`='$a'";
       }elseif($type==2){
         $sql="`dockstatus`='$a'";
       }
       
       if($userrow['uid']==1){
	       for($i=0;$i<count($sex);$i++){
	           $oid=$sex[$i];              	
	       	   $b=$DB->query("update qingka_wangke_order set {$sql} where oid='{$oid}' ");   	
	       }        
       	   if($b){
       	   	jsonReturn(1,"修改成功");
       	   }else{
       	   	jsonReturn(-1,"未知异常");
       	   }        
       }else{
        	exit('{"code":-1,"msg":"无权限"}');
       }
    break;   
	case 'passwd':
      $oldpass=trim(strip_tags(daddslashes($_POST['oldpass'])));
      $newpass=trim(strip_tags(daddslashes($_POST['newpass'])));  
		if($oldpass!=$userrow['pass']) {
          exit('{"code":-1,"msg":"原密码错误"}');
		}
		if($newpass==''){
			exit('{"code":-1,"msg":"新密码不能为空"}');
		}
		$sql="update `qingka_wangke_user` set `pass` ='{$newpass}' where `uid`='{$userrow['uid']}'";
		if($DB->query($sql)){
			exit('{"code":1,"msg":"修改成功,请牢记密码"}');
          }else{
            exit('{"code":-1,"msg":"修改失败"}');
	      }
    break;
	case 'webset':	    
	    parse_str(daddslashes($_POST['data']),$row);
	    //var_dump($row);
	   	foreach($row as $k => $value){
	   	 if($k=='dklcookie' || $k=='nanatoken' || $k=='akcookie' || $k=='vpercookie'){
	   	 	$value=authcode($value,'ENCODE','qingka');
	   	 }	
		 $DB->query("UPDATE `qingka_wangke_config` SET k='{$value}' WHERE v='{$k}'");
	    }
	   exit('{"code":1,"msg":"修改成功"}');
	break;
	case 'szyqm':
	   //jsonReturn(-1,"邀请码暂停设置");
	   $uid=trim(strip_tags(daddslashes($_POST['uid'])));  
	   $yqm=trim(strip_tags(daddslashes($_POST['yqm'])));	   
	   if(strlen($yqm)<4){
	   	jsonReturn(-1,"邀请码最少4位，且必须为数字");
	   }
	   if(!is_numeric($yqm)){
	    	jsonReturn(-1,"请正确输入邀请码，必须为数字");
	   }
	   if($DB->get_row("select * from qingka_wangke_user where yqm='$yqm' ")){
	    	jsonReturn(-1,"该邀请码已被使用，请换一个");
	   }	   
	   $a=$DB->get_row("select * from qingka_wangke_user where uid='$uid' ");
	   if($userrow['uid']=='1'){
	   	  $DB->query("update qingka_wangke_user set yqm='{$yqm}' where uid='$uid' ");
	   	  wlog($userrow['uid'],"设置邀请码","给下级设置邀请码{$yqm}成功",'0');
	   	  jsonReturn(1,"设置成功");
	    //}elseif($userrow['uid']==$a['uuid'] && $userrow['addprice']=='1'){
	   }elseif($userrow['uid']==$a['uuid']){
	   	  $DB->query("update qingka_wangke_user set yqm='{$yqm}' where uid='$uid' ");
	   	  wlog($userrow['uid'],"设置邀请码","给下级设置邀请码{$yqm}成功",'0');
	   	  jsonReturn(1,"设置成功");
	   }else{
	   	  jsonReturn(-1,"无权限");
	   }
	
	break;
	case 'yqprice':
	  $yqprice=trim(strip_tags(daddslashes($_POST['yqprice'])));  
	    if(!is_numeric($yqprice)){
	    	jsonReturn(-1,"请正确输入费率，必须为数字");
	    }
	  if($yqprice<$userrow['addprice']){
	  	jsonReturn(-1,"下级默认费率不能比你低哦");
	  }
	  if($yqprice<0.6){
	  	jsonReturn(-1,"邀请费率最低设置为0.6");
	  }	 
	  
	     if($yqprice*100 % 5 !=0){
    		jsonReturn(-1,"邀请费率必须为0.05的倍数");
	     }
	  
	  if($userrow['yqm']==""){
	  	$yqm=random(5,5);
	  	if($DB->get_row("select uid from qingka_wangke_user where yqm='$yqm' ")){
	  		$yqm=random(6,5);
	  	}
	  	$sql="yqm='{$yqm}',yqprice='$yqprice'";
	  }else{
	  	$sql="yqprice='$yqprice'";
	  }
	  $DB->query("update qingka_wangke_user set {$sql} where uid='{$userrow['uid']}' ");
	  jsonReturn(1,"设置成功");
	break;
	case 'wlogin':
	jsonReturn(1,"不写也罢");
	if($userrow['uid']==1){		
	    $uid=daddslashes($_POST['uid']);
	    $row = $DB->get_row("SELECT * FROM qingka_wangke_user WHERE uid='$uid' limit 1");			
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 3000);
		exit('{"code":1,"msg":"登录成功"}');
	}else{
		jsonReturn(-1,"你在干啥？");
	}	
	break;
	case 'userinfo':
	  if($islogin!=1){exit('{"code":-10,"msg":"请先登录"}');}
	  $a=$DB->get_row("select uid,user,notice from qingka_wangke_user where uid='{$userrow['uuid']}' ");
	  $dd=$DB->count("select count(oid) from qingka_wangke_order where uid='{$userrow['uid']}' ");
	  //$zcz=$DB->count("select sum(money) as money from qingka_wangke_log where type='上级充值' and uid='{$userrow['uid']}' ");

	  //安全验证1
	  if($userrow['addprice']<0.1){
	  	 $DB->query("update qingka_wangke_user set addprice='1' where uid='{$userrow['uid']}' ");
	     jsonReturn(-9,"大佬，我得罪不起您啊，有什么做的不好的地方尽管提出来，我小本生意，经不起折腾，还望多多包涵");
	  }
	  //安全验证2
	  if($userrow['uid']!=1){	  	
	  	if((int)$userrow['money']-(int)'0.1'>(int)$userrow['zcz']){
		  	$DB->query("update qingka_wangke_user set money='$zcz',active='0' where uid='{$userrow['uid']}' ");
		  	jsonReturn(-9,"账号异常，请联系你老大");
	    }
	  }
	     
	     //代理数据统计
	     $dlzs=$DB->count("select count(uid) from qingka_wangke_user where uuid='{$userrow['uid']}' ");
	     $dldl=$DB->count("select count(uid) from qingka_wangke_user where uuid='{$userrow['uid']}' and endtime>'$jtdate' ");
	  	 $dlzc=$DB->count("select count(uid) from qingka_wangke_user where uuid='{$userrow['uid']}' and addtime>'$jtdate' ");   
	  	 $jrjd=$DB->count("select count(uid) from qingka_wangke_order where uid='{$userrow['uid']}' and addtime>'$jtdate' ");   


//       while($dllist2=$DB->fetch($DB->query("select uid from qingka_wangke_user where uuid='{$userrow['uid']}'"))){
//       	  $dlxd+=$DB->count("select count(oid) from qingka_wangke_order where uid='{$ddlist2['uid']}' and addtime>'$jtdate' ");
//       }
     
          //$dlxd="emmmmmm";
          $dailitongji=array(
               'dlzc'=>$dlzc,
               'dldl'=>$dldl,
               'dlxd'=>$dlxd,
               'dlzs'=>$dlzs,
               'jrjd'=>$jrjd
          );

	      $data=array(
	          'code'=>1,
	          'msg'=>'查询成功',
	          'uid'=>$userrow['uid'],
	          'user'=>$userrow['user'],
	          'qq_openid'=>$userrow['qq_openid'],
	          'nickname'=>$userrow['nickname'],
	          'faceimg'=>$userrow['faceimg'],
	          'money'=>round($userrow['money'],2),
	          'addprice'=>$userrow['addprice'],
	          'key'=>$userrow['key'],
	          'sjuser'=>$a['user'],
	          'dd'=>$dd,
	          'zcz'=>$userrow['zcz'],
	          'yqm'=>$userrow['yqm'],
	          'yqprice'=>$userrow['yqprice'],
	          'notice'=>$conf['notice'],
	          'sjnotice'=>$a['notice'],
	          'dailitongji'=>$dailitongji                  
	      );
	   exit(json_encode($data));
	break;
	case 'ktapi':
	  $type=trim(strip_tags(daddslashes($_GET['type'])));
	  $uid=trim(strip_tags(daddslashes($_GET['uid'])));
	  $key=random(16);
	  if($type==1){//自我开通		  
		   if($userrow['money']<300){
		   	 if($userrow['money']>=10){
		   	  $DB->query("update qingka_wangke_user set `key`='$key',`money`=`money`-10 where uid='{$userrow['uid']}' ");
		   	  wlog($userrow['uid'],"开通接口","开通接口成功!扣费10元",'-10');
		   	  exit('{"code":1,"msg":"花费10元开通接口成功","key":"'.$key.'"}');
		   	 }else{
		   	 	exit('{"code":-1,"msg":"余额不足"}');
		   	  }
		   }else{	   	
			   	  $DB->query("update qingka_wangke_user set `key`='$key' where uid='{$userrow['uid']}' ");
			   	  wlog($userrow['uid'],"开通接口","免费开通接口成功!",'0');
			   	  exit('{"code":1,"msg":"免费开通成功","key":"'.$key.'"}');
		   }
	  }elseif($type==2){
	  	if($userrow['money']<5){
	  		wlog($userrow['uid'],"开通接口","尝试给下级UID{$uid}开通接口失败! 原因：余额不足",'0');
	  		jsonReturn(-2,"余额不足以开通");	  		
	  	}else{
	  		if($uid==""){
	  			jsonReturn(-2,"uid不能为空");
	  		}
	  		$DB->query("update qingka_wangke_user set `key`='$key' where uid='{$uid}' ");
	  		$DB->query("update qingka_wangke_user set `money`=`money`-5 where uid='{$userrow['uid']}' ");		   	 
			wlog($userrow['uid'],"开通接口","给下级代理UID{$uid}开通接口成功!扣费5元",'-5');
			wlog($uid,"开通接口","你上级给你开通API接口成功!",'0');
		    exit('{"code":1,"msg":"花费5元开通成功"}');
	  	}  	
	  }
      jsonReturn(-2,"未知异常");
	break;
    
	case 'get':
	    $cid=trim(strip_tags(daddslashes($_POST['cid'])));
	    $userinfo=daddslashes($_POST['userinfo']);
	    $hash=daddslashes($_POST['hash']);
	    $rs=$DB->get_row("select * from qingka_wangke_class where cid='$cid' limit 1 ");   
	    $kms = str_replace(array("\r\n", "\r", "\n"), "[br]", $userinfo);
		$info=explode("[br]",$kms);
		
		$key='AES_Encryptwords';
		$iv='0123456789abcdef';
		$hash = openssl_decrypt($hash, 'aes-128-cbc', $key, 0 , $iv);
		if((empty($_SESSION['addsalt']) || $hash!=$_SESSION['addsalt'])){
			exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
		}
				
		for($i=0;$i<count($info);$i++){
			 $str = merge_spaces(trim($info[$i]));
			 $userinfo2=explode(" ",$str);//分割
			 if(count($userinfo2)>2){
			 	$result=getWk($rs['queryplat'],$rs['getnoun'],trim($userinfo2[0]),trim($userinfo2[1]),trim($userinfo2[2]),$rs['name']);
			 }else{
			 	$result=getWk($rs['queryplat'],$rs['getnoun'],"自动识别",trim($userinfo2[0]),trim($userinfo2[1]),$rs['name']);
			 }		
		 	 $userinfo3=trim($userinfo2[0]." ".$userinfo2[1]." ".$userinfo2[2]);
		 	 $result['userinfo']=$userinfo3;		
			 wlog($userrow['uid'],"查课","{$rs['name']}-查课信息：{$userinfo3}",0);					
		}         
	    exit(json_encode($result));      
    break; 

    case 'pay':
        exit('{"code":-1,"msg":"开发中，充值请联系你老大！！！"}');
    break;
    
    case 'getclass_pl':
        $a=$DB->query("select * from qingka_wangke_class where status=1 order by sort desc");
	    while($row=$DB->fetch($a)){
	    	if($row['yunsuan']=="*"){
	    		$price=round($row['price']*$userrow['addprice'],2);
	    	}elseif($row['yunsuan']=="+"){
	    		$price=round($row['price']+$userrow['addprice'],2);
	    	}else{
	    		$price=round($row['price']*$userrow['addprice'],2);
	    	}
	   	   $data[]=array(
	   	        'sort'=>$row['sort'],
	   	        'cid'=>$row['cid'],
   	            'name'=>$row['name'],
	   	        'noun'=>$row['noun'],
	   	        'price'=>$price,
	   	        'content'=>$row['content'],
	   	        'status'=>$row['status'],
	   	        'miaoshua'=>$miaoshua
	   	   );
	    }
	    foreach ($data as $key => $row)
            {
                $sort[$key]  = $row['sort'];
                $cid[$key] = $row['cid'];
                $name[$key] = $row['name'];
                $noun[$key] = $row['noun'];
                $price[$key] = $row['price'];
                $info[$key] = $row['info'];
                $content[$key] = $row['content'];
                $status[$key] = $row['status'];
                $miaoshua[$key] = $row['miaoshua'];
            }
	    array_multisort($sort, SORT_ASC, $cid, SORT_DESC, $data);
	    $data=array('code'=>1,'data'=>$data);
	    exit(json_encode($data));
    break;
    case 'add':
	    $cid=trim(strip_tags(daddslashes($_POST['cid'])));
	    $data=daddslashes($_POST['data']);
	    $clientip=real_ip();
	    $rs=$DB->get_row("select * from qingka_wangke_class where cid='$cid' limit 1 ");
	    if($cid==''||$data==''){exit('{"code":-1,"msg":"请选择课程"}');}	    
	        if($rs['yunsuan']=="*"){
	    		$danjia=round($rs['price']*$userrow['addprice'],2);
	    	}elseif($rs['yunsuan']=="+"){
	    		$danjia=round($rs['price']+$userrow['addprice'],2);
	    	}else{
	    		$danjia=round($rs['price']*$userrow['addprice'],2);
	    	}
	    
	        if($danjia==0 || $userrow['addprice']<0.1){
            	exit('{"code":-1,"msg":"大佬，我得罪不起您，我小本生意，有哪里得罪之处，还望多多包涵"}');
            } 
            
           $money=count($data)*$danjia;    
	       if($userrow['money']<$money){
	        	exit('{"code":-1,"msg":"余额不足"}');
	       } 
	    foreach($data as $row){
	    	$userinfo=$row['userinfo'];
	    	$userName=$row['userName'];
			$userinfo=explode(" ",$userinfo);//分割账号密码
		        if(count($userinfo)>2){
		          $school=$userinfo[0];
		       	  $user=$userinfo[1];
		       	  $pass=$userinfo[2];
		        }else{
		          $school="自动识别";
		          $user=$userinfo[0];
		       	  $pass=$userinfo[1];
		        }

	    	   $kcid=$row['data']['id'];
	    	   $kcname=$row['data']['name'];
	    	   $kcjs=$row['data']['kcjs'];
	    	   if($DB->get_row("select * from qingka_wangke_order where ptname='{$rs['name']}' and school='$school' and user='$user' and pass='$pass' and kcid='$kcid' and kcname='$kcname' ")){
                    $dockstatus='3';//重复下单
	       	   }elseif($rs['docking']==0){
	       	      	$dockstatus='99';
	       	   }else{
	       	        $dockstatus='0';
	       	   }
       	      	$is=$DB->query("insert into qingka_wangke_order (uid,cid,hid,ptname,school,name,user,pass,kcid,kcname,courseEndTime,fees,noun,miaoshua,addtime,ip,dockstatus) values ('{$userrow['uid']}','{$rs['cid']}','{$rs['docking']}','{$rs['name']}','{$school}','$userName','$user','$pass','$kcid','$kcname','{$kcjs}','{$danjia}','{$rs['noun']}','$miaoshua','$date','$clientip','$dockstatus') ");//将对应课程写入数据库	               	       	      	
                if($is){
                  $DB->query("update qingka_wangke_user set money=money-'{$danjia}' where uid='{$userrow['uid']}' limit 1 "); 
                  wlog($userrow['uid'],"添加任务","  {$rs['name']} {$user} {$pass} {$kcname} 扣除{$danjia}元！",-$danjia);
                } 
	    } 
	       if($is){
	         	exit('{"code":1,"msg":"提交成功"}');
	       }else{
	       	    exit('{"code":-1,"msg":"提交失败"}');
	       }
    break; 
    case 'bs':
       $oid=trim(strip_tags(daddslashes($_GET['oid'])));
       $b=$DB->get_row("select hid,cid,dockstatus from qingka_wangke_order where oid='{$oid}' "); 
	   $DB->query("update qingka_wangke_order set status='补刷中',`bsnum`=bsnum+1 where oid='{$oid}' ");
	   if($b['dockstatus']=='99'){
             jsonReturn(1,"成功加入线程，排队补刷中");       
       }else{
           
            
        	  $b=budanWk($oid);
        	  if($b['code']==1){
        	  	$DB->query("update qingka_wangke_order set status='补刷中',`bsnum`=bsnum+1 where oid='{$oid}' ");
        	  	jsonReturn(1,$b['msg']);
        	  }else{
        	  	jsonReturn(-1,$b['msg']);
        	  }          
	    }  
    break;
    case 'uporder'://进度刷新
       $oid=trim(strip_tags(daddslashes($_GET['oid'])));
       $row=$DB->get_row("select hid from qingka_wangke_order where oid='{$oid}' ");
       if($row['hid']=='ximeng'){
         	exit('{"code":-2,"msg":"当前订单接口异常，请去查询补单","url":""}');
       }elseif($row['dockstatus']=='99'){
       	    $result=pre_zy($oid);
       	    exit(json_encode($result));
       }       	     
	       $result=processCx($oid);
	       for($i=0;$i<count($result);$i++){
	        	$a=$DB->query("update qingka_wangke_order set `yid`='{$result[$i]['yid']}',`status`='{$result[$i]['status_text']}',`courseStartTime`='{$result[$i]['kcks']}',`courseEndTime`='{$result[$i]['kcjs']}',`examStartTime`='{$result[$i]['ksks']}',`examEndTime`='{$result[$i]['ksjs']}',`process`='{$result[$i]['process']}',`remarks`='{$result[$i]['remarks']}' where `user`='{$result[$i]['user']}' and `pass`='{$result[$i]['pass']}' and `kcname`='{$result[$i]['kcname']}' ");    	
	        	$a=$DB->query("update qingka_wangke_order set `yid`='{$result[$i]['yid']}',`status`='{$result[$i]['status_text']}',`courseStartTime`='{$result[$i]['kcks']}',`courseEndTime`='{$result[$i]['kcjs']}',`examStartTime`='{$result[$i]['ksks']}',`examEndTime`='{$result[$i]['ksjs']}',`process`='{$result[$i]['process']}',`remarks`='{$result[$i]['remarks']}' where `pass`='{$result[$i]['user']}' and `kcname`='{$result[$i]['kcname']}' ");             
	       }
	       exit('{"code":1,"msg":"同步成功"}');
    break;
    case 'ms_order'://列表提交秒刷
       $oid=trim(strip_tags(daddslashes($_GET['oid'])));
   	   $msg=$row['ptname']."不支持提交秒刷";
  	   exit('{"code":-1,"msg":"'.$msg.'"}');
    break;
    case 'qx_order'://取消订单
       $oid=trim(strip_tags(daddslashes($_GET['oid'])));
       $row=$DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
       if($row['uid']!=$userrow['uid'] && $userrow['uid']!=1){
       	 jsonReturn(-1,"无权限");
       }else{
       	$DB->query("update qingka_wangke_order set `status`='已取消',`dockstatus`=4 where oid='$oid' ");  
       	jsonReturn(1,"取消成功");
       } 
    break;
	case 'orderlist':
	    $cx=daddslashes($_POST['cx']);
	    $page=trim(strip_tags(daddslashes($_POST['page'])));
		$pagesize=20;
	    $pageu = ($page - 1) * $pagesize;//当前界面		
	    $qq=trim(strip_tags($cx['qq']));
	    $status_text=trim(strip_tags($cx['status_text']));
	    $dock=trim(strip_tags($cx['dock']));
	    $cid=trim(strip_tags($cx['cid']));
	    $oid=trim(strip_tags($cx['oid']));
	    if($userrow['uid']!='1'){
          	$sql1="where uid='{$userrow['uid']}'"; 
		}else{
			$sql1="where 1=1"; 
		}
		if($cid!=''){
	    	$sql2=" and cid='{$cid}'";
	    }
	    if($qq!=''){
	    	$sql2=" and user='{$qq}'";
	    }
	    if($oid!=''){
	    	$sql21=" and oid='{$oid}'";
	    }
	   	if($status_text!=''){
	    	$sql3=" and status='{$status_text}'";
	    }
	   	if($dock!=''){
	    	$sql4=" and dockstatus='{$dock}'";
	    }
        $sql=$sql1.$sql2.$sql21.$sql3.$sql4;
		$a=$DB->query("select * from qingka_wangke_order {$sql} order by oid desc limit $pageu,$pagesize ");
	    $count1=$DB->count("select count(*) from qingka_wangke_order {$sql} ");	
	    while($row=$DB->fetch($a)){
	       if($row['name']=='' || $row['name']=='undefined'){
	       	  $row['name']='null';
	       }
	   	   $data[]=$row;
	    }
	    $last_page=ceil($count1/$pagesize);//取最大页数
	    $data=array('code'=>1,'data'=>$data,"current_page"=>(int)$page,"last_page"=>$last_page,"uid"=>(int)$userrow['uid']);
	    exit(json_encode($data));
	break;
	case 'duijie':
	    $oid=trim(strip_tags(daddslashes($_GET['oid'])));
	    $b=$DB->get_row("select * from qingka_wangke_order where oid='$oid' limit 1 ");
		  if($userrow['uid']!=1){
		  	exit('{"code":-2,"msg":"无权限"}');
		  }
		$d=$DB->get_row("select * from qingka_wangke_class where cid='{$b['cid']}' ");  
	 	$result=addWk($oid);      
	  	if($result['code']=='1'){ 	    
       	    $DB->query("update qingka_wangke_order set `hid`='{$d['docking']}',`status`='进行中',`dockstatus`=1,`yid`='{$result['yid']}' where oid='{$oid}' ");//对接成功           
        }else{
        	$DB->query("update qingka_wangke_order set `dockstatus`=2 where oid='{$oid}' ");
        }
	    exit(json_encode($result,true));
	break;
	case 'getclass':
		$a=$DB->query("select * from qingka_wangke_class where status=1 order by sort desc");
		 
	    while($row=$DB->fetch($a)){
	    	if($row['docking']=='nana'){
	    		$miaoshua=1;
	    	}else{
	    		$miaoshua=0;
	    	}
	    	
	    	if($row['yunsuan']=="*"){
	    		$price=round($row['price']*$userrow['addprice'],2);
	    	}elseif($row['yunsuan']=="+"){
	    		$price=round($row['price']+$userrow['addprice'],2);
	    	}else{
	    		$price=round($row['price']*$userrow['addprice'],2);
	    	}
	    	
	   	   $data[]=array(
	   	        'sort'=>$row['sort'],
	   	        'cid'=>$row['cid'],
   	            'name'=>$row['name'],
	   	        'noun'=>$row['noun'],
	   	        'price'=>$price,
	   	        'content'=>$row['content'],
	   	        'status'=>$row['status'],
	   	        'miaoshua'=>$miaoshua
	   	   );
	    }
	    foreach ($data as $key => $row)
            {
                $sort[$key]  = $row['sort'];
                $cid[$key] = $row['cid'];
                $name[$key] = $row['name'];
                $noun[$key] = $row['noun'];
                $price[$key] = $row['price'];
                $info[$key] = $row['info'];
                $content[$key] = $row['content'];
                $status[$key] = $row['status'];
                $miaoshua[$key] = $row['miaoshua'];
            }
	    array_multisort($sort, SORT_ASC, $cid, SORT_DESC, $data);
	    $data=array('code'=>1,'data'=>$data);
	    exit(json_encode($data));
	
	break;
	case 'classlist':
	    $page=trim(strip_tags(daddslashes($_POST['page'])));
		$pagesize=50;
	    $pageu = ($page - 1) * $pagesize;//当前界面		
		$count1=$DB->count("select count(*) from qingka_wangke_class");
		$last_page=ceil($count1/$pagesize);//取最大页数
		if($userrow['uid']=='1'){
			$a=$DB->query("select * from qingka_wangke_class limit $pageu,$pagesize ");
		    while($row=$DB->fetch($a)){
		    	$c=$DB->get_row("select * from qingka_wangke_huoyuan where hid='{$row['queryplat']}' ");
		    	$d=$DB->get_row("select * from qingka_wangke_huoyuan where hid='{$row['docking']}' ");
		   	   $row['cx_name']=$c['name'];
		   	   $row['add_name']=$d['name'];
		   	   if($row['queryplat']=='0'){
		   	   	  $row['cx_name']='自营';
		   	   }
		   	   if($row['docking']=='0'){
		   	   	  $row['add_name']='自营';
		   	   }
		   	   
		   	   $data[]=$row;
		    }
		    foreach ($data as $key => $rows)
            {
                $sort[$key]  = $rows['sort'];
                $cid[$key] = $rows['cid'];
                $name[$key] = $rows['name'];
                $getnoun[$key] = $rows['getnoun'];
                $noun[$key] = $rows['noun'];
                $price[$key] = $rows['price'];
                $queryplat[$key] = $rows['queryplat'];
                $yunsuan[$key] = $rows['yunsuan'];
                $content[$key] = $rows['content'];
                $addtime[$key] = $rows['addtime'];
                $status[$key] = $rows['status'];
                $cx_names[$key] = $rows['cx_names'];
                $add_name[$key] = $rows['add_name'];
            }
	       array_multisort($sort, SORT_ASC, $cid,SORT_DESC , $data);
		    $data=array('code'=>1,'data'=>$data,"current_page"=>(int)$page,"last_page"=>$last_page);
		    exit(json_encode($data));
	  }else{
	    	exit('{"code":-2,"msg":"你在干啥"}');
	  }
	break;
	case 'upclass':
	    parse_str(daddslashes($_POST['data']),$row);//将字符串解析成多个变量
	     if($userrow['uid']==1){
          if($row['action']=='add'){
          	$DB->query("insert into qingka_wangke_class (sort,name,getnoun,noun,price,queryplat,docking,content,addtime,status) values ('{$row['sort']}','{$row['name']}','{$row['getnoun']}','{$row['noun']}','{$row['price']}','{$row['queryplat']}','{$row['docking']}','{$row['content']}','{$date}','{$row['status']}')");
    	    exit('{"code":1,"msg":"操作成功"}');
          }else{		   
	        $DB->query("update `qingka_wangke_class` set `sort`='{$row['sort']}',`name`='{$row['name']}',`getnoun`='{$row['getnoun']}',`noun`='{$row['noun']}',`price`='{$row['price']}',`queryplat`='{$row['queryplat']}',`docking`='{$row['docking']}',`yunsuan`='{$row['yunsuan']}',`content`='{$row['content']}',`status`='{$row['status']}' where cid='{$row['cid']}' ");	        
	        exit('{"code":1,"msg":"操作成功"}');
	      }
	    }else{
		    exit('{"code":-2,"msg":"无权限"}');
		}
	break;
	case 'huoyuanlist':
	    $page=daddslashes($_POST['page']);
		$pagesize=50;
	    $pageu = ($page - 1) * $pagesize;//当前界面		
		$count1=$DB->count("select count(*) from qingka_wangke_huoyuan");
		$last_page=ceil($count1/$pagesize);//取最大页数
		if($userrow['uid']=='1'){
			$a=$DB->query("select * from qingka_wangke_huoyuan limit $pageu,$pagesize ");
		    while($row=$DB->fetch($a)){
		   	   $data[]=$row;
		    }
		    $data=array('code'=>1,'data'=>$data,"current_page"=>(int)$page,"last_page"=>$last_page);
		    exit(json_encode($data));
	  }else{
	    	exit('{"code":-2,"msg":"你在干啥"}');
	  }
	break;		
    case 'uphuoyuan':
	    parse_str(daddslashes($_POST['data']),$row);//将字符串解析成多个变量
	   
	     if($userrow['uid']==1){
          if($row['action']=='add'){
          	$DB->query("insert into qingka_wangke_huoyuan (pt,name,url,user,pass,token,ip,cookie,addtime) values ('{$row['pt']}','{$row['name']}','{$row['url']}','{$row['user']}','{$row['pass']}','{$row['token']}','{$row['ip']}','{$row['cookie']}',NOW())");
    	    exit('{"code":1,"msg":"操作成功"}');
          }else{		   
	        $DB->query("update `qingka_wangke_huoyuan` set `name`='{$row['name']}',`url`='{$row['url']}',`user`='{$row['user']}',`pass`='{$row['pass']}',`token`='{$row['token']}',`ip`='{$row['ip']}',`cookie`='{$row['cookie']}',`endtime`=NOW() where hid='{$row['hid']}' ");	        
	        exit('{"code":1,"msg":"操作成功"}');
	      }
	    }else{
		    exit('{"code":-2,"msg":"无权限"}');
		}
	break;
    case 'adduser':
	    if($conf['user_htkh']=='0'){
	    	jsonReturn(-1,"暂停开户，具体开放时间等通知");
	    }
        parse_str(daddslashes($_POST['data']),$row);//将字符串解析成多个变量
        $type=daddslashes($_POST['type']);
        if($row['name']=='' || $row['user']==''|| $row['pass']==''||$row['addprice']==''){
        	exit('{"code":-2,"msg":"所有项目不能为空"}');
        }
        if(!preg_match('/[1-9]([0-9]{4,10})/', $row['user']))exit('{"code":-1,"msg":"账号必须为QQ号"}');
        if($DB->get_row("select * from qingka_wangke_user where user='{$row['user']}' ")){
	  	    exit('{"code":-1,"msg":"该账号已存在"}');
	    }
	    if($DB->get_row("select * from qingka_wangke_user where name='{$row['name']}' ")){
	  	    exit('{"code":-1,"msg":"该昵称已存在"}');
	    }		

		if($row['addprice']<$userrow['addprice']){
			exit('{"code":-1,"msg":"费率不能比自己低哦"}');
		}
		
		if($row['addprice']*100 % 5 !=0){
    		jsonReturn(-1,"请输入单价为0.05的倍数");
	    }
		
// 			if($row['addprice']>=0.2 && $row['addprice']<0.3){
// 	            $cz=2000;		    
// 			}elseif($row['addprice']>=0.3 && $row['addprice']<0.4){	
// 				$cz=1000;	   
// 			}elseif($row['addprice']>=0.4 && $row['addprice']<0.5){	
// 				$cz=300;	   
// 			}elseif($row['addprice']>=0.5 && $row['addprice']<0.6){	
// 				$cz=100;   
// 			}else{
// 				$cz=0;		
// 			}	
			$cz=0;		
            $kochu=round($cz*($userrow['addprice']/$row['addprice']),2);//充值 	
		    $kochu2=$kochu+$conf['user_ktmoney'];
		    if($type!=1){
        	   jsonReturn(1,"开通扣{$conf['user_ktmoney']}元开户费，并自动给下级充值{$cz}元，将扣除{$kochu}余额");
            }
			if($userrow['money']>=$kochu2){
	           $DB->query("insert into qingka_wangke_user (uuid,user,pass,name,addprice,addtime) values ('{$userrow['uid']}','{$row['user']}','{$row['pass']}','{$row['name']}','{$row['addprice']}','$date') ");
	           $DB->query("update qingka_wangke_user set `money`=`money`-'{$conf['user_ktmoney']}' where uid='{$userrow['uid']}' ");
	           wlog($userrow['uid'],"添加商户","添加商户{$row['user']}成功!扣费{$conf['user_ktmoney']}元!","-{$conf['user_ktmoney']}");          
	           if($cz!=0){
	           	 $DB->query("update qingka_wangke_user set money='$cz',zcz=zcz+'$cz' where user='{$row['user']}' ");
	           	 $DB->query("update qingka_wangke_user set `money`=`money`-'$kochu' where uid='{$userrow['uid']}' ");
	           	 wlog($userrow['uid'],"代理充值","成功给账号为[{$row['user']}]的靓仔充值{$cz}元,扣除{$kochu}元",-$kochu);
	             $is=$DB->get_row("select uid from qingka_wangke_user where user='{$row['user']}' limit 1");
	             wlog($is['uid'],"上级充值","你上面的靓仔[{$userrow['name']}]成功给你充值{$cz}元",+$cz);
	           }
	           exit('{"code":1,"msg":"添加成功"}');
		   }else{ 
		    	jsonReturn(-1,"余额不足开户，开户需扣除开户费{$conf['user_ktmoney']}元，及余额{$kochu}元");		    	
		    }
		
    break;
	case 'userlist':
	    $type=trim(strip_tags(daddslashes($_POST['type'])));
    	$qq=trim(strip_tags(daddslashes($_POST['qq'])));
	    $page=trim(daddslashes($_POST['page']));
		$pagesize=10;
	    $pageu = ($page - 1) * $pagesize;//当前界面		
		
		if($userrow['uid']=='1'){
			if($qq!="" and $type==1){
			  $sql="where uid=".$qq;
			}elseif($qq!="" and $type==2){
			  $sql="where user='".$qq."'";
			}elseif($qq!="" and $type==3){
			  $sql="where yqm='".$qq."'";
			}elseif($qq!="" and $type==4){
			  $sql="where name='".$qq."'";
			}elseif($qq!="" and $type==5){
			  $sql="where addprice='".$qq."'";
			}elseif($qq!="" and $type==6){
			  $sql="where money='".$qq."'";
			}elseif($qq!="" and $type==7){
			  $sql="where endtime>'".$qq."'";
			}
		}else{
			if($qq!="" and $type==1){
			  $sql="where uuid='{$userrow['uid']}' and uid=".$qq;
			}elseif($qq!="" and $type==2){
			  $sql="where uuid='{$userrow['uid']}' and user='".$qq."'";
			}elseif($qq!="" and $type==3){
			  $sql="where uuid='{$userrow['uid']}' and yqm='".$qq."'";
			}elseif($qq!="" and $type==4){
			  $sql="where uuid='{$userrow['uid']}' and name='".$qq."'";
			}elseif($qq!="" and $type==5){
			  $sql="where uuid='{$userrow['uid']}' and addprice='".$qq."'";
			}elseif($qq!="" and $type==6){
			  $sql="where uuid='{$userrow['uid']}' and money='".$qq."'";
			}elseif($qq!="" and $type==7){
			  $sql="where endtime>'".$qq."' and uuid='{$userrow['uid']}'";
			}else{
			   $sql="where uuid='{$userrow['uid']}'";
			}
		}

		$a=$DB->query("select * from qingka_wangke_user {$sql} order by uid desc limit $pageu,$pagesize ");
		$count1=$DB->count("select count(*) from qingka_wangke_user {$sql}");
	    while($row=$DB->fetch($a)){
	       $zcz=0;
	       $row['pass']="这还能让你知道？";
	       if($row['key']!='0'){
	   	    	$row['key']='1';
	   	   }
	   	   
	   	   $dd=$DB->count("select count(oid) from qingka_wangke_order where uid='{$row['uid']}' ");
           //$zcz=$DB->count("select sum(money) as money from qingka_wangke_log where type='上级充值' and uid='{$row['uid']}' ");
	   	   $row['dd']=$dd;
	   	   //$row['zcz']=round($zcz,2);
	   	   $data[]=$row;	   	   
	    }
	    $last_page=ceil($count1/$pagesize);//取最大页数
	    $data=array('code'=>1,'data'=>$data,"current_page"=>(int)$page,"last_page"=>$last_page);
	    exit(json_encode($data));
	break;
	case 'user_notice':
		  $notice=trim(strip_tags(daddslashes($_POST['notice'])));
		  if($DB->query("update qingka_wangke_user set notice='{$notice}' where uid='{$userrow['uid']}' ")){
		  	wlog($userrow['uid'],"设置公告","设置公告: {$notice}",0);
		  	jsonReturn(1,"设置成功");
		  }else{
		  	jsonReturn(-1,"未知异常");
		  }  
	break;
	case 'userjk':
	    $uid=trim(strip_tags(daddslashes($_POST['uid'])));
	    $money=trim(strip_tags(daddslashes($_POST['money'])));
	    if(!preg_match('/^[0-9.]+$/', $money))exit('{"code":-1,"msg":"充值金额不合法"}');
	    //充值扣费计算：扣除费用=充值金额*(我的总费率/代理费率-等级差*2%)
	    if($money<10 && $userrow['uid']!=1){
	    	exit('{"code":-1,"msg":"最低充值10元"}');
	    }
        $row=$DB->get_row("select * from qingka_wangke_user where uid='$uid' limit 1");
	    if($row['uuid']!=$userrow['uid'] && $userrow['uid']!=1){
	    	exit('{"code":-1,"msg":"该用户你的不是你的下级,无法充值"}');
	    }
	    if($userrow['uid']==$uid){
	    	exit('{"code":-1,"msg":"自己不能给自己充值哦"}');
	    }
	    
	    $kochu=round($money*($userrow['addprice']/$row['addprice']),2);//充值	
	    	    
	    if($userrow['money']<$kochu){
	    	exit('{"code":-1,"msg":"您当前余额不足,无法充值"}');
	    }
	    $wdkf=round($userrow['money']-$kochu,2);
	    $xjkf=round($row['money']+$money,2);    
	    $DB->query("update qingka_wangke_user set money='$wdkf' where uid='{$userrow['uid']}' ");//我的扣费
	    $DB->query("update qingka_wangke_user set money='$xjkf',zcz=zcz+'$money' where uid='$uid' ");//下级增加	    
	    wlog($userrow['uid'],"代理充值","成功给账号为[{$row['user']}]的靓仔充值{$money}元,扣除{$kochu}元",-$kochu);
	    wlog($row['uid'],"上级充值","{$userrow['name']}成功给你充值{$money}元",+$money);
	    exit('{"code":1,"msg":"充值'.$money.'元成功,实际扣费'.$kochu.'元"}');
   
	break;
	case 'usergj':
	    $uid=trim(strip_tags(daddslashes($_POST['uid'])));
	    $addprice=trim(strip_tags(daddslashes($_POST['addprice'])));
	    $type=trim(strip_tags(daddslashes($_POST['type'])));
	    if(!preg_match('/^[0-9.]+$/', $addprice))exit('{"code":-1,"msg":"费率不合法"}');
	    
        $row=$DB->get_row("select * from qingka_wangke_user where uid='$uid' limit 1");
	    if($row['uuid']!=$userrow['uid'] && $userrow['uid']!=1){
	    	exit('{"code":-1,"msg":"该用户你的不是你的下级,无法修改价格"}');
	    }
	    if($userrow['uid']==$uid){
	    	exit('{"code":-1,"msg":"自己不能给自己改价哦"}');
	    }
	    if($userrow['addprice']>$addprice){
	    	exit('{"code":-1,"msg":"你下级的费率不能低于你哦"}');
	    }


    	if($addprice*100 % 5 !=0){
    		jsonReturn(-1,"请输入单价为0.05的倍数");
	    }
  
		if($addprice==$row['addprice']){
			jsonReturn(-1,"该商户已经是{$addprice}费率了，你还修改啥");
		}				
		if($addprice<'0.2' && $userrow['uid']!=1){
			exit('{"code":-1,"msg":"你在干什么？"}');
		}
		
		//降价扣费计算：下级余额 /当前费率 *修改费率 ；
		$money=round($row['money']/$row['addprice']*$addprice,2);//涨降价余额变动,,自动调费
        $money1=$money-$row['money'];//日志显示变动余额

// 		if($addprice>=0.2 && $addprice<0.3){
//             $cz=2000;		    
// 		}elseif($addprice>=0.3 && $addprice<0.4){	
// 			$cz=1000;	    
// 		}elseif($addprice>=0.4 && $addprice<0.5){	
// 			$cz=300;	   
// 		}elseif($addprice>=0.5 && $addprice<0.6){	
// 			$cz=100;     
// 		}else{
// 			$cz=0;		
// 		}	

		$kochu=round($cz*($userrow['addprice']/$addprice),2);//充值	
		$kochu2=$kochu+$money+3;
        if($type!=1){
        	jsonReturn(1,"改价手续费3元，并自动给下级充值{$cz}元，将扣除{$kochu}余额");
        }

		if($userrow['money']<$kochu2){
           jsonReturn(-1,"余额不足,改价需扣3元手续费,及余额{$kochu}元");	
	    }else{
	       $DB->query("update qingka_wangke_user set money=money-3 where uid='{$userrow['uid']}' ");	          
           $DB->query("update qingka_wangke_user set money='$money',addprice='$addprice' where uid='$uid' ");//调费       
		   wlog($userrow['uid'],"修改费率","修改代理{$row['name']},费率：{$addprice},扣除手续费3元","-3");
           wlog($uid,"修改费率","{$userrow['name']}修改你的费率为：{$addprice},系统根据比例自动调整价格",$money1);
          if($cz!=0){
          	$DB->query("update qingka_wangke_user set money=money-'{$kochu}' where uid='{$userrow['uid']}' ");//我的扣费
		    $DB->query("update qingka_wangke_user set money=money+'{$cz}',zcz=zcz+'$cz' where uid='$uid' ");//下级增加	    
		    wlog($userrow['uid'],"代理充值","成功给账号为[{$row['user']}]的靓仔充值{$cz}元,扣除{$kochu}元",-$kochu);
		    wlog($uid,"上级充值","{$userrow['name']}成功给你充值{$cz}元",+$cz);
          }
          exit('{"code":1,"msg":"改价成功"}');	    	
	    }  
	break;
	case 'user_czmm':
	    $uid=trim(strip_tags(daddslashes($_POST['uid'])));
	    if($userrow['uid']==$uid){
	    	jsonReturn(-1,"自己不能给自己重置哦");
	    }
	    $row=$DB->get_row("select * from qingka_wangke_user where uid='$uid' limit 1");
	    if($row['uuid']!=$userrow['uid'] && $userrow['uid']!=1){
	    	exit('{"code":-1,"msg":"该用户你的不是你的下级,无法修改价格"}');
	    }else{
	    	$DB->query("update qingka_wangke_user set pass='123456' where uid='{$uid}' ");
	    	wlog($row['uid'],"重置密码","成功重置UID为{$uid}的密码为123456",0);
	    	jsonReturn(1,"成功重置密码为123456");
	    }  
	break;
	case 'user_ban':
	    $uid=trim(strip_tags(daddslashes($_POST['uid'])));
	    $active=trim(strip_tags(daddslashes($_POST['active'])));
	    if($userrow['uid']!=1){
	       jsonReturn(-1,"无权限");
	    }
         if($active==1){
         	$a=0;
         	$b="封禁商户";
         }else{
         	$a=1;
         	$b="解封商户";
         }
    	$DB->query("update qingka_wangke_user set active='$a' where uid='{$uid}' ");
    	wlog($userrow['uid'],$b,"{$b}[UID {$uid}]成功",0);
    	jsonReturn(1,"操作成功");

	break;
	case 'loglist':
	    $page=trim(strip_tags(daddslashes(trim($_POST['page']))));
	    $type=trim(strip_tags(daddslashes(trim($_POST['type']))));
	    $types=trim(strip_tags(daddslashes(trim($_POST['types']))));
	    $qq=trim(strip_tags(daddslashes(trim($_POST['qq']))));
		$pagesize=20;
	    $pageu = ($page - 1) * $pagesize;//当前界面		
		if($userrow['uid']!='1'){
          	$sql1="where uid='{$userrow['uid']}'"; 
		}else{
			$sql1="where 1=1"; 
		}
		if($type!=''){
	    	$sql2=" and type='$type'";
	    }
	    if($types!=''){
	    	if($type=='1'){
	    		$sql3=" and text like '%".$qq."%' ";
	    	}elseif($type=='2'){
	    		$sql3=" and money like '%".$qq."%' ";
	    	}elseif($type=='3'){
	    		$sql3=" and addtime=".$qq;
	    	}
	    	
	    }
	    $sql=$sql1.$sql2.$sql3;
		$a=$DB->query("select * from qingka_wangke_log {$sql} order by id desc limit  $pageu,$pagesize ");
		$count1=$DB->count("select count(*) from qingka_wangke_log {$sql} ");
	    while($row=$DB->fetch($a)){
	   	   $data[]=$row;
	    }
	    $last_page=ceil($count1/$pagesize);//取最大页数
	    $data=array('code'=>1,'data'=>$data,"current_page"=>(int)$page,"last_page"=>$last_page);
	    exit(json_encode($data));
	break;
	

}

?>