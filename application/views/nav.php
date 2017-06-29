<!--导航条-->
<div class="header">
    <div class="nav-bar">
        <div class="drop-down">
            <a href="<?php echo site_url();?>">首页</a>
        </div>
        <?php foreach ($parrent as $row): ?>
            <div class="drop-down">
                <a href="<?php echo site_url('article/category/').$row->classid.'/0';?>"><?=$row->classname?></a>
                <div class="drop-down-content">
                    <?php foreach ($children[$row->classid] as $cname): ?>
                        <a href="<?php echo site_url('article/category/').$cname->classid.'/0';?>"><?=$cname->classname?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="drop-down">
            <a href="#">名师工坊</a>
        </div>
    </div>
</div>