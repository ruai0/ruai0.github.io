<?php
$title='支付接口';
include('head.php');
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}
?>
  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control">
	      <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white">  支付接口设置</div>
				 <div class="panel-body">
                                 	<div class="form-group ">
		          	    <br/>
							<label class="col-sm-4 control-label">选择支付接口:</label>
								<div class="col-sm-9">
									<select name=" " class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
									    <option value="1">支付宝当面付</option> 
	                            	    <option value="1">易支付</option> 
	                            	    <option value="0">码支付</option>               	
	                                </select>
							   </div>
							<div class="form-group">
							<label class="col-sm-4 control-label">配置:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="keywords" value="" placeholder="" required>
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



<script>
    
new Vue({
	el:"#app",
	data:{

	},  
    methods:{
	    app:function(){
	        var loading=layer.load();
	    	this.$http.post("/apisub.php?act=webset",{data:$("#form-web").serialize()},{emulateJSON:true}).then(function(data){
	    		layer.close(loading);
	    		if(data.data.code==1){
	    			layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
	    		}else{
	    			layer.alert(data.data.msg,{icon:2,title:"温馨提示"});
	    		}
	    	});
	    }   
	},
	mounted(){
		//this.getclass();		
	}
	
	
});
    
</script>
