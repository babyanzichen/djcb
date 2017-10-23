<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="{{asset('/')}}index/vote/ui.css">
  <style>
  ul li{
    font-size: 18px;
    font-family: 微软雅黑;
  }
  .more{
    margin-top: 50px;
    background-color: #F44336;
    width: 50%;
    margin-left: 25%;
    display: block;
    height: 30px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    color: white;
}
</style>
	<title>报名信息审核中</title>
<body style="background:#ffffff;overflow:hidden;">
<div class="header">
            <div class="header-background"></div>
            <div class="toolbar statusbar-padding">
                <button class="bar-button back-button" onclick="history.go(-1);" dwz-event-on-click="click"><i class="icon icon-back"></i></button>
                <!--<a class="bar-button" data-href="home.html?dwz_callback=home_render" target="navTab" rel="home"><i class="icon icon-back"></i></a>-->
                <div class="header-title">
                    <div class="title">评选报名</div>
                </div>
            </div>
        </div>  

<div class="container" style="text-align: center;
    padding-top: 30%;">
	<img src="{{asset('/')}}index/vote/checking.png">
  <h3>报名信息审核中......</h3>
  <h3>您已报名奖项:</h3>
  <ul>
     @foreach ($is as $i)
   
                <li>{{ $i -> awards  }}</li>
  @endforeach
 
    
  </ul>
  <a class="more" href="{{asset('/')}}vote/regs">报名更多</a>
</div>

<script type="text/javascript" src="{{asset('/')}}index/vote/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
 <script>
        wx.checkJsApi({
        jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
        success: function(res) {
        // 以键值对的形式返回，可用的api值true，不可用为false
        // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
        }
        });
        wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: '<?php echo $signPackage["timestamp"];?>',
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        'onMenuShareTimeline','onMenuShareAppMessage'
        ]
        });
        wx.ready(function(){
        wx.onMenuShareAppMessage({
        title: '我在参加汽车服务行业“财富金字塔”颁奖盛典', // 分享标题
        desc: '2017年11月18日 广州长隆酒店【荣耀开启】', // 分享描述
        link: 'http://www.djcb123.cn/vote/reg', // 分享链接
        imgUrl: 'http://www.djcb123.cn/index/vote/paramid.jpg', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
        },
        cancel: function () {
        alert("分享失败");
        }
        });
        wx.onMenuShareTimeline({
        title: '我在参加汽车服务行业“财富金字塔”颁奖盛典', // 分享标题
        desc: '2017年11月18日 广州长隆酒店【荣耀开启】', // 分享描述
        link: 'http://www.djcb123.cn/vote/reg', // 分享链接
        imgUrl: 'http://www.djcb123.cn/index/vote/paramid.jpg', // 分享图标
        success: function () {
        },
        cancel: function () {
        alert("分享失败");
        }
        });
        });
        </script> 

<script>
	var oOpen = document.getElementById("open");
	var oClose = document.getElementById("open");
	var oContainer = document.getElementById("container");

	oChai.onclick = function (){
		oChai.setAttribute("class", "rotate");
	};
</script>

</body></html>