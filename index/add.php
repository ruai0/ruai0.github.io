<?php
$title='单个交单';
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>
 <div id="content" class="lyear-layout-content" role="main">
    <div class="app-content-body ">

     <div class="wrapper-md control" id="add">
         
	   <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white ">
			   提交课程&nbsp;&nbsp;<a href="add2" class="btn btn-xs btn-primary">批量查询</a>&nbsp;&nbsp;<a href="add_pt" class="btn btn-xs btn-warning">普通查询</a>
		     </div>
		     
				<div class="panel-body">
					<form class="form-horizontal devform">
						<div class="form-group">
							<label class="col-sm-2 control-label">选择平台：</label>
							<div class="col-sm-9">
							<!--<select class="form-control" v-model="cid" @change="tips(cid);">-->
							<select class="layui-select"  v-model="cid" @change="tips(cid);"  style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%" >							
								  <option value="">请先选择平台</option>
								  <option id="cid2" v-for="class2 in class1" :value="class2.cid">{{class2.name+'（'+class2.price+'元）'}}</option>							  
							</select>						
							</div>
						</div>
						
						<div class="form-group" v-if="activems==true">
							<label class="col-sm-2 control-label" for="checkbox1">是否秒刷</label>
							<div class="col-sm-9">
								<div class="checkbox checkbox-success"  @change="tips2">
        				            <input type="checkbox" v-model="miaoshua">
        				            	<label for="checkbox1" id="miaoshua"></label>
							    </div>
							</div>							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">账号信息：</label>
							<div class="col-sm-9">
						    <input  class="layui-input" v-model="userinfo" required/> 	
						    <span class="help-block m-b-none" style="color:red;" id="warning"> 
						        多个账号下单可以使用批量查询</br>
						    	下单格式：</br>学校 账号 密码   </br>手机号 密码
						    </span>			
							</div>
						</div>
	
				  	    <!--<div class="col-sm-offset-2 col-sm-4">-->
				  	    <div class="col-sm-offset-2">
				  	    	<!--<input type="button" @click="get" value="查询课程" class="btn btn-primary"/>-->
				  	    	<!--<input type="button" @click="add" value="立即提交" class="btn btn-success"/>-->
				  	    	
				  	    	<input type="button" @click="get" value="查询课程" class="layui-btn"/>
				  	    	<input type="button" @click="add" value="立即提交" class="layui-btn layui-btn-normal"/>
				  	    	<input type="reset"  value="重置" class="layui-btn layui-btn-primary"/>
				  	    </div>

			        </form>
			        
			     <div style="height:10px"></div>
			         
			          
			        <form class="form-horizontal devform">	
					<!--<div class="layui-table table-responsive" lay-size="sm" >-->
					<div class="layui-table table-responsive " lay-size="lg">		    
    			       <table class="table table-striped">
    			        
            		          <thead>
            		              <tr>
                		              <th style="width:46px;font-size:14px"  id="s2">
                		                  <span >
                		                      
                		                       <input type="checkbox"  @click="check888(rs.userinfo,rs.userName,rs.data)"   id="btns"  v-for="(rs,key) in row">
                		                  </span>
                		                 
                		              
                		              </th>
                		              <th style="font-size:14px">课程名称</th>
                		              <!--<th></th>-->
                		              <!--<th></th>-->
            		              </tr>
            		          </thead> 
            		          <tbody v-for="(rs,key) in row" id="s1">
            		            <tr  v-for="(res,key) in rs.data" :id="key"  >	 	         		
                		            <td   role="tabpanel" aria-labelledby="headingOne" style="font-size:13px" > 
                		             <!--<span   class="checkbox checkbox-success">-->
                		             <span   class="checkbox checkbox-success">
                		                  <input type="checkbox" :value="res.name" @click="checkResources(rs.userinfo,rs.userName,rs.data,res.name)" ><label for="checkbox1"></label></span>
                    				</td>	
                		            <td    role="tabpanel" aria-labelledby="headingOne" style="font-size:13px" > 
                		            <span   class="checkbox checkbox-success" style="margin-left:-20px">{{res.name}}</span> 
                    				</td>
                		            <!--<td></td>-->
                		            <!--<td></td>-->
            		            </tr>
            		          </tbody>
    		            </table>
    		                  <div style="text-align:center">
    		            <div v-for="(rs,key) in row" style=" ;width:100%; margin:0 auto"  >
				         <!--<b>{{rs.userName}}</b>  {{rs.userinfo}} -->
				        <span v-if="rs.msg=='查询成功'">
				             <!--<b style="color: green;">{{rs.msg}}</b>-->
				        </span>
				        <span v-else-if="rs.msg!='查询成功'" style="color:#999;">
				             {{rs.msg}}！{{rs.userinfo}}
				        </span>
				     	</div>
    		            
    		            </div>
                    </div>
		        </form>
		        </div>
	     </div>
	   <!-- <div class="panel panel-default">-->
		  <!--  <div class="panel-heading font-bold bg-warning">-->
			 <!--   查询结果 &nbsp;-->
			    <!--<a href="wzsl" class="btn btn-xs btn-success">学起plus网址收录</a>-->
		  <!--   </div>-->
				<!--<div class="panel-body">-->
				<!--	<form class="form-horizontal devform">		-->
				<!--	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->
				<!--			  <div v-for="(rs,key) in row">-->
				<!--				  <div class="panel panel-default">-->
				<!--				    <div class="panel-heading" role="tab" id="headingOne">-->
				<!--				      <h4 class="panel-title">								-->
				<!--				        <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+key" aria-expanded="true" >-->
				<!--				         <b>{{rs.userName}}</b>  {{rs.userinfo}} <span v-if="rs.msg=='查询成功'"><b style="color: green;">{{rs.msg}}</b></span><span v-else-if="rs.msg!='查询成功'"><b style="color: red;">{{rs.msg}}</b></span>-->
				<!--				        </a>-->
				<!--				      </h4>-->
				<!--				    </div>-->
				<!--				    <div :id="key" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">-->
				<!--				      <div class="panel-body">-->
				<!--				      	  <div v-for="(res,key) in rs.data" class="checkbox checkbox-success">-->
				<!--				      	  	   <li><input type="checkbox" :value="res.name" @click="checkResources(rs.userinfo,rs.userName,rs.data,res.name)"><label for="checkbox1"></label><span>{{res.name}}</span></li>-->
								      
				<!--					      </div>-->
				<!--				      </div>-->
				<!--				    </div>-->
				<!--				  </div>-->
				<!--			</div>-->
				<!--	</div>			-->
			 <!--       </form>-->
		  <!--      </div>-->
	   <!--  </div>-->
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



 

<script>
var vm=new Vue({
	el:"#add",
	data:{	
	    row:[],
	    check_row:[],
		userinfo:'',
		cid:'',
		miaoshua:'',
		class1:'',
		class3:'',
		activems:false
	},
	
	methods:{
	    get:function(){
	        
	    	if(this.cid=='' || this.userinfo==''){
	    		layer.msg("所有项目不能为空");
	    		return false;
	    	}
		    //userinfo=this.userinfo.replace(/\r\n/g, "[br]").replace(/\n/g, "[br]").replace(/\r/g, "[br]"); 
		    userinfo=this.userinfo;
	   	   // userinfo=userinfo.split('[br]');//分割
	   	    this.row=[];
	   	    this.check_row=[];    	
	   	   // for(var i=0;i<userinfo.length;i++){	
	   	    	//info=userinfo[i]
	   	    	info=userinfo
	   	    	var hash=getENC('<?php echo $addsalt;?>');
	   	    	var loading=layer.load();
	    	    this.$http.post("/apisub.php?act=get1",{cid:this.cid,userinfo:info,hash},{emulateJSON:true}).then(function(data){
	    		     layer.close(loading);	    	
	    			 this.row.push(data.body);
	    	    });
	   	   // }	   	    	    
	    },
	    add:function(){
	    	if(this.cid==''){
	    		layer.msg("请先查课");
	    		return false;
	    	} 	
	    	if(this.check_row.length<1){
	    		layer.msg("请先选择课程");
	    		return false;
	    	} 	
	    	console.log(this.check_row);
	        var loading=layer.load();
	    	this.$http.post("/apisub.php?act=add",{cid:this.cid,data:this.check_row},{emulateJSON:true}).then(function(data){
	    		layer.close(loading);
	    		if(data.data.code==1){
	    			this.row=[];
	    			this.check_row=[]; 
	    			// layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
	    			layer.alert(data.data.msg,{icon:1,title:"温馨提示"});
	    		}else{
	    			layer.alert(data.data.msg,{icon:2,title:"温馨提示"});
	    		}
	    	});
	    },
	    check888:function(userinfo,userName,rs,name){
	        var btns=document.getElementById("btns");
	        var  zk= document.getElementById("s1");
	        var x= zk.getElementsByTagName("input");
        	if(btns.checked==true) {
        		for(var i=0   ; i < x.length; ++i) {
                    data={userinfo,userName,data:rs[i]};
        			x[i].checked=true;
        		    vm.check_row.push(data);
        		}
        	}else {
        		for(var i=0; i < x.length; ++i) {
        			x[i].checked=false; 
        		}
        		 this.check_row = []
        	}
	    },
	    checkResources:function(userinfo,userName,rs,name){
	        for(i=0;i<rs.length;i++){
	    		if(rs[i].name==name){
	    			aa=rs[i]
	    		}	    		
	    	}
	    	data={userinfo,userName,data:aa}
	    	if(this.check_row.length<1){
	    		vm.check_row.push(data); 
	    	}else{
	    	    var a=0;
		    	for(i=0;i<this.check_row.length;i++){		    		
		    		if(vm.check_row[i].userinfo==data.userinfo && vm.check_row[i].data.name==data.data.name){		    			
	            		var a=1;
	            		vm.check_row.splice(i,1);	
		    		}	    		
		    	}	    	   	    	               
               if(a==0){
               	   vm.check_row.push(data);
               }
	    	} 
	    },
	    getclass:function(){
		  var load=layer.load();
 			this.$http.post("/apisub.php?act=getclass").then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.class1=data.body.data;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
	    	
	    },
        tips: function (message) {
             
        	 for(var i=0;this.class1.length>i;i++){
        	 	if(this.class1[i].cid==message){
        	 		layer.tips(this.class1[i].content, 'select', {tips: [1, '#3595CC'],time: 4000});        	 		
        	 		if(this.class1[i].miaoshua==1){
					   	 this.activems=true;
					   }else{
					   	 this.activems=false;
					   }
        	 		return false;
        	 	}
        	 	
        	 }
	
        },
        tips2: function () {
        	layer.tips('开启秒刷将额外收0.05的费用', '#miaoshua');      	  
		  
        }    
	},
	mounted(){
		this.getclass();		
	}

});
</script>