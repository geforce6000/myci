<!-- 通用页头模板 -->

<!DOCTYPE html>

<head>

	<meta charset="UTF-8">

	<!-- 本站使用fundation5前端框架 -->

	<!-- css 文件 -->
	<!--link rel="stylesheet" href="http://cdn.static.runoob.com/libs/foundation/5.5.3/css/foundation.min.css"-->
	<link rel="stylesheet" href="<?php echo base_url("css/foundation.min.css"); ?>">

	<!-- jQuery 库 -->
	<!--script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script-->
	<script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>

	<!-- JavaScript 文件 -->
	<script src="<?php echo base_url("js/foundation.min.js"); ?>"></script>

	<!-- modernizr.js 文件 -->
	<script src="<?php echo base_url("js/modernizr.js"); ?>"></script>

	<link rel="stylesheet" href="<?php echo base_url("css/foundation-icons.css"); ?>">

	<!--welcome专用style-->
	<link rel="stylesheet" href="<?php echo base_url("css/welcome.css"); ?>">

	<!-- 自制的css样式表 -->
	<link rel="stylesheet" href="<?php echo base_url("css/article.css"); ?>">

	<script>

		$(document).ready(function()

		{
    		
    		$(document).foundation();

    		//$('#slidebox').slideBox();

		});

	</script>


	
</head>

	<title>

		江西九江科技中等专业学校欢迎你

	</title>

<body>

<div class="row" id="banner">

  	<div class="large-8 columns">

		<!--首页logo-->

		<img src="<?php echo base_url("/image/logo.png"); ?>">

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




