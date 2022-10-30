<?php
$mod='blank';
$title='平台对接';
require_once('head.php');
?>

  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control">
        	
	    <!--  <div class="panel panel-default">-->
		   <!-- <div class="panel-heading font-bold bg-danger">亿乐社区对接（软件）<a class="btn btn-success btn-xs" href="/app/亿乐社区对接29网课.exe">下载</a></div>-->
				 <!--<div class="panel-body">-->
     <!--                             打开软件配置好UID跟密匙，以及亿乐社区都ID跟Token的就好了-->
		   <!--     </div>-->
		   <!--   </div>-->

	    <!--  <div class="panel panel-default" >-->
		   <!--    <div class="panel-heading font-bold bg-info">彩虹查课插件&nbsp;<a class="btn btn-danger btn-xs" href="http://pan.29sq.cn/down.php/b92e629665e65050f156e7750043d181.zip">下载插件</a></div>-->
				 <!--   <div class="panel-body">-->
				 <!--   	 1、上传根目录解压<br />-->
				 <!--   	 2、修改29wk.php文件，设置UID跟KEY<br />-->
				 <!--   	 3、自定义访问域名URL:  http://wangke.29sq.cn/api.php?act=add<br />-->
				 <!--   	 4、 下单格式顺序设置为  账号、密码、学校、课程   -->
		   <!--     </div>-->
		   <!--   </div>-->
		 
		 	 <!--    <div class="panel panel-default" >-->
		   <!--    <div class="panel-heading font-bold bg-info">小储云查课插件</div>-->
				 <!--   <div class="panel-body">-->
				 <!--   	 1、打开小储应用商店搜索 <b>29网课查询</b> 即可安装<br />-->
				 <!--   	 2、简直是无脑操作，比彩虹方便的很，插件内附有教程<br />-->
		   <!--     </div>-->
		   <!--   </div>-->
		      
	    <!--  <div class="panel panel-default">-->
		   <!--    <div class="panel-heading font-bold bg-success">彩虹进度同步插件&nbsp;<a class="btn btn-danger btn-xs" href="http://pan.29sq.cn/down.php/39818cb0b5c7f935c951471ccbd08623.rar">下载插件</a></div>-->
				 <!--   <div class="panel-body">-->
				 <!--   	 1、上传根目录解压<br />-->
				 <!--   	 2、监控该文件，建议5~10分钟执行一次    监控路径： http://你的代刷网域名/29wk_result.php?act=order  <br />-->
				 <!--   	 3、只针对使用本站自定义访问url对接的订单生效<br />      -->
		   <!--     </div>-->
		   <!--  </div>-->
		      
	      <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white">彩虹代刷对接/小储云对接（自定义访问URL）<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-platform">查看平台ID</button></div>
				 <div class="panel-body">
                                 自定义访问域名URL：<input type="text" class="layui-input" name="pass" value="http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=add" required>
								 
             POST提交参数：<input type="text" class="layui-input" name="pass" value="uid=你的uid&key=你的key密匙&platform=平台ID&school=学校&user=账号&pass=密码&kcname=课程名字"><br/>
       
                             
                                
                                <!--<h2>彩虹对接示列截图  ：</h2><br/>
            <img src="http://cloud.79tian.com/api/v3/file/get/8637/%E5%BD%A9%E8%99%B9%E5%AF%B9%E6%8E%A529wk%E6%88%AA%E5%9B%BE.png?sign=6krSNgVc3u7GNiNypjs4cOiNfdgonoxkx3BZ5JXADR0%3D%3A0" width="100%"/>  <br/><br/>                  
                                           
                               <h2> 小储对接示列截图  ：</h2> <br/>              
            <img src="http://cloud.79tian.com/api/v3/file/get/8636/%E5%B0%8F%E5%82%A8%E5%AF%B9%E6%8E%A529wk%E6%88%AA%E5%9B%BE.png?sign=PYxBMNrNNwGgMiEDS1N8kS4xHS66rr1cwbLXciOHq74%3D%3A0" width="100%"/>  
		    -->
		    </div>
		  </div>
		  

        <div class="modal fade primary" id="modal-platform">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">平台ID</h4>
                    </div>
                         		      <div class="table-responsive"> 
														         <table class="table table-striped">
														          <thead><tr><th>ID</th><th>平台名称</th></thead>
														          <tbody>
														          	
																						<?php 
											                     	 $a=$DB->query("select * from qingka_wangke_class where status=1 ");
											                     	 while($rs=$DB->fetch($a)){
											                     	 	  echo "<tr><td>".$rs['cid']."</td><td>".$rs['name']."</td></tr>"; 
											                     	 }
											                     	?>

														           
														          </tbody>
														        </table>
														      </div>
   
                    
                    <div class="modal-footer">
                        <button type="button" class="layui-btn layui-btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="layui-btn" data-dismiss="modal" @click="layer.msg('好的，靓仔')">知道了</button>
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
new Vue({
	el:"#loglist",
	data:{
		row:null
	},
	methods:{
		get:function(page){

		}
	},
	mounted(){
		this.get(1);
	}
});
</script>