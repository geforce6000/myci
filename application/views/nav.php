<div class="row" id="nav">

<div class="sticky">

    <nav class="top-bar" data-topbar data-options="sticky_on: large">

	    <ul class="title-area">

		    <li class="name">

		      <!-- 如果你不需要标题或图标可以删掉它 -->

		      <h1><a href="<?php echo site_url();?>">首页</a></h1>

		    </li>

		      <!-- 小屏幕上折叠按钮: 去掉 .menu-icon 类，可以去除图标。 
		      如果需要只显示图片，可以删除 "Menu" 文本 -->

		    <li class="toggle-topbar menu-icon"><a href="#"><span>导航</span></a></li>

	  	</ul>

    	<section class="top-bar-section">
    
      		<ul class="left">

				<?php foreach ($parrent as $row): ?>

					<li class="has-dropdown">

						<a href="<?php echo site_url('article/category/').$row->classid?>"><?=$row->classname?></a>

						<ul class="dropdown">

							<?php foreach ($children[$row->classid] as $cname): ?>

								<li><a href="<?php echo site_url('article/category/').$cname->classid?>"><?=$cname->classname?></a></li>

							<?php endforeach; ?>

						</ul>

					</li>

				<?php endforeach; ?>

      		</ul>
      
    	</section>
  
  	</nav>

</div>

</div>

<div class="row">
