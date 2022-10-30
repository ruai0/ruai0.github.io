<?php
include('head.php');
 $a=$DB->get_row("select uid,user,yqm from qingka_wangke_user where uid='{$userrow['uuid']}' ");
?>

    <header class="lyear-layout-header">
      
      <nav class="navbar navbar-default">
        <div class="topbar">
          
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <span class="navbar-page-title"> 日志列表 </span>
          </div>
          
          <ul class="topbar-right">
            <li class="dropdown dropdown-profile">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <span style="color:black"><?php echo $userrow['user']?><span class="caret"></span></span>
              </a>
                <ul class="dropdown-menu dropdown-menu-right">
                <li> <a href="passwd.php"><i class="glyphicon glyphicon-wrench"></i> 修改密码</a> </li>
                <li> <a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> 清空缓存</a></li>
                <li class="divider"></li>
                <li> <a href="../apisub.php?act=logout"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a> </li>
              </ul>
            </li>
          </ul>
          
        </div>
      </nav>
      
    </header>
    <!--End 头部信息-->

  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control" id="charge">
        	
				          <div class="card" class="">
				             <div class="card-header">	
				             	充值方法
				             </div>	
				             
				            <li class="list-group-item">				            	
				            	请联系您的上级进行充值！<br />
								上级联系方式（QQ/微信）：<b style="color: red;"><?php echo $a['user']?></b> <br />
								上级邀请码：<b style="color: blue;"><?php echo $a['yqm']?></b> <br />
				            </li>   		          
				          </div>
				          
				         <div class="card">
				             <div class="card-header">在线充值</div>	
				             <div class="card-body">
						      <div class="form-group" style="overflow:hidden">									
				                    <input style="width: 150px; float: left;" type="text" class="layui-input" placeholder="请输入充值金额" v-model="money"/><button style="float: left;margin-left: 5px;" class="layui-btn" @click="pay">立即充值</button>							
							  </div>
							  
							  
							    1.正常情况下请联系上家进行充值。<br />							    
								2.上家被封禁的情况下可选择在线充值。（待开放）<br />
								3.上家如若连续7天未登录平台可选择在线充值。（待开放）<br />
								4.作者直属下级可直接使用，无上面限制。<br />
				             </div>		          
				          </div>
				          
	<div class="col-sm-12" id="pay2" style="display: none;">
    	<form action="/epay/epay.php" method="post">
    		<div><center style="margin-top:15px;"><h3>￥{{money}}</h3></center></div>
    		<input type="hidden" name="out_trade_no" v-model="out_trade_no"/><br>
			<button type="radio" name="type" value="alipay" class="btn btn-primary btn-block" >支付宝</button><br>
			<button type="radio" name="type" value="qqpay" class="btn btn-danger btn-block">QQ</button><br>
			<button type="radio" name="type" value="wxpay" class="btn btn-info btn-block">微信</button><br>
		</form>	
    </div>   
				        <div style="margin-top: 20px;">
				          <div class="card" class="">
				             <div class="card-header">	
				             	我设置的公告
				             </div>			             
				            <li class="list-group-item">				            	
                                 <span> <?php echo $userrow['notice'];?> </span>
				            </li>   
				          
				          </div>
			             </div>	
				         
				         
				         <div style="margin-top: 20px;">
				          <div class="card" class="">
				             <div class="card-header">	
				             	上级公告
				             </div>			             
				            <li class="list-group-item">				            	
                                 <span><?php		                        	
				                        	$a=$DB->get_row("select notice from stk_user where uid='{$userrow['uuid']}' ");
				                        	echo $a['notice'];
				                        ?>    </span>
				            </li>   
				          
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
$("pay2").hide();
new Vue({
	el:"#charge",
	data:{
       money:'',
       out_trade_no:''
	},
	methods:{
		pay:function(page){
		    var load=layer.load();
 			this.$http.post("/apisub.php?act=pay",{money:this.money},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){	
	          		$("pay2").show();
	          		this.out_trade_no=data.data.out_trade_no;	
	          		layer.msg(data.data.msg,{icon:1});		  
 					layer.open({
					  type: 1,
					  title: '请选择支付方式',
					  closeBtn: 0,
					  area: ['250px', '300px'],
					  skin: 'layui-bg-gray', //没有背景色
					  shadeClose: true,
					  content: $('#pay2'),
			  		  end: function(){ 
					    $("#pay2").hide();
					  }
					});          		                   	          			             			                     
	          	}else{	          		
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		}
	},
	mounted(){
		
	}
});
</script>
