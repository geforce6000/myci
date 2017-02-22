<!--首页轮播图管理视图-->

<div class="large-10 columns" data-equalizer-watch>
    <h1 class="headline">首页轮播管理
    <button type="button" class="button right" data-reveal-id="myModal">最近10篇文章</button></h1>
    <hr>
    <div id="slideboxtable">
        <!--显示轮播图编辑列表-->
        <?php echo $slidebox; ?>
    </div>
</div>
<!--模态框，显示最近10篇文章编号及标题供复制-->
<div id="myModal" class="reveal-modal tiny" data-reveal>
    <h2>最新10篇文章</h2>
    <hr>
    <table>
        <th>序号</th>
        <th>标题</th>
        <?php foreach($lastten as $row):?>
            <tr>
                <td><?=$row->articleid?></td>
                <td width="450px"><?=$row->title?></td>
            </tr>
        <?php endforeach;?>
    </table>
    <a class="close-reveal-modal">&times;</a>
</div>
<!--这个模态框可以选择图片并提交，同时会确认关联文章ID和TITLE-->
<div id="postwithimg" class="reveal-modal tiny" data-reveal>
    <h2>提交说明文字和图片</h2>
    <hr>
    <form action="<?php echo site_url('admin/postwithimg')?>" method="post" enctype ="multipart/form-data">
        <label for="id">轮播序号
            <input type="text" name="id" id="id" value="">
        </label>
        <label for="articleid">文章序号
        <input type="text" name="articleid" id="articldid" value="">
        </label>
        <label for="articletitle">文章标题
        <input type="text" name="articletitle" id="articletitle" value="">
        </label>
        <label for="imagefile">文章配图
        <input type="file" name="imagefile">
        </label>
        <input class="button" type="submit" value="提交">
    </form>
    <a class="close-reveal-modal">&times;</a>
</div>
<script>
    $(document).ready(function()
    {
        $(document).foundation();
        //fundation初始化
    })
    function aid(articleid,id)
    {  //当articleid栏的数据改动时，依据articleid去article表查询该ID所对应的title，并填到title框中
       //如未查到，表示该id无对应文章
        $.post("/admin/slideboxchangeaid", { id : articleid } ,
            function(data, status)
            {
                var title ="#"+id+"title";
                $(title).val(data);
            }
        )
    }
    function mouseonbutton(id)
    {   //鼠标移动到“提交图片”button上时，把该button所在行的id,articleid,title复制到模态框中， 用以post到
        //admin/postwithimg方法
        var articleid = "#"+id[0];
        var articletitle = "#"+id[0]+"title";
        $("#id").val(id[0]);
        $("#articldid").val($(articleid).val());
        $("#articletitle").val($(articletitle).val());
    }
</script>