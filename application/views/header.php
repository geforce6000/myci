<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("css/homepage2.css"); ?>">
    <title>江西九江科技中等专业学校欢迎你</title>
</head>
<body>
<!--LOGO及搜索框-->
<div class="logo">
    <div class="logo-badge">
        <img src="<?php echo base_url("/image/logo.png"); ?>">
    </div>
    <form action="<?php echo site_url('article/search'); ?>" method="post" class="logo-search">
        <div class="inputbox">
            <input class="" name="forsearching" type="text" placeholder="">
        </div>
        <div class="submitbox">
            <input class="" type="submit" value="搜索">
        </div>
    </form>
</div>