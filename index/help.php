<?php
$title='帮助中心';
require_once('head.php');
?>
 
<div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control" id="userlist">
        	

          <div class="card" class="">
             <div class="card-header">	
             	<h3 style="color: red;">新手必看帮助，以及任务进度</h3>
             </div>	
             
            <li class="list-group-item">
                  <span style="color: rgb(226, 139, 65);"><b><span style="font-size: 1.25em;"><span style="font-size: 14px; color: rgb(226, 139, 65);">主要完成类型：单选题 多选题 判断题 填空题 （支持图片题） ；不包英语听力完形填空 等异类题型 ！另外专业课请谨慎下单避免个别低分出现造成不必要的麻烦！</span></span></b><br></p><p><b><span style="font-size: 1.25em;"><span style="font-size: 14px;"><b style="color: rgb(32, 147, 97);">请勿手动打开考试</b><b style="color: rgb(227, 55, 55);">，最好不要提交规定时间的限时考试！</b></span>			            	
            </li>  
            
            <li class="list-group-item">
                                学习通：24小时完成，<span class="jg">包章节任务+测验+作业+考试；</span><br />
                                知到/智慧树：<span class="jg">见面课+章节+测验+平时分（习惯分），</span> 习惯分每天执行30分钟左右，隔天可以看到进度，因习惯分问题一般要执行7~15天！    <br />           
                                优学院：24小时左右完成，<span class="jg">只包课件+视频与考试！   </span>   <br />       
                                智慧职教：2天左右,<span class="jg">课件+视频+测验+考试（资源库不包考试）</span><br />
                                中国大学MOOC：2~3天，<span class="jg">目前只包课件+测验+考试！</span><br />
                U校园：2~3天，<span class="jg">包章节任务！</span><br />
                ismart：1~5分钟干完，<span class="jg">目前包章节任务+作业</span><br />
                                            湖南青马在线：1~5分钟干完，<span class="jg">目前包章节任务+作业+考试+评分</span><br />
                                             安全微伴：10~60分钟干完，<span class="jg">目前包课件+考试</span><br />
                                             蓝墨云班课：1~5分钟干完，<span class="jg">目前仅包资源</span><br />
                                             蓝墨云班课：1~5分钟干完，<span class="jg">目前仅包资源</span><br />
                e会学：1~5分钟干完，<span class="jg">目前包课件</span><br />
                                             学起plus 1天左右，<span class="jg">目前包课件+时长，时长挂满</span><br />
                                            云工训：1~5分钟干完，<span class="jg">仅包考试</span><br />
                                            普法网：1~5分钟干完，<span class="jg">全包</span><br />
            </li>              		          
          </div>

        	<style>
        		.jg{
        			font-size: 14px; 
        			color: rgb(226, 139, 65);
        		}
        		
        	</style>
        	
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
	

 
	     
<script src="assets/layui/layui.js"></script> 
<script>
//注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
layui.use('element', function(){
  var element = layui.element;
  
  //…
});
</script>
      