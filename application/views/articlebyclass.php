
<!-- 按classid显示该分类全部文章，按顺序逐条显示articleid和title，并做成超链接可以点击，点击后打开article页面-->

<?php

	if ($found)

	{

		foreach ($data as $row)

		{

			//$redtitle=str_replace($keyword, "<font color='#FF0000'>".$keyword."</font>", $row->title);
			//
			//echo $redtitle;

			echo '<p><a href='.base_url('article/id/').$row->articleid.'>'.$row->articleid.'.'.$row->title.'</a></p>';
		
		//逐条显示文件链接

		}

		//echo $links; //显示分页链接


	}

	else

	{

		echo '<h3>'.'没有查到数据'.'</h3>';
	
	}



?>