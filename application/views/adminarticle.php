            <div class="large-10 columns" data-equalizer-watch>
                
                <h1 class="headline">文章管理</h1>

                <hr>

                <div class="row" data-equalizer>

                    <div class="row collapse">

                        <div class="small-2 columns">

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

                        <?php echo $articlelist; ?>

                    </table>

                    
              
                </div>

            </div>

        </div>

    </div>

    <script>
      
        $(document).ready(function() 

        {

            $(document).foundation();
            //fundation初始化

        })

        function changechildren(parrentcategory) 

        { //parrentcategory的onchange函数，使用ajax post方式取回childrencategory的数据并显示


            $.post("/article/showChildCategory", { id : parrentcategory } ,

                function(data,status)

            {

            $("#childrencategory").html(data);
            //显示在childrencategory中的取回数据

            changearticleintable($("#childrencategory").val());
            //同时改变table中的数据，传递的值是childrencategory第一项的值

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

        function passed(articleid)

        {

            $.post("/article/articlepassed", { id : articleid } ,

                function(data,status)

            {



            }

          )

        }

        function deleted(articleid)

        {

            $.post("/article/articledeleted", { id : articleid } ,

                function(data,status)

            {



            }

          )
            
        }


    </script>

</body>


