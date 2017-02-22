<!--用户管理页，可以添加和修改用户信息-->
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

<!--模态框，重设一个管理员信息-->
<div id="updateuserinfo" class="reveal-modal tiny" data-reveal>
    <h2>重设管理员信息</h2>
    <hr>
    <form action="<?php echo site_url('admin/updateuserinfo')?>" method="post">
        <label for="useridup" class="hide">用户编号
            <input type="text" name="useridup" id="useridup" value="">
        </label>
        <label for="usernameup">用户名
            <input type="text" name="usernameup" id="usernameup" value="">
        </label>
        <label for="passwordup">密码
            <input type="password" name="passwordup" id="passwordup" value="<?php echo set_value('passwordup'); ?>">
        </label>
        <label for="passconfup">密码
            <input type="password" name="passconfup" id="passconfup" value="<?php echo set_value('passconfup'); ?>">
        </label>
        <label for="phoneup" class="hide">手机号码
            <input type="text" name="phoneup" id="phoneup" value="">
        </label>
        <label for="emailup" class="hide">电子邮箱
            <input type="text" name="emailup" id="emailup" value="">
        </label>
        <label for="levelup" class="hide">用户等级
            <input type="text" name="levelup" id="levelup" value="">
        </label>
        <input class="button" id="userinfosubmit" type="submit" value="提交">
    </form>
    <a class="close-reveal-modal">&times;</a>


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

    function userinfochange(id)
    {
        var uid = "#"+id[0];
        $("#useridup").val(id[0]);
        $("#usernameup").val($(uid).val());
        $("#phoneup").val($(uid+"phone").val());
        $("#emailup").val($(uid+"email").val());
        $("#levelup").val($(uid+"level").val());
    }
</script>