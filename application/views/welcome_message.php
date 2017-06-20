<div class="row">

<div id="slidebox" class="slideBox large-12">

	<!--轮播图-->

  	<ul class="items">

	  	<!--图片大小1000*300正好填满-->

	  	<?php foreach($slidebox as $row): ?>

	  		<li><a href="<?php echo site_url("article/id/").$row->articleid; ?>" title="<?=$row->title?>"><img src="<?=$row->imagefile?>"></a></li>

	  	<?php endforeach; ?>

  	</ul>

</div>

</div>

<div class="row" id="mainframe">

	<div id="body">

		<div class="medium-8 columns">

			<h4>新闻动态</h4>

			<hr>

			<div id="news" class="row">

				<?php 

					foreach ($newslist['data'] as $row)

					{
						//echo "<div class='large-4 columns'>";

						echo "<a href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";

						echo $row->updatetime."<br>";

						//echo "</div>";

					}

				?>

			</div>

		</div>



		<div class="medium-4 columns">

			<h4>最新公告</h4>

			<hr>

			<div id="bulletin">

				<?php 

					foreach ($bulletin['data'] as $row)

					{
						echo "<a href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a><br>";

					}

				?>

			</div>

		</div>

	<!--p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p-->

	</div>

</div>

	<link href=".\css\jquery.slideBox.css" rel="stylesheet" type="text/css" />

	<script src=".\js\jquery.slideBox.min.js" type="text/javascript"></script>

	<script>

	$('#slidebox').slideBox({

		duration : 0.3,//滚动持续时间，单位：秒

		easing : 'linear',//swing,linear//滚动特效

		delay : 5,//滚动延迟时间，单位：秒

		hideClickBar : false,//不自动隐藏点选按键

		clickBarRadius : 10

	});

	</script>

</body>
</html>