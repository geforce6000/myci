
<!-- 按classid显示该分类全部文章，按顺序逐条显示articleid和title，并做成超链接可以点击，点击后打开article页面-->

<div class="row" id="mainframe">

<?php

	if ($found)

	{

		echo $navlink;

		//echo '<p><a href="'.base_url('article/category/').$parrentname->classid.'">'.$parrentname->classname.'</a> > '.'<a href="'.base_url('article/category/').$childrenname->classid.'">'.$childrenname->classname.'</a></p>';

		foreach ($data as $row)

		{

			//$redtitle=str_replace($keyword, "<font color='#FF0000'>".$keyword."</font>", $row->title);
			//
			//echo $redtitle;

			echo '<p><a href='.base_url('article/id/').$row->articleid.'>'.$row->articleid.'.'.$row->title.'</a></p>';
		
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