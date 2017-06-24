<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("css/homepage.css"); ?>">
    <title>江西九江科技中等专业学校欢迎你</title>
</head>
<body>
    <div class="logo">
        <div class="logo-badge">
            <!--首页logo-->
            <img src="<?php echo base_url("/image/logo.png"); ?>">
        </div>
        <!-- 搜索框 -->
        <form action="<?php echo site_url('article/search'); ?>" method="post" class="logo-search">
            <div class="inputbox">
                <input class="" name="forsearching" type="text" placeholder="">
            </div>
            <div class="submitbox">
                <input class="" type="submit" value="搜索">
            </div>
        </form>
    </div>

    <div class="header">
        <div class="navbar">
            <div class="dropdown">
                <a href="<?php echo site_url();?>">首页</a>
            </div>
            <?php foreach ($parrent as $row): ?>
                <div class="dropdown">
                    <a href="<?php echo site_url('article/category/').$row->classid.'/0';?>"><?=$row->classname?></a>
                    <div class="dropdown-content">
                        <?php foreach ($children[$row->classid] as $cname): ?>
                            <a href="<?php echo site_url('article/category/').$cname->classid.'/0';?>"><?=$cname->classname?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="dropdown">
                <a href="#">名师工坊</a>
            </div>
        </div>
    </div>

    <div id="slidebox" class="slideBox banner">
        <!--轮播图-->
        <ul class="items">
            <!--图片大小1000*300正好填满-->
            <?php foreach($slidebox as $row): ?>
                <li><a href="<?php echo site_url("article/id/").$row->articleid; ?>" title="<?=$row->title?>"><img src="<?=$row->imagefile?>"></a></li>
            <?php endforeach; ?>
        </ul>
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
                        echo "<a href=\"".site_url('article/id/').$row->articleid."\">".$row->title."</a>";
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
            </div>
            <div class="party-work">
                <div class="line"></div>
                <h6 class="main-h6">党群工作</h6>
            </div>
            <div class="public-service">
                <div class="line"></div>
                <h6 class="main-h6">公共服务</h6>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="links">
            <div class="links-column-1">
                <h6>快速搜索</h6>
                <div class="quicklink">
                    <a href="<? echo base_url('article/category/80/0'); ?>">学校领导</a>
                    <a href="<? echo base_url('article/category/9/0'); ?>">教育教学</a>
                </div>
                <div class="quicklink">
                    <a href="<? echo base_url('article/category/132/0'); ?>">实训实训</a>
                    <a href="<? echo base_url('article/category/143/0'); ?>">党建园地</a>
                </div>
                <div class="quicklink">
                    <a href="<? echo base_url('article/category/108/0'); ?>">招生工作</a>
                    <a href="<? echo base_url('article/category/6/0'); ?>">系部活动</a>
                </div>
                <div class="quicklink">
                    <a href="<? echo base_url('article/category/103/0'); ?>">教学活动</a>
                    <a href="<? echo base_url('article/category/97/0'); ?>">新闻中心</a>
                </div>
            </div>
            <div class="links-column-2">
                <div class="quicksearch">
                    <h6>常用查询</h6>
                    <a href="<? echo base_url('article/search/实习/0'); ?>">实习</a>
                    <a href="<? echo base_url('article/search/比赛/0'); ?>">比赛</a>
                    <a href="<? echo base_url('article/search/培训/0'); ?>">培训</a>
                    <a href="<? echo base_url('article/search/招生/0'); ?>">招生</a>
                    <a href="<? echo base_url('article/search/报名/0'); ?>">报名</a>
                    <a href="<? echo base_url('article/search/中标/0'); ?>">中标</a>
                </div>
                <div class="friendlinks">
                    <h6>友情链接</h6>
                    <div class="outlink">
                        <a href="http://www.moe.edu.cn">中华人民共和国教育部</a>
                        <a href="http://www.jxedu.gov.cn">江西省教育网</a>
                        <a href="http://www.jje.cn">九江教育网</a>
                    </div>
                    <div class="outlink">
                        <a href="http://http://jxzcj.jxedu.gov.cn/">江西职业教育信息网</a>
                        <a href="http://zjsz.jxedu.gov.cn/MAOA/system/touchdesk/login.jsp">江西省职业教育综合管理平台</a>
                    </div>
                    <div class="outlink">
                        <a href="http://workshop.jxteacher.com/">老师工作坊</a>
                        <a href="http://f.jjxsw.cn/">九江分类信息网</a>
                        <a href="http://www.jjxsw.cn/">九江论坛</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wraper-copyright">
        <div class="copyright">
            <div class="columns-1 qrcode">
                <img src="<? echo base_url('image/qrcode.jpg'); ?>">
            </div>
            <div class="columns-2 address-text">
                <div class="address-text-1">
                    版权所有 九江科技中等专业学校，未经许可不得转载　网站备案：赣ICP备13004626号
                </div>
                <div class="address-text-2">
                    学校地址：江西省九江市学府二路1号　邮编：332000  技术支持：九江科技中专信息中心
                </div>
            </div>
        </div>
    </div>


    <link href="<?php echo base_url("css/jquery.slideBox.css"); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url("js/jquery.slideBox.min.js"); ?>" type="text/javascript"></script>
    <script>
        $('#slidebox').slideBox({
            duration : 0.3,//滚动持续时间，单位：秒
            easing : 'linear',//swing,linear//滚动特效
            delay : 5,//滚动延迟时间，单位：秒
            hideClickBar : false,//不自动隐藏点选按键
            clickBarRadius : 10
        });
    </script>
</body>
</html>