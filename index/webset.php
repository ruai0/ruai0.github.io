<?php
$title='系统设置';
require_once('head.php');
if($userrow['uid']!=1){
	alert("你来错地方了","index.php");
}
?>

  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
 

        <div class="wrapper-md control" id="add">
	       <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white">
			    填写信息<font style="color:red">(有什么问题不懂的，首先看教程，问题解决不了，用二级域名重新搭建一套，对比找出问题，保证程序没问题，且大部分开源！！！脑筋会转弯，问题解决快。)</font>
		     </div>
		     
				<div class="panel-body">
								
				
					<form class="form-horizontal devform" id="form-web">
						<div class="form-group">
							<label class="col-sm-2 control-label">站点名字</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="sitename" value="<?=$conf['sitename']?>" placeholder="请输入站点名字" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">SEO关键词</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="keywords" value="<?=$conf['keywords']?>" placeholder="请输入站点名字" required>
							</div>
						</div>
												
						<div class="form-group">
							<label class="col-sm-2 control-label">SEO介绍</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="description" value="<?=$conf['description']?>" placeholder="请输入站点名字" required>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-sm-2 control-label">彩虹api聚合登录</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="login_apiurl" value="<?=$conf['login_apiurl']?>" placeholder="请输入聚合登录地址" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">应用ID</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="login_appid" value="<?=$conf['login_appid']?>" placeholder="请输入聚合登录应用ID" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">应用key</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="login_appkey" value="<?=$conf['login_appkey']?>" placeholder="请输入聚合登录应用key" required>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="col-sm-2 control-label">是否允许邀请码注册</label>
								<div class="col-sm-9">
									<select name="user_yqzc" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	    <option value="1" <?php if($conf['user_yqzc']==1){ echo 'selected';}?>>1_允许</option> 
	                            	    <option value="0" <?php if($conf['user_yqzc']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							   </div>
						</div>	

						<div class="form-group">
							<label class="col-sm-2 control-label">是否允许后台开户</label>
								<div class="col-sm-9">
									<select name="user_htkh" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['user_htkh']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['user_htkh']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">代理开通价格</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="user_ktmoney" value="<?=$conf['user_ktmoney']?>" placeholder="" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">公告</label>
								<div class="col-sm-9">
									<textarea type="text" name="notice" class="layui-textarea"  rows="5"><?=$conf['notice']?></textarea>
							</div>
						</div>
						

																									
				  	    <div class="col-sm-offset-2 col-sm-4">
				  	    	<input type="button" @click="add" value="立即修改" class="layui-btn"/>
				  	    </div>

			        </form>
			      

		        </div>
	     </div>
      </div>
    </div>


<?php require_once("footer.php");?>

<script>
new Vue({
	el:"#add",
	data:{

	},
	methods:{
	    add:function(){
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