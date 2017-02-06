
<!-- 搜索文章结果视图，按顺序逐条显示articleid和title，并做成超链接可以点击，点击后打开article页面-->

<div class="row" id="mainframe">

<?php

	if ($found)

	{

		$startwith+=1; //计算机计数以0开始，实际显示的起始数应该加1

		echo "<p>共找到 $datascale 条记录，正在显示第 $startwith - $endwith 条</p>";

		foreach ($data as $row)

		{

			$redtitle=str_replace($keyword, "<font color='#FF0000'>".$keyword."</font>", $row->title);
			//把title中的关键字颜色设成红色

			echo '<p><a href='.base_url('article/id/').$row->articleid.'>'.$row->articleid.'.'.$redtitle.'</a></p>';
			//逐条显示文件链接

		}

		echo $links; //显示分页链接

	}

	else

	{

		echo '<h3>'.'没有相关文章'.'</h3>';
	
	}



?>

</div>