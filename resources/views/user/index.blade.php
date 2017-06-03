<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
   <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<form class="form-horizontal" role="form" method="post" action="/addFocus">
                        {{ csrf_field() }}
       <div class="am-input-group am-input-group-lg">
          <span class="am-input-group-label">关注</span>
        <div>  <select data-am-selected="{btnSize: 'sm'}" name="type">
               <option value=''>请选择分类</option>
                <option value="豆瓣">豆瓣</option>
                 <option value="新闻">新闻</option>
         </select>
       </div>
        <input type="text" class="am-form-field" placeholder="2号线" name="keyword">
        <button type="submit" class="am-btn am-btn-primary am-btn-block">确定</button>
      </div>
  </form>
 <div>
  <?php if(count($focusChannel)):?>

您已关注: 
 <?php foreach ($focusChannel as $key => $focus):?>
<span class="am-badge am-badge-success"><?php echo $focus->type.':'.$focus->keyword;?></span>
<?php endforeach;?>
<?php endif;?>
</div>
<ul class="am-list am-list-static am-list-border  am-list-striped">
   <?php foreach ($models as $key => $value):?>
     <li>
        <div>
      <span class="am-badge am-badge-success"><?php echo $value['keyword'];?></span>
       <span class="am-badge am-badge-danger"><?php echo $value['time'];?></span>
     </div>
    <a href="<?php echo $value['url'];?>"><?php echo $value['title'];?></a> 
  </li>   
  <?php endforeach;?>
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