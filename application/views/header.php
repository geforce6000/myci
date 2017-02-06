<!-- 通用页头模板 -->

<!DOCTYPE html>

<head>

	<meta charset="UTF-8">

	<!-- 本站使用fundation5前端框架 -->

	<!-- css 文件 -->
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/foundation/5.5.3/css/foundation.min.css">

	<!-- jQuery 库 -->
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>

	<!-- JavaScript 文件 -->
	<script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/foundation.min.js"></script>

	<!-- modernizr.js 文件 -->
	<script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/vendor/modernizr.js"></script>

	<link rel="stylesheet" href="http://static.runoob.com/assets/foundation-icons/foundation-icons.css">

	<!--script src=".\js\unslider-min.js"></script>

	<link rel="stylesheet" href="\css\unslider.css"-->

	<!--jQuery图片轮播(焦点图)插件>

	<link href=".\css\jquery.slideBox.css" rel="stylesheet" type="text/css" />

	<script src=".\js\jquery.slideBox.min.js" type="text/javascript"></script-->

	<script>

		$(document).ready(function()

		{
    		
    		$(document).foundation();

    		//$('#slidebox').slideBox();

		});

	</script>

<!--
	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
-->

	<!-- 自制的css样式表 -->
	<link rel="stylesheet" href="\css\article.css">
	
</head>

	<title>

		江西九江科技中等专业学校欢迎你

	</title>

<body>

<div class="row" id="banner">

  	<div class="large-8 columns">

		<!--首页logo-->

		<img src="\image\logo.png">

	</div>

	<div class="large-4 columns">

		<!-- 搜索框 -->

		<div id="search">

			<form action="<?php echo site_url('article/search'); ?>" method="post">

				<div class="row collapse postfix">

					<div class="small-9 columns">

						<input name="forsearching" type="text" placeholder="搜索">

					</div>

					<div class="small-3 columns">

						<input type="submit" value="搜索" class="button postfix">

					</div>

				</div>

			</form>
			
		</div>

	</div>

</div>




