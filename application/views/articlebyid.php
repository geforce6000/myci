
<!-- 单一文章显示模板，显示article控制器查询到的文章数据，如果没有查到，则显示'没有查到数据' -->

<div class="main article">
    <?php include('\include\functions.php'); ?>
    <!--左栏显示1篇文章含正文-->
    <div class="left-column">
        <?php
            if ($found) {
                echo '<h4 class="text-center">'.$data->title.'</h2>';
                echo '<h5 class="text-center">作者：'.$data->author.'</h5>';
                echo '<h5 class="text-center">更新时间：'.$data->updatetime.'    点击数: '.$data->hits.'</h5>';
                echo '<hr>';
                echo '<p>'.$data->content.'</p>';
            } else {
                echo '<h3 class="text-center">没有相关文章</h3>';
            }
        ?>
    </div>
    <!--右栏显示10篇最新文章标题-->
    <div class="right-column">
        <?php
            echo "<h4>最新新闻</h4>";
            foreach ($lastten['data'] as $row) {
                echo "<div class=\"columns content\">";
                //echo "<span class='small-text'>".utf8Substr($row->updatetime,0,10)."</span>";
                echo "<a class='small-text' href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";
                echo "</div>";
            }
        ?>
    </div>
</div>