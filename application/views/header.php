<!-- 通用页头模板 -->

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<!-- 自制的css样式表 -->
	<link rel="stylesheet" href="\css\article.css"> 
</body>
	<title>
		江西九江科技中等专业学校欢迎你
	</title>
<body>


<!--首页logo-->

<img src="\image\logo.png">


<!-- 搜索框 -->

<?

	$this->load->helper('url');//载入url辅助函数，为了下面使用site_url()函数

	$this->load->helper('form');//载入form辅助函数

	echo form_open(site_url('article/search'));//使用form辅助函数，产生一个form头，中间使用site_url()函数产生规范的url地址，搜索框的内容提交到article控制器的search方法

	echo form_input('forsearching','搜索');//input框

	echo form_submit('tosearch', '搜索');//submit按钮

	echo form_close();//form结束

?>


<!-- 导航栏，将来要做成单独的view -->

<div class="container" id="MD">
		<div class="row">
			<div class="span12">
				<ul class="nav nav-pills">
					<li class="active">
						<a href="">
							首页
						</a>
					</li>
					<li id="flip">
						<a href="">
							资料
						</a>
						<ul id="panel" class="dropdown-menu" style="display: none;">
							<li id="eng">
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