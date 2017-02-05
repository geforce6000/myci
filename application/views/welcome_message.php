
<div class="row">

	<div id="body">

		<?php

			foreach ($article as $row)
				{
				    echo $row['articleid'].'</br>'.$row['title'].'</br>'.$row['updatetime'].'</br>';
				    
				    echo $row['content'];
				}

		?>

	</div>

	<!--p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p-->
</div>

</body>
</html>