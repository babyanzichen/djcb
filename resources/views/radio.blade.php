<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0">
        <!-- StyleSheet -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/')}}index/radio/player/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/')}}index/radio/player/css/common.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/')}}index/radio/player/css/index.css">
        <link rel="icon" href="{{ asset('/')}}index/radio/player/img/favicon.ico" />
        <title>点金车友电台</title>
        <!-- Script -->
        <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript" src="{{ asset('/')}}index/radio/player/lib/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="{{ asset('/')}}index/radio/player/lib/handlebars-v4.0.10.js"></script>
        <script type="text/javascript" src="{{ asset('/')}}index/radio/player/lib/iscroll.js"></script>
        <script type="text/javascript">
        	const url="{{ asset('/')}}index/radio/";
        </script>
        <script type="text/javascript" src="{{ asset('/')}}index/radio/player/js/main.js"></script>
    </head>
    
    <body>
        <!-- 加载页 -->
        <div class="m-loader">
            <div class='loader_overlay'></div>
            <div class='loader_cogs'>
                <div class='loader_cogs__top'>
                    <div class='top_part'></div>
                    <div class='top_part'></div>
                    <div class='top_part'></div>
                    <div class='top_hole'></div>
                </div>
                <div class='loader_cogs__left'>
                    <div class='left_part'></div>
                    <div class='left_part'></div>
                    <div class='left_part'></div>
                    <div class='left_hole'></div>
                </div>
                <div class='loader_cogs__bottom'>
                    <div class='bottom_part'></div>
                    <div class='bottom_part'></div>
                    <div class='bottom_part'></div>
                    <div class='bottom_hole'></div>
                </div>
            </div>
        </div>
        <!-- END 加载页 -->
        <audio id="audio" preload type="audio/mpeg"></audio>
        <!-- 主页 -->
        <div id="index" class="page index hide">
            <!-- 头部 -->
            <div class="g-header btm-line">
                <div class="m-header">
                    <div class="cog">
                        <i class="icon icon-cog"></i>
                    </div>
                    <div class="title">欢迎您:{{Session::get('user')["nickname"]}}</div>
                    <div class="user">
                        <i class="icon icon-user"></i>
                    </div>
                </div>
                <!-- END头部 -->
                <!-- 搜索模块 -->
                <div class="g-search btm-line">
                    <div class="m-search">
                        <input id="search" type="text" placeholder="Search music">
                        <i class="icon icon-search"></i>
                    </div>
                </div>
                <!-- END搜索模块 -->
                <!-- 导航模块 -->
                <div class="g-nav">
                    <ul class="m-nav">
                        <li class="nav list active">今日推荐</li>
                        <li class="nav love">我的最爱</li>
                        <li class="nav search">搜索结果</li></ul>
                </div>
                <!-- END导航模块 --></div>
            <!-- 歌曲列表模块 -->
            <div class="g-songlist">
                <div class="sliderWrap" id="sliderWrap-1">
                    <ul class="m-songlist" id="songlist">
                    @include('angular-stuff'); <!-- app/views/angular-stuff.php -->
                        
                    </ul>
                </div>
                <div class="sliderWrap" id="sliderWrap-2">
                    <ul class="m-songlist m-songlist-l" id="lsonglist">还没有喜爱的歌曲，赶紧在列表中添加吧！</ul></div>
                <div class="sliderWrap" id="sliderWrap-3">
                    <ul class="m-songlist m-songlist-s" id="ssonglist">搜索功能暂未实现</ul></div>
            </div>
            <!-- END歌曲列表模块 -->
            <!-- 底部 -->
            <div class="g-footer">
                <div class="m-footer">
                    <div class="tip">当前列表共
                        <span id="totalsong" class="totalsong"></span>首歌</div></div>
            </div>
            <!-- END底部 --></div>
        <!-- END主页 -->
        <!-- 播放页 -->
        <div id="play" class="page play">
            <!-- 头部 -->
            <div class="g-header btm-line">
                <div class="m-header">
                    <div class="back">
                        <i class="icon icon-arrow-left"></i>
                    </div>
                    <div class="title">点金车友电台</div>
                    <div class="user">
                        <i class="icon icon-user"></i>
                    </div>
                </div>
            </div>
            <!-- END头部 -->
            <!-- 主体 -->
            <div class="g-main">
                <!-- 音量控制模块 -->
                <div class="g-volctrl">
                    <div class="m-volctrl">
                        <i class="icon icon-volume-mute"></i>
                        <div class="m-progress m-progress-volume">
                            <div id="volprogress" class="progress"></div>
                            <div id="volbar" class="progressbar"></div>
                        </div>
                        <i class="icon icon-volume-high"></i>
                    </div>
                </div>
                <!-- END音量控制模块 -->
                <!-- 歌词模块 -->
                <div class="g-lrc">
                    <div class="m-lrc">
                        <div class="lrc-box" id="lrcbox">
                            <section class="lrc-no hide">
                                <div id="lrcbg" class="lrc-bg">
                                    <img id="lrcimg" src="" style="width: 100%; border-radius: 50%; border:2px solid rgba(255,255,255,0.8);"></div>
                            </section>
                            <section class="lrc">
                                <div class="lrc-wrap" id="lrc-wrap"></div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- END歌词模块 -->
                <!-- 歌曲信息模块 -->
                <div class="g-songinfo">
                    <div class="m-songinfo">
                        <h1 id="psongname" class="songname">明天你好</h1>
                        <h2 id="psinger" class="singer">牛奶咖啡</h2></div>
                </div>
                <!-- END歌曲信息模块 -->
                <!-- 歌曲控制模块 -->
                <div class="g-panel">
                    <div class="m-progress m-progress-song">
                        <div id="songprogress" class="progress"></div>
                        <div id="songbar" class="progressbar"></div>
                        <ul class="songtime">
                            <li class="start" id="start">0:00</li>
                            <li class="end" id="end">0:00</li></ul>
                    </div>
                    <div class="m-playcontrol">
                        <a class="btn btn-prev"></a>
                        <a class="btn btn-control btn-play"></a>
                        <a class="btn btn-next"></a>
                    </div>
                    <div class="m-playoptions">
                        <a class="icon icon-menu"></a>
                        <a class="icon icon-random"></a>
                        <a class="icon icon-loop"></a>
                    </div>
                </div>
            </div>
            <!-- END主体 --></div>
        <!-- END播放页 -->
        <!-- 用户页 -->
        <div class="g-user">
            <div class="m-user">
                <h2>项目目的</h2>
                <p>此项目纯属个人爱好，用于研究H5音频相关API和JS模板渲染及动态加载，其中涉及handlebar模板渲染、下拉动态渲染、H5本地存储、移动端rem自适应布局等，其中仍有很多不完善之处，欢迎交流和指正。</p>
            </div>
        </div>
        <!-- END用户页 --></body>
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
     title: '点金车友电台', // 分享标题
      desc: '点金车友电台——您旅途中的音乐之友', // 分享描述
      link: 'http://www.djcb123.cn/radio/index', // 分享链接
      imgUrl: 'http://www.djcb123.cn/index/radio/player/img/player.jpeg', // 分享图标
      type: '', // 分享类型,music、video或link，不填默认为link
      dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
      success: function () {
          
          
          
          
          
          
          
          
      },
      cancel: function () {
         alert("分享失败");
      }
  });

  wx.onMenuShareTimeline({
      title: '点金车友电台', // 分享标题
      desc: '点金车友电台——您旅途中的音乐之友', // 分享描述
      link: 'http://www.djcb123.cn/radio/index', // 分享链接
      imgUrl: 'http://www.djcb123.cn/index/radio/player/img/player.jpeg', // 分享图标
      success: function () {
          
          
          
          
          
          
          
      },
      cancel: function () {
         alert("分享失败");
      }
  });

  });
</script>
</html>