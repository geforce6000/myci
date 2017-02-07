<div class="row">

<div id="slidebox" class="slideBox">

  	<ul class="items">

	  	<!--图片大小1000*300正好填满-->

	    <li><a href="http://www.jq22.com/" title="这里是测试标题一"><img src="./image/1.png"></a></li>

	    <li><a href="http://www.jq22.com/" title="这里是测试标题二"><img src="./image/2.png"></a></li>

	    <li><a href="http://www.jq22.com/" title="这里是测试标题三"><img src="./image/3.png"></a></li>

	    <li><a href="http://www.jq22.com/" title="这里是测试标题四"><img src="./image/4.png"></a></li>

	    <li><a href="http://www.jq22.com/" title="这里是测试标题五"><img src="./image/5.png"></a></li>

  	</ul>

</div>

</div>

<div class="row" id="mainframe">

	<div id="body">

		<div class="medium-8 columns">

			<h4>新闻动态</h4>

			<hr>

			<div id="news">

				<?php 

					foreach ($newslist['data'] as $row)

					{
						echo "<a href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a><br>";

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