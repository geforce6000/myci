
<!-- 单一文章显示模板，显示article控制器查询到的文章数据，如果没有查到，则显示'没有查到数据' -->

<div class="row" id="mainframe">

<?php

	if ($found)

	{

		echo '<h4 class="text-center">'.$data->title.'</h2>';

		echo '<h5 class="text-center">'.$data->poster.'</h5>';

		echo '<h5 class="text-center">'.$data->updatetime.'</h5>';

		echo '<hr>';

		echo '<p>'.$data->content.'</p>';

	}

	else

	{

		echo '<h3 class="text-center">没有相关文章</h3>';
	
	}

?>

</div>