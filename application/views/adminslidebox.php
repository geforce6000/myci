<div class="large-10 columns" data-equalizer-watch>
                
    <h1 class="headline">首页轮播管理

    <button type="button" class="button right" data-reveal-id="myModal">最近10篇文章</button></h1>

    <hr>



    <div id="slideboxtable">

        <?php echo $slidebox; ?>

    </div>


</div>

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

<script>
    $(document).ready(function()

    {

        $(document).foundation();
        //fundation初始化

    })

    function aid(articleid)
    {

        alert(articleid);

        /*$.post("/admin/slideboxchangeaid", { id : articleid } ,

            function(data, status)

            {

                $("#slideboxtable").html(data);

            }

        )*/
    }

    function articleidback(telt)
    {
        alert(telt);
    }
    function changeimage(id)
    {

        alert("you click "+id);
    }
</script>