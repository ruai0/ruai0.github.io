<?php
$title='代理列表';
require_once('head.php');
if($userrow['uid']<'1'){exit("<script language='javascript'>window.location.href='/login.php';</script>");}
?>
 
<div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control" id="userlist">
        	
	    <div class="panel panel-default" >
		    <div class="panel-heading font-bold bg-white">代理列表&nbsp;<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-adduser">添加</button>&nbsp;<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-czgz">本站代理规则（必看）</button></div>
				 <div class="panel-body">
				      <div class="form-inline">	
						  	<div class="form-group">			          
				              <select class="layui-select" name="type" v-model="type" style="    background: url('../index/arrow.png') no-repeat scroll 99%;width: 125px;">
				                <option value="1">Uid</option>
				                <option value="2">用户名</option>
				                <option value="3">邀请码</option>
				                <option value="4">昵称</option>
				                <option value="5">费率</option>
				                <option value="6">余额</option>
				                <option value="7">最后在线时间</option>
				              </select>              			               
			             </div>  
			              <div class="form-group">				              
				                <input type="text" v-model="qq" value="" class="layui-input" placeholder="请输入查询内容"/>				              
			              </div>
			              <div class="form-group">				              
				               <input type="submit" @click="get(1)" value="查询" class="layui-btn"/>				              
			              </div>			              
			          </div>
		      <div class="table-responsive"> 
		        <table class="table table-striped">
		          <thead><tr><th>ID</th><th>昵称</th><th>账号</th><th>余额</th><th>费率</th><th>QQ登录</th><!--<th>已下订单</th>--><th>总充值</th><th>密匙</th><th>邀请码</th><th>状态</th><th>添加时间</th><th>最后在线时间</th><th>操作</th></tr></thead>
		          <tbody>
		            <tr v-for="res in row.data">
		            	<td>{{res.uid}}</td>		            	
		            	<td>{{res.name}}</td>
		            	<td>{{res.user}}</td>
		            	<td>{{res.money}}</td>
		            	<td>{{res.addprice}}</td>
		            	<td><span class="btn btn-xs btn-success" v-if="res.qq_openid!=''">是</span><span class="btn btn-xs btn-danger" v-else>否</span></td>	            	
<!--		            	<td>{{res.dd}}</td>-->
		            	<td>{{res.zcz}}</td>
		            	<td><span class="btn btn-xs btn-success" v-if="res.key==1">已开通</span><span class="btn btn-xs btn-danger" v-else-if="res.key==0" @click="ktapi(res.uid)">未开通</span></td>
		            	<td><span class="btn btn-xs btn-warning" @click="yqm(res.uid,res.name)">{{res.yqm==''?'无':res.yqm}}</span></td>
		            	<td @click="ban(res.uid,res.active)"><span class="btn btn-xs btn-success" v-if="res.active==1">正常</span><span class="btn btn-xs btn-danger" v-else-if="res.active==0">封禁</span></td>
		            	<td>{{res.addtime}}</td>
		            	<td>{{res.endtime}}</td>
		                <td><button class="btn btn-xs btn-success" @click="cz(res.uid,res.name)">充值</button>&nbsp;<button class="btn btn-xs btn-info"  @click="gj(res.uid,res.name)">改价</button>&nbsp;<button class="btn btn-xs btn-danger"  @click="czmm(res.uid)">重置密码</button></td>    	
		            </tr>
		          </tbody>
		        </table>
		      </div>
		      
			     <ul class="pagination" v-if="row.last_page>1"><!--by 青卡 Vue分页 -->
			         <li class="disabled"><a @click="get(1)">首页</a></li>
			         <li class="disabled"><a @click="row.current_page>1?get(row.current_page-1):''">&laquo;</a></li>
		            <li  @click="get(row.current_page-3)" v-if="row.current_page-3>=1"><a>{{ row.current_page-3 }}</a></li>
						    <li  @click="get(row.current_page-2)" v-if="row.current_page-2>=1"><a>{{ row.current_page-2 }}</a></li>
						    <li  @click="get(row.current_page-1)" v-if="row.current_page-1>=1"><a>{{ row.current_page-1 }}</a></li>
						    <li :class="{'active':row.current_page==row.current_page}" @click="get(row.current_page)" v-if="row.current_page"><a>{{ row.current_page }}</a></li>
						    <li  @click="get(row.current_page+1)" v-if="row.current_page+1<=row.last_page"><a>{{ row.current_page+1 }}</a></li>
						    <li  @click="get(row.current_page+2)" v-if="row.current_page+2<=row.last_page"><a>{{ row.current_page+2 }}</a></li>
						    <li  @click="get(row.current_page+3)" v-if="row.current_page+3<=row.last_page"><a>{{ row.current_page+3 }}</a></li>		       			     
			         <li class="disabled"><a @click="row.last_page>row.current_page?get(row.current_page+1):''">&raquo;</a></li>
			         <li class="disabled"><a @click="get(row.last_page)">尾页</a></li>	    
			     </ul>       
		    </div>
		  </div>
  
  
  
       
        <div class="modal fade primary" id="modal-adduser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">代理添加</h4>
                    </div>
           
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-adduser">
	                        <div class="form-group">
								<label class="col-sm-2 control-label">代理昵称:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="name" placeholder="昵称" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">代理账号:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="user" placeholder="必须填代理QQ" required>
								</div>
							</div>
						     <div class="form-group">
								<label class="col-sm-2 control-label">代理密码:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="pass" placeholder="请填写密码!" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">代理价格:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="addprice" placeholder="请填写费率!" value="0.25" required>
								</div>
							</div>
                         </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="layui-btn layui-btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="layui-btn" @click="adduser()">确定</button>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="modal fade primary" id="modal-czgz">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">充值规则</h4>
                    </div>
           
                    <div class="modal-body">
                    	           你旗下代理充值的时候页面将显示你的QQ<br>
                    	           开通代理：开一个代理扣除1元开户费<br>      	
                                                                         充值扣费：扣除费用=充值金额*(我的总价格/代理价格)<br>
                                                                         改价扣费：改价一次需要3元手续费，且代理余额会按照比例做相应调整<br>
                                                                         费率价格：代理费率必须是0.05的倍数，如：0.4,0.45,0.5 等等，以此类推，但不能高于你的费率                                                                                                                
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="layui-btn layui-btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="layui-btn" data-dismiss="modal" @click="layer.msg('好的，靓仔')">知道了，叼毛</button>
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



  <script type="text/javascript">
    /* 鼠标特效 */
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("富强","民主","文明","和谐","自由","平等","公正","法治","爱国","敬业","诚信","友善");
            var $i = $("<span />").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX
              , y = e.pageY;
            $i.css({
                "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            }, 1500, function() {
                $i.remove();
            });
        });
    });
</script>
	
	
<script>
var vm=new Vue({
	el:"#userlist",
	data:{
		row:null,
		type:'1',
		qq:'',
		storeInfo:{}
	},
	methods:{
		get:function(page){
		  var load=layer.load();
 			this.$http.post("/apisub.php?act=userlist",{type:this.type,qq:this.qq,page:page},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
		form:function(form){
		   var load=layer.load();
 			this.$http.post("/apisub.php?act="+form,{data:$("#form-"+form).serialize()},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     		          		
	          		this.get(this.row.current_page);
	          		$("#modal-" + form).modal('hide');
	          		layer.msg(data.data.msg,{icon:1});	             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
		adduser:function(){
	           var load=layer.load();
               $.post("/apisub.php?act=adduser",{data:$("#form-adduser").serialize()},function (data) {
		 	     layer.close(load);
	             if (data.code==1){    				
					layer.confirm(data.msg, {
					  btn: ['确定开通','取消'],title:'开通扣费'  //按钮
					}, function(){
					    var load=layer.load();
			 			vm.$http.post("/apisub.php?act=adduser",{data:$("#form-adduser").serialize(),type:1},{emulateJSON:true}).then(function(data){	
				          	layer.close(load);
				          	if(data.data.code==1){
				          	    vm.get(this.row.current_page);
	          		            $("#modal-adduser").modal('hide');			                     		          		
				          		layer.alert(data.data.msg,{icon:1});	             			                     
				          	}else{
				                layer.msg(data.data.msg,{icon:2});
				          	}
				        });	   
					}, function(){

					});					  									            
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
            });              
		},
		cz:function(uid,name){
			layer.prompt({title: '你将为<font color="red">'+name+'</font>充值请输入充值金额', formType: 3}, function(money, index){
			  layer.close(index);
			  var load=layer.load();
              $.post("/apisub.php?act=userjk",{uid:uid,money:money},function (data) {
		 	     layer.close(load);
	             if (data.code==1){
	             	vm.get(vm.row.current_page);	   
	                layer.alert(data.msg,{icon:1});
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }
              });		    		    
		  });
		},
		gj:function(uid,name){
			layer.prompt({title: '你将为<font color="red">'+name+'</font>调整费率，请先看规则在操作', formType: 3}, function(addprice, index){
			  layer.close(index);
	           var load=layer.load();
               $.post("/apisub.php?act=usergj",{uid:uid,addprice:addprice},function (data) {
		 	     layer.close(load);
	             if (data.code==1){    				
					layer.confirm(data.msg, {
					  btn: ['确定改价并充值','取消'],title:'改价扣费'  //按钮
					}, function(){
					    var load=layer.load();
			 			vm.$http.post("/apisub.php?act=usergj",{uid:uid,addprice:addprice,type:1},{emulateJSON:true}).then(function(data){	
				          	layer.close(load);
				          	if(data.data.code==1){
				          	    vm.get(vm.row.current_page);		                     		          		
				          		layer.alert(data.data.msg,{icon:1});	             			                     
				          	}else{
				                layer.msg(data.data.msg,{icon:2});
				          	}
				        });	   
					}, function(){

					});					  									            
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
             });             
		  });		 
		},
		czmm:function(uid){
		    var load=layer.load();
 			vm.$http.post("/apisub.php?act=user_czmm",{uid:uid},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     		          		
	          		layer.alert(data.data.msg,{icon:1});	             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	              	 
		},ktapi:function(uid){
			layer.confirm('给下级开通API，将扣除5元余额', {title:'温馨提示',icon:1,
				  btn: ['确定','取消'] //按钮
				}, function(){
				  		var load=layer.load();
		     			axios.get("/apisub.php?act=ktapi&type=2&uid="+uid)
				          .then(function(data){	
				          	   	layer.close(load);
				          	if(data.data.code==1){
				          		vm.get(vm.row.current_page);		                     	
		                        layer.alert(data.data.msg,{icon:1,title:"温馨提示"});							          				             			                     
				          	}else{
				                layer.msg(data.data.msg,{icon:2});
				          	}
				        });	
				
			    });
		},
		yqm:function(uid,name){
			layer.prompt({title: '你将为<font color="red">'+name+'</font>设置邀请码，邀请码最低4位数', formType: 3}, function(yqm, index){
			  layer.close(index);
	           var load=layer.load();
               $.post("/apisub.php?act=szyqm",{uid,yqm},function (data) {
		 	     layer.close(load);
	             if (data.code==1){
	             	vm.get(vm.row.current_page);		             	 
	                layer.alert(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });            
		  });		
		},ban:function(uid,active){
			var load=layer.load();
               $.post("/apisub.php?act=user_ban",{uid,active},function (data) {
		 	     layer.close(load);
	             if (data.code==1){
	             	vm.get(vm.row.current_page);		             	 
	                layer.msg(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });  
		}  
	},
	mounted(){
		this.get(1);
	}
});
</script>