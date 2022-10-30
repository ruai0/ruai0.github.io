<?php
$mod='blank';
$title='价格列表';
require_once('head.php');
?>
 
<div class="lyear-layout-content" >
	<div class="app-content-body">
	    <div class="wrapper-md control">		
			<div class="row">
				<div class="col-sm-6">
					<b style="color: red; font-size: 20px;">注意：我的价格=倍数X我的费率</b>
		          <div class="panel panel-default">    
         		      <div class="table-responsive"> 
				         <table class="table table-striped">
				          <thead><tr><th>ID</th><th>平台名称</th><th>倍数X我的费率</th><th>（0.2 0.3 0.4 0.5 0.6）费率价格表</th><th>我的价格（<?php echo $userrow['addprice']?>）</th></thead>
				          <tbody>				          	
							<?php 
	                     	 $a=$DB->query("select * from qingka_wangke_class where status=1 ");
	                     	 while($rs=$DB->fetch($a)){
	                     	 	  echo "<tr><td>".$rs['cid']."</td>
	                     	 	  	<td>".$rs['name']."</td>
	                     	 	  	<td>(".$rs['price']."倍) X 我的费率</td>
	                     	 	  	<td>".($rs['price']*0.2).' | '.($rs['price']*0.3).' | '.($rs['price']*0.4).' | '.($rs['price']*0.5).' | '.($rs['price']*0.6)."</td>
	                     	 	  	<td>".($rs['price']*$userrow['addprice'])."</td>
	                     	 	  	</tr>"; 
	                     	 }
	                     	?>		           
				          </tbody>
				        </table>
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
	



