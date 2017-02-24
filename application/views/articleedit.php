<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>文章编辑</title>
	<link rel="stylesheet" href="<?php echo base_url("/css/themes/default/default.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("/css/plugins/code/prettify.css"); ?>" />
	<script charset="utf-8" src="<?php echo base_url("/js/kindeditor.js"); ?>"></script>
	<script charset="utf-8" src="<?php echo base_url("/js/lang/zh_CN.js"); ?>"></script>
	<script charset="utf-8" src="<?php echo base_url("/js/plugins/code/prettify.js"); ?>"></script>
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/foundation/5.5.3/css/foundation.min.css">
  	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/foundation.min.js"></script>
  	<script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/vendor/modernizr.js"></script>
  	<!-- 自制的css样式表 -->
  	<link rel="stylesheet" href="<?php echo base_url("\css\article.css"); ?>">
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : '<?php echo base_url("/js/plugins/code/prettify.css");?>',
				uploadJson : '<?php echo base_url("/js/upload_json.php"); ?>',
				fileManagerJson : '<?php echo base_url("/js/file_manager_json.php"); ?>',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
</head>
<body>
    <!--文章编辑页面-->
	<form name="articleedit" method="post" action="<?php echo site_url('article/articlePost')?>">
        <div class="row collapse">

            <?php

                if ($data->content == "")

                {

                    echo "<h1>新建文章</h1>";

                }

                else

                {

                    echo "<h1>编辑文章</h1>";

                }

            ?>
            <hr>
	        <div class="small-12">文章分类</div>
            <div class="small-1 columns">
                <span class="prefix">一级目录</span>
                <!--label for="parrentcategory" class="inline">一级目录</label-->
            </div>
            <div class="small-3 columns">
                <select name="parrentcategory" onchange="changechildren(this.value)">
                    <?php foreach($parrentcategory as $row):?>
                        <option value="<?=$row->classid?>" <?php if($row->classid==$parrentid) {echo "selected";} ?>><?=$row->classname?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="small-1 columns">
                <span class="prefix">二级目录</span>
                <!--label for="childrencategory" class="inline">二级目录</label-->
            </div>
            <div class="small-3 columns">
                <select id="childrencategory" name="childrencategory">
                    <?php foreach($childrencategory as $row):?>
                        <option value="<?=$row->classid?>" <?php if($row->classid==$data->classid) {echo "selected";} ?>><?=$row->classname?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="small-12 columns left">
                标题
                <input name="articletitle" type="text" value="<?php echo $data->title; ?>">
            </div>
            <div class="small-12 columns left">
                作者
                <input name="author" type="text" value="<?php echo $data->author; ?>">
            </div>
            <div class="small-12 columns left hide">
                <input name="articleid" type="text" value="<?php echo $data->articleid; ?>">
            </div>
            <div class="small-12 columns left">
                正文
		        <textarea name="content1" style="height:450px;visibility:hidden;"><?php echo htmlspecialchars($data->content); ?></textarea>
		        <br/>
		        <input class="button" type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
	        </div>
	    </div>
    </form>
</body>

<script>

    $(document).ready(function() 
    {
        $(document).foundation();
    })

    function changechildren(parrentcategory) 
    {
        $.post("/article/showChildCategory", { id : parrentcategory } ,
            function(data,status)
            {
                $("#childrencategory").html(data);
            })
    }
</script>
</body>
</html>
