
<body>

    <div >

        <div class="row" data-equalizer>

            <div class="large-2 columns" data-equalizer-watch style="background-color:#f1f1f1;">

                <ul class="side-nav">

                    <li class="active"><a href="#">文章管理</a></li>
                    
                    <li><a href="#">首页轮播管理</a></li>
                    
                    <li><a href="#">文章分类管理</a></li>
                    
                    <li><a href="#">用户管理</a></li>
                    
                    <li><a href="#">访客分析</a></li>
                
                </ul>
            
            </div>
            
            <div class="large-10 columns" data-equalizer-watch>
                
                <h1 class="headline">文章管理</h1>

                <div class="row" data-equalizer>

                    <div class="row collapse">

                        <div class="small-2 columns">

                            <!--span class="prefix">一级目录</span-->
                            <label for="parrentcategory" class="inline right">一级目录：</label>

                        </div>

                        <div class="small-3 columns">

                            <select name="parrentcategory" onchange="changechildren(this.value)">

                                <?php foreach($parrentcategory as $row):?>

                                      <option value="<?=$row->classid?>"><?=$row->classname?></option>

                                <? endforeach; ?>

                            </select>

                        </div>

                        <div class="small-2 columns">

                            <!--span class="prefix">二级目录</span-->
                            <label for="childrencategory" class="inline right">二级目录：</label>

                        </div>

                        <div class="small-3 columns">

                            <select id="childrencategory" name="childrencategory" onchange="changearticleintable(this.value)">
                                
                                <?php foreach($childrencategory as $row):?>

                                      <option value="<?=$row->classid?>"><?=$row->classname?></option>

                                <? endforeach; ?>

                            </select>

                        </div>

                        <div class="small-2 columns">

                            <button class="tiny right" id="newarticle" name="newarticle" onclick="newarticle()">新文章</button>
                            <!--新建文章-->

                        </div>

                    </div>
          
                </div>

                <div>

                <ul id = "buttontopage" class="button-group even-2">

                        <li><button class="tiny" id="pageup" name="pageup" onclick="pageup()">上一页</button></li>

                        <li><button class="tiny" id="pagedown" name="pagedown" onclick="pagedown()">下一页</button></li>

                    </ul>

                    <table class="responsive" id="articleintable">

                        <tr>

                            <th>序号</th>

                            <th>标题</th>

                            <th>编辑</th>

                            <th>通过</th>

                            <th>删除</th>

                        </tr>                         

                        <?php

                            foreach ($articlelist as $row)

                            {

                                echo "<tr>";

                                echo "<td>$row->articleid</td>";

                                echo "<td width=\"590\"><a href=".site_url('article/id/').$row->articleid." target=\"_BLANK\">$row->title</td>";

                                echo "<td><a href=".site_url('article/articleedit/').$row->articleid." target=\"_BLANK\">编辑</td>";

                                echo "<td>通过</td>";

                                echo "<td>删除</td>";

                                echo "</tr>";

                            }

                        ?>

                    </table>

                    
              
                </div>

            </div>

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

            }

          )

        }

        function changearticleintable(childrencategory) 

        {

            $.post("/article/showArticleinTable", { id : childrencategory } ,

                function(data,status)

            {

            $("#articleintable").html(data);

            }

          )

        }

        function pageup()

        {
            $.post("/article/pageup",1,

                function(data, status)

            {

            $("#articleintable").html(data);

            }

            )

        }

        function pagedown()

        {
            $.post("/article/pagedown",1,

                function(data, status)

            {

            $("#articleintable").html(data);

            }

            )

        }

        function newarticle()

        {

            window.open("/article/articleedit");

        }

    </script>

</body>


