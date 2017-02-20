<div class="large-10 columns" data-equalizer-watch>
    <h1 class="headline">用户管理
        <button type="button" class="button right" data-reveal-id="newadmin">新建管理员</button>
    </h1>
    <hr>
    <div id="able">
        <!--显示轮播图编辑列表-->
        <?php echo $user; ?>
    </div>
</div>

<!--模态框，新建一个管理员帐号-->
<div id="newadmin" class="reveal-modal tiny" data-reveal>
    <h2>新管理员信息</h2>
    <hr>
    <form action="<?php echo site_url('admin/newadmin')?>" method="post">
        <label for="username">用户名
            <input type="text" name="username" id="username">
        </label>
        <label for="password">密码
            <input type="password" name="password" id="password">
        </label>
        <label for="password2">再输入一遍密码
            <input type="password" name="password2" id="password2" onchange="checkpassword()">
        </label>
        <label for="email">电子邮箱
            <input type="text" name="email" id="email">
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

 /*   function checkpassword()
    {
        if($("#password").val() <> $("#password2").val())
        {
            alert ("两次输入的密码不一致");
            $("#newadminsubmit").addclass("disable");

        }
        else
        {
            $("#newadminsubmit").removeclass("disable");
        }
    }*/
</script>