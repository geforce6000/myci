
<!-- 按classid显示该分类全部文章，按顺序逐条显示articleid和title，并做成超链接可以点击，点击后打开article页面-->

<div class="main">
	<div class="article-list">
	<div class="left-column">
		<?php
		include('\include\functions.php');
		if ($found)
		{
			echo "$navlink<hr>";
			foreach ($data as $row)
			{
				//echo "<h4><a href=".base_url('article/id/').$row->articleid.'>'.$row->title."</h4>";
				echo "<div class=\"news-line\">";
				echo "<div class=\"column-pic\">";
				if (substr($row->defaultpic,-3) == "jpg") {
					echo "<img class=\"categorylistthumb\" src=\"".$row->defaultpic."\">";
				} else {
					echo "<img class=\"categorylistthumb\" src=".base_url("\image\logo-thumb.gif")." width=\"140\">";
				}
				echo "</div>";
				echo "<div class=\"column-title\">";
				echo "<a href=".base_url('article/id/').$row->articleid.'><h4>'.$row->title."</h4></a>";
				$stripcontont=strip_tags($row->content);
				$stripcontont=utf8Substr($stripcontont,0,120);
				echo "<p>$stripcontont...</p></p>".utf8Substr($row->updatetime,0,10)."</p></div></div>";
				echo '<hr>';
				//逐条显示文件链接
			}
			//echo $links; //显示分页链接
		} else {
			echo '<h3>'.'没有相关文章'.'</h3>';
		}
		?>
	</div>
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
	</div></div>
	<?php echo $links; //显示分页链接 ?>

</div>

