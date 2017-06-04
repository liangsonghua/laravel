<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>得到</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="/amazeui/i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="/amazeui/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="/amazeui/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="/amazeui/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="/amazeui/css/amazeui.min.css">
  <link rel="stylesheet" href="/amazeui/css/app.css">
  <style type="text/css">
    .am-selected {
        width: 100%;
    }
    .am-list>li>.am-badge {
    float: left;
}
  </style>
</head>
<body>
  <div class="am-input-group am-input-group-lg">
  <span class="am-input-group-label">关注</span>
  <div>  <select data-am-selected="{btnSize: 'sm'}">
         <option value=''>请选择分类</option>
          <option value="1">豆瓣</option>
   </select>
 </div>
  <input type="text" class="am-form-field" placeholder="2号线">
  <button type="submit" class="am-btn am-btn-primary am-btn-block">确定</button>
</div>
<ul class="am-list am-list-static am-list-border  am-list-striped">
  <li>
     
     <div>
      <span class="am-badge am-badge-success">豆瓣:2号线</span> <span class="am-badge am-badge-danger">2017-06-21</span>
     </div>
   <a href="#">每个人都有一个死角， 自己走不出来，别人也闯不进去。</a>

  </li>
  <li><a href="#">我把最深沉的秘密放在那里。</a></li>
  <li><a href="#">你不懂我，我不怪你。</a></li>
  <li><a href="#">每个人都有一道伤口， 或深或浅，盖上布，以为不存在。</a></li>
</ul>

<!--在这里编写你的代码-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="http://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
</body>
</html>