
<!-- 按classid显示该分类全部文章，按顺序逐条显示articleid和title，并做成超链接可以点击，点击后打开article页面-->

<div class="row" id="mainframe">

<?php

	include('\include\functions.php');

	if ($found)

	{

		echo "$navlink<hr>";

		foreach ($data as $row)

		{

			echo "<h4><a href=".base_url('article/id/').$row->articleid.'>'.$row->title."</h4>";

			echo "<div class=\"medium-2 columns categorylist\">";

			if (substr($row->defaultpic,-3) == "jpg")

			{

				echo "<img class=\"categorylistthumb\" src=\"".$row->defaultpic."\" width=\"140\">";

			}

			else

			{

				echo "<img class=\"categorylistthumb\" src=".base_url("\image\logo-thumb.gif")." width=\"140\">";

			}

			echo "</div></a>";

			echo "<div class=\"medium-10 columns\">";

			$stripcontont=strip_tags($row->content);

			$stripcontont=utf8Substr($stripcontont,0,200);

			echo "<p>$stripcontont...</p></p>$row->updatetime</p></div>";

			echo '<hr>';
		
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