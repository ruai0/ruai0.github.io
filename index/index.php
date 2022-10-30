<?php
include('head.php');
$dd=$DB->count("select count(oid) from qingka_wangke_order where uid='{$userrow['uid']}' ");
?>
<div id="content" class="lyear-layout-content" role="main">
	<div class="container-fluid" id="userindex">
     	<div class="wrapper-md control" >
<--获取搭建教程和更多开源源码加群：601616540-->

			<div class="row">
				<div class="col-sm-6">
		          <div class="card">
		            <div class="card-header">						
			              <div class="clearfix">
			                <a class="pull-left thumb-md avatar b-3x m-r">												  
			                  <img src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['user'];?>&spec=100" class="img-circle" alt="User Image" />
			                </a>							
			                <div class="clear">
			                  <div v-if="row.nickname==''" class="h5 m-t-xs"><?=$conf['sitename'];?></div>								
			                  <div v-else class="h5 m-t-xs">{{row.nickname}}</div>							  
			                  <div class="text-muted">
							    <span style="color:red;">UID: {{row.uid}}</span>（{{row.user}}）<br> 	
							    <span style="color:green">KEY:</span>&nbsp;<span v-if="row.key==0">未开通API接口<button @click="ktapi" class="btn btn-xs btn-success">开通</button></span><span v-else="">{{row.key}}</span>								
							  </div>						  
			                </div>
			              </div>			              
			        </div>
			        
			         <li class="list-group-item"> 账户余额<a @click="yecz" class="badge btn-primary">充值</a><span class="badge bg-success">&yen;{{row.money}}</span></li>
 			         <li class="list-group-item"> 我的订单<span class="badge bg-primary">{{row.dd}}</span>  </li>
   			         <li class="list-group-item"> 我的费率<a href="myprice" class="badge bg-info">查看</a>  <span class="badge bg-info">{{row.addprice}}</span></span></li>
   			         <li class="list-group-item"> 总充值<span class="badge bg-danger">&yen;{{row.zcz==null?'0':row.zcz}}</span></li>
   			         <li class="list-group-item"  > 我的费率<span class="badge bg-warning" @click="szyqprice">设置</span><span class="badge bg-warning">邀请费率：{{row.yqprice==''?'无':row.yqprice}} </li>
   			         <li class="list-group-item"  > 我的邀请码<span class="badge bg-warning">邀请码：{{row.yqm==''?'无':row.yqm}}</span> </li>
		             
		          <!--   <li class="list-group-item" href="">			             -->
				        <!--       	<span v-if="row.qq_openid==''" class="badge bg-success" @click="connect_qq">立即绑定</span>-->
				        <!--       	<span v-else class="badge bg-danger" @click="layer.alert('为了账号安全，一经绑定不允许解绑，需要解绑请联系管理员',{icon:3})">解绑</span>-->
			         <!--       <img src="https://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/bt_blue_24X24.png">QQ绑定-->
			         <!--</li>	-->
		          </div>
		          <div style="margin-top: 20px;">
				          <div class="card" class="">
				             <div class="card-header">	
				             	今日数据统计
				             </div>	
				             
				            <li class="list-group-item">				            	
				            	        代理总数：{{row.dailitongji.dlzs}}人<br />
				            		今日代理注册：{{row.dailitongji.dlzc}}人<br />
									今日代理登录：{{row.dailitongji.dldl}}人<br />							        
									今日代理下单：{{row.dailitongji.dlxd}}单
				            	
				            </li>   
				          
				          </div>
			       </div>
			       	<div style="margin-top: 20px;">
				          
			       </div>		
		        </div>
				<div class="col-lg-6">
				    <div class="card" class="">
				             <div class="card-header">	
				             	上级公告&nbsp; <button class="btn btn-xs btn-warning" @click="szgg()">设置</button>
				             </div>			             
				            <li class="list-group-item">				            	
                                 <span v-html="row.sjnotice"></span>
				            </li>   
				          
				          </div>
							  </div>
				<div class="col-lg-6">
							    <div class="card">
								   <div class="card-header"><h4>网站公告</h4></div>
									 <div class="card-body">
		                                  <span v-html="row.notice"></span>
									</div>  
							    </div>  
							  </div>
				</div>			
            </div>
       </div>
    </div>
</div>
   
<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script src="assets/js/sy.js"></script>

<!--水印开关，其他页面可以复制过去-->
<script type="text/javascript">
// var now = getNow();
// watermark({"watermark_txt":"<?=$userrow['user'];?>"});  
</script>


</html>
        <script type="text/javascript">

		    var vm=new Vue({
		     	el: "#userindex",
		    	data: {
		      		row:null,
		      		inte:'',
		        },
		      	methods:{
		    		userinfo:function(){
		    			var load=layer.load();
		     			this.$http.post("/apisub.php?act=userinfo")
				          .then(function(data){	
				          	   	layer.close(load);
				          	if(data.data.code==1){			                     	
				          		this.row=data.data			             			                     
				          	}else{
				                layer.alert(data.data.msg,{icon:2});
				          	}
				          });	
		    		},
		    		yecz:function(){
		    			layer.alert('请联系您的上级QQ：'+this.row.sjuser+'，进行充值。（下级点充值，此处将显示您的QQ）',{icon:1,title:"温馨提示"});
		    		},
		    		ktapi:function(){
		    			layer.confirm('后台余额满300元可免费开通，反之需花费10元开通', {title:'温馨提示',icon:1,
							  btn: ['确定','取消'] //按钮
							}, function(){
							  		var load=layer.load();
					     			axios.get("/apisub.php?act=ktapi&type=1")
							          .then(function(data){	
							          	   	layer.close(load);
							          	if(data.data.code==1){			                     	
	    			                        layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});							          				             			                     
							          	}else{
							                layer.msg(data.data.msg,{icon:2});
							          	}
							        });	
							
						    });
		    	    },
		    	    szyqprice:function(){		    	    	
						layer.prompt({title: '设置下级默认费率，首次自动生成邀请码', formType: 3}, function(yqprice, index){
						  layer.close(index);
						  var load=layer.load();
			              $.post("/apisub.php?act=yqprice",{yqprice},function (data) {
					 	     layer.close(load);
				             if (data.code==1){
				             	vm.userinfo();  
				                layer.alert(data.msg,{icon:1});
				             }else{
				                layer.msg(data.msg,{icon:2});
				             }
			              });		    		    
					  });
		    	    },
		    	    connect_qq:function(){
		    	    	    var ii = layer.load(0, {shade:[0.1,'#fff']});
							$.ajax({
								type : "POST",
								url : "../apisub.php?act=connect",
								data : {},
								dataType : 'json',
								success : function(data) {
									layer.close(ii);
									if(data.code == 0){
										window.location.href = data.url;
									}else{
										layer.alert(data.msg, {icon: 7});
									}
								} 
							});	
		    	  },szgg:function(){
		    	  		layer.prompt({title: '设置代理公告，您的代理可看到', formType: 2}, function(notice, index){
						  layer.close(index);
						  var load=layer.load();
			              $.post("/apisub.php?act=user_notice",{notice},function (data) {
					 	     layer.close(load);
				             if (data.code==1){
				             	vm.userinfo();  
				                layer.msg(data.msg,{icon:1});
				             }else{
				                layer.msg(data.msg,{icon:2});
				             }
			              });		    		    
					  });   	  	
		    	  }
		    	
		     	},
		     	mounted(){
		     		this.userinfo();
		     		
		     	}
		      });
		  
       </script>