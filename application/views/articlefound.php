
<!-- 搜索文章结果视图，按顺序逐条显示articleid和title，并做成超链接可以点击，点击后打开article页面-->

<?php

	if ($found)

	{

		foreach ($data as $row)

		{

		echo '<p><a href='.base_url('article/id/').$row->articleid.'>'.$row->articleid.'.'.$row->title.'</a></p>';

		}


	}

	else

	{

		echo '<h3>'.'没有查到数据'.'</h3>';
	
	}



?>