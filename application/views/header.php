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

<!--
	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
-->

	<!-- 自制的css样式表 
	<link rel="stylesheet" href="\css\article.css"> -->
	
</body>

	<title>

		江西九江科技中等专业学校欢迎你

	</title>

<body>

<div class="row">

  	<div class="large-8 columns">

		<!--首页logo-->

		<img src="\image\logo.png"><i class="magnifying-glass"></i>

	</div>

	<div class="large-4 columns">

		<!-- 搜索框 -->

		<form action="<?php echo site_url('article/search'); ?>" method="post">

			<div class="row collapse postfix">

				<div class="small-9 columns">

					<input name="forsearching" type="text" placeholder="搜索">

				</div>

				<div class="small-3 columns">

					

						<input type="submit" class="button postfix">
					

				</div>

			</div>

		</form>

	</div>

</div>

<!-- 导航栏，将来要做成单独的view -->

<div class="row">
		<div>
			<div class="medium-12 columns">
				<ul class="">
					<li class="">
						<a href="">
							首页
						</a>
					</li>
					<li id="">
						<a href="">
							资料
						</a>
						<ul id="" class="" style="display: none;">
							<li id="">
								工程管理系
							</li>
							<li>
								工程管理系
							</li>
							<li>
								信息技术系
							</li>
							<li>
								旅游商贸系
							</li>
							<li>
								人文系
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							信息
						</a>
					</li>
				</ul>
			</div>
		</div>
		<hr>