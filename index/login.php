<?php
include('../confing/common.php');
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8"/>
        <link rel="icon" href="../favicon.ico" type="image/ico">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?=$conf['sitename'];?></title>
        <meta name="keywords" content="<?=$conf['sitename'];?>"/>
        <meta name="description" content="<?=$conf['sitename'];?>"/>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../assets/layui/css/layui.css"/>
        <style>
            body {
                background-image: url("../beijingtu.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 100vh;
            }
        </style>
    </head>
    <body>
        <div class="layui-container">
            <div class="layui-col-xs12 layui-col-sm10 layui-col-lg6 center-block" style="float: none; padding: 30px; ">
                <div class="layui-row" id="login1" style="margin-top: 90px;">
                    <center>
                        <h1><span style="background: linear-gradient(to right, red, blue);-webkit-background-clip: text;color: transparent;"><?=$conf['sitename'];?></span></h1>
                        
                        <!--<img class="layui-anim layui-anim-up" src="../logo.png" width="250px"/>-->
                    </center>
                    <!--<center style="margin-top: 20px;"><strong>-  91学习网平台  -</strong></center>-->
                    <div class="layui-row" style="padding: 20px; margin-top: 60;">
                        <div v-if="loginType" class="layui-card">
                            <div class="layui-card-header layui-bg-green" style="background: #5FB878;">
                                管理登录&nbsp;<button class="btn btn-xs btn-warning" @click="newlogin">注册</button>
                            </div>
                            <div class="layui-card-body">
                                <div class="layui-form" id="form-login">
                                    <div class="layui-form-item">
                                        <input type="text" v-model="dl.user" required lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input ">
                                    </div>
                                    <div class="layui-form-item">
                                        <input type="password" v-model="dl.pass" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-item" style="padding: 5 0 px;">
                                        <button class="layui-btn btn-danger" @click="login" style="width: 100%">立即登录</button>
                                    </div>
                                    <!--<div class="layui-form-item">-->
                                    <!--    <button class="layui-btn layui-btn-lg layui-btn-primary layui-btn-radius layui-btn-fluid" id="connect_qq">-->
                                    <!--        <img src="../assets/images/qq.png" style="height:28px;margin: -4px 5px 0 5px;">&nbsp;QQ快捷登录-->
                                    <!--    </button>-->
                                    <!--</div>-->
</from></div></div></div>
<div class="layui-card" v-else>
    <div class="layui-card-header layui-bg-green">
        快捷注册&nbsp;<button class="btn btn-xs btn-danger" @click="newlogin">登录</button>
    </div>
    <div class="layui-card-body">
        <div class="layui-form" id="form-login">
            <div class="layui-form-item">
                <input type="text" v-model="reg.name" required lay-verify="required" placeholder="昵称" autocomplete="off" class="layui-input ">
            </div>
            <div class="layui-form-item">
                <input type="text" v-model="reg.user" required lay-verify="required" placeholder="账号（账号必须为QQ号）" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-item">
                <input type="password" v-model="reg.pass" required lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-item">
                <input type="text" v-model="reg.yqm" required lay-verify="required" placeholder="邀请码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-item" style="padding: 5 0 px;">
                <button class="layui-btn btn-danger" style="width: 100%" @click="register">立即注册</button>
            </div>
</from></div></div></div>
<div class="text-center" style="padding: 20px;font-size: 18px;">
    <p>
        <small class="text-muted">
            <?=$conf['sitename'];?> <br>&copy;2017~2021
        </small>
    </p>
</div>
</div></div></div></div></body></html><script src="assets/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script>
    var vm = new Vue({
        el: "#login1",
        data: {
            loginType: true,
            title: "你在看什么呢？我写的代码好看吗",
            dl: {},
            reg: {}
        },
        methods: {
            newlogin: function() {
                this.loginType = !this.loginType
            },
            login: function() {
                if (!this.dl.user || !this.dl.pass) {
                    layer.msg('账号密码不能为空', {
                        icon: 2
                    });
                    return
                }
                var loading = layer.load();
                vm.$http.post("/apisub.php?act=login", {
                    user: this.dl.user,
                    pass: this.dl.pass
                }, {
                    emulateJSON: true
                }).then(function(data) {
                    layer.close(loading);
                    if (data.data.code == 1) {
                        layer.msg(data.data.msg, {
                            icon: 1
                        });
                        setTimeout(function() {
                            window.location.href = "index.php"
                        }, 1000);
                    } else if (data.data.code == 5) {
                        vm.login2();
                    } else {
                        layer.msg(data.data.msg, {
                            icon: 2
                        });
                    }
                });

            },
            register: function() {
                if (!this.reg.user || !this.reg.pass || !this.reg.name || !this.reg.yqm) {
                    layer.msg('所有项不能为空', {
                        icon: 2
                    });
                    return
                }
                var loading = layer.load();
                this.$http.post("/apisub.php?act=register", {
                    name: this.reg.name,
                    user: this.reg.user,
                    pass: this.reg.pass,
                    yqm: this.reg.yqm
                }, {
                    emulateJSON: true
                }).then(function(data) {
                    layer.close(loading);
                    if (data.data.code == 1) {
                        this.loginType = true;
                        this.dl.user = this.reg.user;
                        this.dl.pass = this.reg.pass;
                        layer.msg(data.data.msg, {
                            icon: 1
                        });
                    } else {
                        layer.msg(data.data.msg, {
                            icon: 2
                        });
                    }
                });
            },
            login2: function() {
                layer.prompt({
                    title: '管理二次验证',
                    formType: 3
                }, function(pass2, index) {
                    var loading = layer.load();
                    vm.$http.post("/apisub.php?act=login", {
                        user: vm.dl.user,
                        pass: vm.dl.pass,
                        pass2: pass2
                    }, {
                        emulateJSON: true
                    }).then(function(data) {
                        layer.close(loading);
                        if (data.data.code == 1) {
                            layer.msg(data.data.msg, {
                                icon: 1
                            });
                            setTimeout(function() {
                                window.location.href = "index.php"
                            }, 1000);
                        } else {
                            layer.msg(data.data.msg, {
                                icon: 2
                            });
                        }
                    });
                });
            }
        }
    });

    $('#connect_qq').click(function() {
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "../apisub.php?act=connect",
            data: {},
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                if (data.code == 0) {
                    window.location.href = data.url;
                } else {
                    layer.alert(data.msg, {
                        icon: 7
                    });
                }
            }
        });
    });
</script>
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
