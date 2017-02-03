<?php
	foreach ($parrent as $row)
	{
		echo $row->classid.$row->classname.'<br>';
		foreach($children[$row->classid] as $cid)
		{
			echo '-->'.$cid->classid.$cid->classname.'<br>';
		}
	}
?>
