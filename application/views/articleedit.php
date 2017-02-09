<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>KindEditor PHP</title>
	<link rel="stylesheet" href="/css/themes/default/default.css" />
	<link rel="stylesheet" href="/css/plugins/code/prettify.css" />
	<script charset="utf-8" src="/js/kindeditor.js"></script>
	<script charset="utf-8" src="/js/lang/zh_CN.js"></script>
	<script charset="utf-8" src="/js/plugins/code/prettify.js"></script>
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/foundation/5.5.3/css/foundation.min.css">
  	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/foundation.min.js"></script>
  	<script src="http://cdn.static.runoob.com/libs/foundation/5.5.3/js/vendor/modernizr.js"></script>
  	<!-- 自制的css样式表 -->
  	<link rel="stylesheet" href="\css\article.css">
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : '/js/plugins/code/prettify.css',
				uploadJson : '/js/upload_json.php',
				fileManagerJson : '/js/file_manager_json.php',
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
	<form name="example" method="post" action="article/articlepost/">
        <div class="row collapse">
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
                <input type="text" value="<?php echo $data->title; ?>">
            </div>
            <div class="small-12 columns left">
                正文
		        <textarea name="content1" style="height:700px;visibility:hidden;"><?php echo htmlspecialchars($data->content); ?></textarea>
		        <br/>
		        <input type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
	        </div>
	    </form>
    </div>
</div>

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