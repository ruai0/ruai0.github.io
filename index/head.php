<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?=$conf['sitename']?></title>
<meta name="keywords" content="<?=$conf['keywords'];?>" />
<meta name="description" content="<?=$conf['description'];?>" />
<link rel="icon" href="../favicon.ico" type="image/ico">
<meta name="author" content=" ">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/apps.css" type="text/css" />
<link rel="stylesheet" href="assets/css/app.css" type="text/css" />
<link rel="stylesheet" href="assets/layui/css/layui.css" type="text/css" />
<link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="assets/LightYear/css/style.min.css" rel="stylesheet">
<script src="assets/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
</head>
<?php
if($userrow['active']=="0"){
alert('您的账号已被封禁！','login');
}
?>
<body>
<div class="lyear-layout-web">
  <div class="lyear-layout-container">
    <!--左侧导航-->
    <aside class="lyear-layout-sidebar">
      
      <!-- logo -->
      <div id="logo" class="sidebar-header">
        <a href="index.php"><img src="../logo.png" title="LightYear" alt="LightYear" /></a>
      </div>
      <div class="lyear-layout-sidebar-scroll"> 
        
        <nav class="sidebar-main">
          <ul class="nav nav-drawer">
          	
		            <li class="nav-item "> 
			            <a href="index">
			               <i class="glyphicon glyphicon-home"></i> 首页</a> 
			            </li>
			     
			     <?php if($userrow['uid']==1){ ?>		  				           
						  <li class="nav-item">
			          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i>控制台 <span class="caret"></span></a>
					          <ul class="dropdown-menu">		       
					            <li><a href="webset">系统配置</a></li>
					            <li><a href="huoyuan">接口配置</a></li>
					            <li><a href="class">网课设置</a></li>
					            <li><a href="data">数据统计</a></li>
					            <li><a href="zhifu">支付接口</a></li>
					          </ul>
			        </li>      
			      <?php } ?>   
			            
		    <li class="nav-item "> 
            <a href="add">
              <i class="glyphicon glyphicon-plus"></i> 提交订单</a> 
            </li>
            
            <!-- <li class="nav-item "> -->
            <!--<a href="add2">-->
            <!--  <i class="glyphicon glyphicon-plus"></i> 批量查询</a> -->
            <!--</li>-->
            
            <li class="nav-item "> 
            <a href="add_pl">
              <i class="glyphicon glyphicon-plus"></i> 批量交单</a> 
            </li>

            <li class="nav-item"> 
            <a href="list">
            <i class="glyphicon glyphicon-th-list"></i>任务列表</a> 
            </li>
            
            <li class="nav-item"> 
            <a href="userlist">
            <i class="glyphicon glyphicon-user"></i>代理管理</a> 
            </li>
          
            <li class="nav-item"> 
            <a href="myprice">
            <i class="glyphicon glyphicon-list-alt"></i> 价格列表</a> 
            </li>
            <li class="nav-item"> 
            <a href="docking">
            <i class="glyphicon  glyphicon-retweet"></i> 平台对接</a> 
            </li>
            
           <li class="nav-item"> 
            <a href="charge">
            <i class="glyphicon  glyphicon-btc"></i>联系老大</a> 
            </li>
              <li class="nav-item"> 
            <a href="log">
            <i class="glyphicon glyphicon-list-alt"></i> 操作日志</a> 
            </li>
            <!--<li class="nav-item"> -->
            <!--<a href="help">-->
            <!--<i class="glyphicon glyphicon-info-sign"></i>使用说明</a> -->
            <!--</li>-->
            
            <!--<li class="nav-item"> -->
            <!--<a href="weiyu">-->
            <!--<i class="glyphicon glyphicon-comment"></i>站长微语</a> -->
            <!--</li>-->
          </ul>
        </nav>
        
        <div class="sidebar-footer">
          <p class="copyright">Copyright &copy; 2017-2021. <a target="_blank" href=""><?php echo $conf["title"] ?></a></p>
        </div>
      </div>
      
    </aside>
    <!--End 左侧导航-->
    
    <!--头部信息-->
    <header class="lyear-layout-header">
      
      <nav class="navbar navbar-default">
        <div class="topbar">
          
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <span class="navbar-page-title"> <?php echo $title;?> </span>
          </div>
          
        <ul class="topbar-right">
            <li class="dropdown dropdown-profile">
              <a href="javascript:void(0)" data-toggle="dropdown">
                  
                <span style="color:black"><?php echo $userrow['user']?><span class="caret"></span></span>
                <!--<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['user'];?>&spec=100" alt="Avatar" width="45" alt="avatar" style="height: auto filter: alpha(Opacity=80);-moz-opacity: 1;opacity: 1;" class="img-circle img-thumbnail img-thumbnail-avatar-1x animated zoomInDown">-->
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li> <a href="passwd.php"><i class="glyphicon glyphicon-wrench"></i> 修改密码</a> </li>
                <li> <a href="javascript:alert('傻逼，怎么可能让你来清理缓存！！！');"><i class="glyphicon glyphicon-trash"></i> 清空缓存</a></li>
                <li class="divider"></li>
                <li> <a href="../apisub.php?act=logout"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a> </li>
              </ul>
            </li>
          </ul>
          
        </div>
      </nav>
      
    </header>
    <!--End 头部信息-->
