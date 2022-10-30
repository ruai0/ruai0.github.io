<?php
include('head.php');
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}
?>

  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
		<!--<div style="color:red;border-bottom:1px solid #dee5e7;"><marquee scrollamount="4" onmouseover=this.stop() onmouseout=this.start()>【喜讯】全网樱花插件2019年新春特惠活动开始啦！详情请查看下方公告</marquee></div>-->
		<div class="wrapper-md control" id="userindex">
			<!-- stats -->
			<div class="row">
				<div class="col-sm-6">
		          <div class="panel panel-default">

			         	<div class="list-group no-radius alt"> 
			               <span class="list-group-item" href="">
			                <span class="badge bg-success">			                
			                <?php
			                	$a=$DB->count("select count(*) from qingka_wangke_user ");			                		                	
			                	echo $a;		                		                	
			                 ?>			                
			                </span>
			                <i class="glyphicon glyphicon-yen"></i> 
			                                       总用户
			              </span>	
			            </div>			            
			            
			            <div class="list-group no-radius alt"> 
			               <span class="list-group-item" href="">
			                <span class="badge bg-success">			                
			                <?php
			                	$a=$DB->count("select count(*) from qingka_wangke_user where addtime>'$jtdate'  ");			                		                	
			                	echo $a;		                		                	
			                 ?>			                
			                </span>
			                <i class="glyphicon glyphicon-yen"></i> 
			                                 今日新增用户
			              </span>	
			            </div>	   
			            
			            
		          	 <div class="list-group no-radius alt"> 
			               <span class="list-group-item" href="">
			                <span class="badge bg-primary">
			                 <?php
			                	$a=$DB->count("select count(*) from qingka_wangke_order where addtime>'$jtdate'  ");
			                	echo $a;	                	
			                 ?>
			                </span>
			                <i class="glyphicon glyphicon-ok"></i> 
			                                              今日订单
			              </span>	
			            </div>
		          			          			        
			            <div class="list-group no-radius alt"> 
			               <span class="list-group-item" href="">
			                <span class="badge bg-success">&yen;			                
			                <?php
			                	$a=$DB->query("select * from qingka_wangke_order where addtime>'$jtdate'  ");			                	
			                	  while($c=$DB->fetch($a)){
									  	 $zcz+=$c['fees'];
									}			                	
			                	echo $zcz;		                		                	
			                 ?>			                
			                </span>
			                <i class="glyphicon glyphicon-yen"></i> 
			                                              今日销售
			              </span>	
			            </div>
			            
			            
			            
			            

		          </div>		
		        </div>


            </div>
       </div>
    </div>
</div>
   <?php require_once("footer.php");?>
   
</html>

