<?php
$title='站长微语';
require_once('head.php');
?>
 

  <div class="lyear-layout-content" role="main">
     <div class="app-content-body ">
        <div class="wrapper-md control">
        	
        	 <div class="card">
            <li class="list-group-item">				            	
                 2021-9-2：  终日奔波只为饥，方才一饱便思衣。衣食两般皆俱足，又想娇容美貌妻。娶得美妻生下子，恨无田地少根基。买到田园多广阔，出入无船少马骑。槽头扣了骡和马，叹无官职被人欺。作了皇帝求仙术，更想登天跨鹤飞。若要世人心里足，除是南柯一梦西。
            </li>   		          
          </div>   
        	
           <div class="card">
            <li class="list-group-item">				            	
                 2021-6-17： 今日的事已不必再提，皆因工资不够，我大抵是得给经理写一份文书了。之所以说是文书，因为若是叫做辞职信，不免有种低三下四的味道，我当不必如此。人非圣贤孰能无过，我不过是贪更多的钱罢了！
 
          </div>
                 	
          <div class="card">
            <li class="list-group-item">				            	
                 2021-6-11：  以前稍微有点头疼脑热的，医生就给你全身的病都看了。后来头疼医头，脚疼医脚。再后来头疼砍头，脚疼还是砍头。。。
            </li>   		          
          </div>
          
           <div class="card">
            <li class="list-group-item">				            	
                 2021-6-10：  我好像是一只牛，吃的是草，挤出的是奶、血。
            </li>   		          
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
	