<?php
$mod='blank';
$title='日志列表';
require_once('head.php');
?>
 
  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control">
        	
	    <div class="panel panel-default" id="loglist">
		    <div class="panel-heading font-bold bg-white">日志列表</div>
				 <div class="panel-body">
				 			<div class="form-inline">	
						  	<div class="form-group">			          
				              <select class="layui-select"  v-model="type" style="background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%" >
				              	<option value="">所有</option>
				                <option value="登录">登录</option>
				                <option value="添加任务">添加任务</option>
				                <option value="批量提交">批量提交</option>
				                <option value="API添加任务">API添加任务</option>
				                <option value="上级充值">上级充值</option>
				                <option value="代理充值">代理充值</option>
				                <option value="修改费率">修改费率</option>
				                <option value="查课">查课</option>
				                <option value="API查课">API查课</option>
				              </select>              			               
			            </div> 
			            <div class="form-group">			          
				               <select class="layui-select"  v-model="types" style="background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%" >
				              	<option value="">所有</option>
				                <option value="1">用户名</option>
				                <option value="2">余额变动</option>
				                <option value="3">时间</option>
				              </select>              			               
			             </div>  
			              <div class="form-group">				              
				                <input type="text" v-model="qq" value="" class="layui-input" placeholder="请输入查询内容"/>				              
			              </div> 
			              <div class="form-group">				              
				               <input type="submit" @click="get(1,1)" value="查询" class="layui-btn"/>				              
			              </div>			              
			          </div>
		      <div class="table-responsive">
		        <table class="table table-striped">
		          <thead><tr><th>ID</th><th>操作人ID</th><th>类型</th><th>余额变动</th><th>余额</th><th>操作内容</th><th>操作时间</th><th>操作IP</th></tr></thead>
		          <tbody>
		            <tr v-for="res in row.data">
		            	<td>{{res.id}}</td>		  
		            	<td>{{res.uid}}</td>
		            	<td><span class="btn btn-xs btn-danger" v-if="res.type=='批量提交' ||res.type=='添加任务' || res.type=='API添加任务'">{{res.type}}</span><span class="btn btn-xs btn-warning" v-else-if="res.type=='代理充值'">代理充值</span><span class="btn btn-xs btn-success" v-else-if="res.type=='上级充值'">上级充值</span><span class="btn btn-xs btn-primary" v-else-if="res.type=='添加商户'">添加商户</span><span class="btn btn-xs btn-info" v-else-if="res.type=='修改费率'">修改费率</span><span class="btn btn-xs btn-default" v-else="">{{res.type}}</span></td>
		            	<td>{{res.money}}</td>
		            	<td>{{res.smoney}}</td>
		            	<td>{{res.text}}</td>
		            	<td>{{res.addtime}}</td>
		            	<td>{{res.ip}}</td>           	          	
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

new Vue({
	el:"#loglist",
	data:{
		row:null,
		type:'',
		types:'',
		qq:''
	},
	methods:{
		get:function(page,a){
		  var load=layer.load();
		  data={page:page,type:this.type,types:this.types,qq:this.qq}
 			this.$http.post("/apisub.php?act=loglist",data,{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		}
	},
	mounted(){
		this.get(1);
	}
});
</script>