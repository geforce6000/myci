<!DOCTYPE html>
<html>
<head>
  <title>后台管理</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/foundation/5.5.3/css/foundation.min.css">
  <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/foundation.min.js"></script>
  <script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/vendor/modernizr.js"></script>
  <link rel="stylesheet" href="http://static.runoob.com/assets/foundation-icons/foundation-icons.css">
  <!-- 自制的css样式表 -->
  <link rel="stylesheet" href="<?php echo base_url("css/article.css"); ?>">
  <script>
</script>
</head>
<body>
<!--管理页通用页头，所有的后台管理页都要加载-->
    <div >

        <div class="row" data-equalizer>

            <div class="large-2 columns" data-equalizer-watch style="background-color:#f1f1f1;">

                <ul class="side-nav">

                    <!--显示左侧菜单栏-->

                    <div id="blockabovemenu" class="show-for-large-up"></div>

                    <?php foreach ($menulist as $row): ?>

                        <li><a href="<?php echo site_url($row->menuurl); ?>"><?=$row->menu?></a></li>

                    <?php endforeach; ?>
                
                </ul>
            
            </div>