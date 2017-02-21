<div class="large-10 columns" data-equalizer-watch>
    <h1 class="headline">用户管理
        <button type="button" class="button right" data-reveal-id="newadmin">新建管理员</button>
    </h1>
    <hr>
    <div id="table">
        <!--显示轮播图编辑列表-->
        <?php echo $user; ?>
    </div>
</div>

<!--模态框，新建一个管理员帐号-->
<?php echo validation_errors(); ?>
<div id="newadmin" class="reveal-modal tiny" data-reveal>
    <h2>新管理员信息</h2>
    <hr>
    <form action="<?php echo site_url('admin/newuser')?>" method="post">
        <label for="username">用户名
            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
        </label>
        <label for="password">密码
            <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>">
        </label>
        <label for="passconf">密码
            <input type="password" name="passconf" id="passconf" value="<?php echo set_value('passconf'); ?>">
        </label>
        <label for="phone">手机号码
            <input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>">
        </label>
        <label for="email">电子邮箱
            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>">
        </label>
        <label for="level">用户等级
            <input type="text" name="level" id="level" value="<?php echo set_value('level'); ?>">
        </label>
        <input class="button" id="newadminsubmit" type="submit" value="提交">
    </form>
    <a class="close-reveal-modal">&times;</a>
</div>

<!--模态框，重设一个管理员密码-->
<div id="newpassword" class="reveal-modal tiny" data-reveal>
    <h2>重设密码</h2>
    <hr>

</div>

<script>
    $(document).ready(function()
    {
        $(document).foundation();
        //fundation初始化
    })

    function passed (id)
    {
        $.post("/admin/adminpass", { id : id } ,

            function(data,status)

            {

            }

        )
    }
</script>