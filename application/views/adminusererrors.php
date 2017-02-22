<!--adminuser视图中新建管理员填写表验证失败时，调用此视图显示错误信息-->
<div class="large-10 columns" data-equalizer-watch>
    <h1 class="headline">用户管理
        <button type="button" class="button right" data-reveal-id="newadmin">新建管理员</button>
    </h1>
    <hr>
    <div id="errors">
        <!--回显新建管理员form的错误信息-->
        <?php echo $errors; ?>
    </div>
</div>