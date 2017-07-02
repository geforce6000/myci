<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?php echo base_url($slidebox[0]->imagefile); ?>" alt="First slide">
            <div class="carousel-caption">
                <a href="<?php echo site_url("article/id/").$slidebox[0]->articleid; ?>"><?php echo $slidebox[0]->title; ?></a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url($slidebox[1]->imagefile); ?>" alt="First slide">
            <div class="carousel-caption">
                <a href="<?php echo site_url("article/id/").$slidebox[1]->articleid; ?>"><?php echo $slidebox[1]->title; ?></a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url($slidebox[2]->imagefile); ?>" alt="First slide">
            <div class="carousel-caption">
                <a href="<?php echo site_url("article/id/").$slidebox[2]->articleid; ?>"><?php echo $slidebox[2]->title; ?></a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url($slidebox[3]->imagefile); ?>" alt="First slide">
            <div class="carousel-caption">
                <a href="<?php echo site_url("article/id/").$slidebox[3]->articleid; ?>"><?php echo $slidebox[3]->title; ?></a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url($slidebox[4]->imagefile); ?>" alt="First slide">
            <div class="carousel-caption">
                <a href="<?php echo site_url("article/id/").$slidebox[4]->articleid; ?>"><?php echo $slidebox[4]->title; ?></a>
            </div>
        </div>
    </div>
    <div class="arrow"><a class="carousel-control left" href="#myCarousel"data-slide="prev">&lsaquo;</a></div>
    <div class="arrow"><a class="carousel-control right" href="#myCarousel"data-slide="next">&rsaquo;</a></div>
</div>

<div class="main">
    <?php include('\include\functions.php'); ?>
    <div class="line-1 news">
        <h6 class="main-h6">新闻中心</h6>
        <div class="news-column">
            <?php
            foreach ($newslist['data'] as $row) {
                echo "<div class=\"columns content\">";
                echo "<div class=\"news-header\">";
                echo "<a href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a></div>";
                if (substr($row->defaultpic,-3) == "jpg")
                {
                    echo "<div class=\"categorylistthumb\">";
                    echo "<img src=\"".$row->defaultpic."\" width=\"100%\"></div>";
                } else
                {
                    echo "<div class=\"categorylistthumb\">";
                    echo "<img src=".base_url("\image\default.JPG")." width=\"100%\"></div>";
                }
                $stripcontont=strip_tags($row->content);
                $stripcontont=utf8Substr($stripcontont,0,70);
                echo "<p>$stripcontont...</p>";
                echo "<p class='news-updatetime'>".utf8Substr($row->updatetime,0,10)."</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div class="line-2">
        <div class="party-banner">
            <img src="<?php echo base_url("/image/lxyz.jpg"); ?>">
        </div>
    </div>
    <div class="line-3">
        <div class="education">
            <div class="line"></div>
            <h6 class="main-h6">教育教学</h6>
            <div class="education-column">
                <?php
                foreach ($education['data'] as $row) {
                    echo "<div class=\"columns content\">";
                    echo "<a href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";
                    $stripcontont=strip_tags($row->content);
                    $stripcontont=utf8Substr($stripcontont,0,70);
                    echo "<p>$stripcontont...</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <div class="announce">
            <div class="line"></div>
            <h6 class="main-h6">通知公告</h6>
            <div class="announce-column">
                <?php
                foreach ($announce['data'] as $row) {
                    echo "<div class=\"columns content\">";
                    echo "<span class='small-text'>".utf8Substr($row->updatetime,0,10)."</span>";
                    echo "<a class='small-text' href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="line-4">
        <div class="recruit">
            <div class="line"></div>
            <h6 class="main-h6">招生就业</h6>
            <?php
            foreach ($recruit['data'] as $row) {
                echo "<div class=\"columns content\">";
                echo "<span class='small-text'>".utf8Substr($row->updatetime,0,10)."</span>";
                echo "<a class='small-text' href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="partywork">
            <div class="line"></div>
            <h6 class="main-h6">党群工作</h6>
            <?php
            foreach ($partywork['data'] as $row) {
                echo "<div class=\"columns content\">";
                echo "<span class='small-text'>".utf8Substr($row->updatetime,0,10)."</span>";
                echo "<a class='small-text' href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="publicservice">
            <div class="line"></div>
            <h6 class="main-h6">公共服务</h6>
            <div class="icons">
                <div class="icon">
                    <div class="icon-logo"><img src="<?php echo base_url("/image/xzxx.png"); ?>"></div>
                    <div class="icon-text"><a href="">校长信箱</a></div>
                </div>
                <div class="icon">
                    <div class="icon-logo"><img src="<?php echo base_url("/image/zxly.png"); ?>"></div>
                    <div class="icon-text"><a href="">在线留言</a></div>
                </div>
                <div class="icon">
                    <div class="icon-logo"><img src="<?php echo base_url("/image/zxbm.png"); ?>"></div>
                    <div class="icon-text"><a href="https://218.204.71.43:6443/">VPN</a></div>
                </div>
                <div class="icon">
                    <div class="icon-logo"><img src="<?php echo base_url("/image/server.png"); ?>"></div>
                    <div class="icon-text"><a href="<?php echo site_url("admin/loginpage"); ?>">后台入口</a></div>
                </div>
                <div class="icon">
                    <div class="icon-logo"><img src="<?php echo base_url("/image/bym.png"); ?>"></div>
                    <div class="icon-text"><a href="http://jxnet.jxedu.gov.cn/jxzcj/searchzsh.jsp">毕业证验证</a></div>
                </div>
                <div class="icon">
                    <div class="icon-logo"><img src="<?php echo base_url("/image/szhxy.png"); ?>"></div>
                    <div class="icon-text"><a href="http://www.jjkjzz.com:8680/">数字化校园</a></div>
                </div>
            </div>
        </div>
    </div>
</div>