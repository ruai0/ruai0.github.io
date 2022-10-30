<?php
$title='批量查询';
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>
 <div id="content" class="lyear-layout-content" role="main">
     <div class="app-content-body ">

        <div class="wrapper-md control" id="add">
	       <div class="panel panel-default">
		      <div class="panel-heading font-bold bg-white ">
			    填写信息&nbsp;&nbsp;<a href="add" class="btn btn-xs btn-primary">返回</a>
		     </div>
				<div class="panel-body">
					<form class="form-horizontal devform">
						<div class="form-group">
							<label class="col-sm-2 control-label">网课类别</label>
							<div class="col-sm-9">
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
							<label class="col-sm-2 control-label">信息填写</label>
							<div class="col-sm-9">
						    <textarea rows="5" class="layui-textarea" v-model="userinfo"></textarea>	
						    <span class="help-block m-b-none" style="color:red;" id="warning"> 
						    	默认下单格式为学校、账号、密码(空格分开)； </br>
						                     多账号下单必须换行，务必保证一行一条信息；</br>
                                                                                   查询不输入学校会导致查询失败；     切记切记
						    </span>				
							</div>
						</div>
	
				  	    <div class="col-sm-offset-2 col-sm-4">
				  	    	 <input type="button" @click="get" value="查询课程" class="layui-btn"/>
				  	    	<input type="button" @click="add" value="立即提交" class="layui-btn layui-btn-normal"/>
				  	    	<input type="reset"  value="重置" class="layui-btn layui-btn-primary"/>
				  	    </div>

			        </form>
		        </div>
	     </div>
	     
	     
	    <div class="panel panel-default">
		     <div class="panel-heading font-bold bg-white ">
			    查询结果
			    </div>
				<div class="panel-body">
					<form class="form-horizontal devform">		
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div v-for="(rs,key) in row">
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title">								
								        <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+key" aria-expanded="true" >
								         <b>{{rs.userName}}</b>  {{rs.userinfo}} <span v-if="rs.msg=='查询成功'"><b style="color: green;">{{rs.msg}}</b></span><span v-else-if="rs.msg!='查询成功'"><b style="color: red;">{{rs.msg}}</b></span>
								        </a>
								      </h4>
								    </div>
								    <div :id="key" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								      	  <div v-for="(res,key) in rs.data" class="checkbox checkbox-success">
								      	  	   <li><input type="checkbox" :value="res.name" @click="checkResources(rs.userinfo,rs.userName,rs.data,res.name)"><label for="checkbox1"></label><span>{{res.name}}</span></li>
								      
									      </div>
								      </div>
								    </div>
								  </div>
							</div>
					</div>			
			        </form>
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
		    userinfo=this.userinfo.replace(/\r\n/g, "[br]").replace(/\n/g, "[br]").replace(/\r/g, "[br]");      	           	    
	   	    userinfo=userinfo.split('[br]');//分割
	   	    this.row=[];
	   	    this.check_row=[];    	
	   	    for(var i=0;i<userinfo.length;i++){	
	   	    	info=userinfo[i]
	   	    	var hash=getENC('<?php echo $addsalt;?>');
	   	    	var loading=layer.load();
	    	    this.$http.post("/apisub.php?act=get",{cid:this.cid,userinfo:info,hash},{emulateJSON:true}).then(function(data){
	    		     layer.close(loading);	    	
	    			 this.row.push(data.body);
	    	    });
	   	    }	   	    	    
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
	    	//console.log(this.check_row);
	        var loading=layer.load();
	    	this.$http.post("/apisub.php?act=add",{cid:this.cid,data:this.check_row},{emulateJSON:true}).then(function(data){
	    		layer.close(loading);
	    		if(data.data.code==1){
	    			this.row=[];
	    			this.check_row=[]; 
	    			layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
	    		}else{
	    			layer.alert(data.data.msg,{icon:2,title:"温馨提示"});
	    		}
	    	});
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