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
  <link rel="stylesheet" href="\css\article.css">
  <script>
</script>
</head>
<body>

    <div >

        <div class="row" data-equalizer>

            <div class="large-2 columns" data-equalizer-watch style="background-color:#f1f1f1;">

                <ul class="side-nav">

                    <!--li class="active"><a href="#">文章管理</a></li>
                    
                    <li><a href="#">首页轮播管理</a></li>
                    
                    < 暂时不想做了
                    li><a href="#">文章分类管理</a></li
                    >
                    
                    <li><a href="#">用户管理</a></li>
                    
                    <li><a href="#">访客分析</a></li-->

                    <?php foreach ($menulist as $row): ?>

                        <li><a href="<?php echo site_url($row->menuurl); ?>"><?=$row->menu?></a></li>

                    <?php endforeach; ?>
                
                </ul>
            
            </div>