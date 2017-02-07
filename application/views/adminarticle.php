
<body>

<div data-equalizer>
  <div class="large-2 columns" data-equalizer-watch style="background-color:#f1f1f1;">
    <ul class="side-nav">
      <li class="active"><a href="#">发文管理</a></li>
      <li><a href="#">首页轮播管理</a></li>
      <li><a href="#">文章分类管理</a></li>
      <li><a href="#">用户管理</a></li>
    </ul>
  </div>
  <div class="large-10 columns" data-equalizer-watch>
    <h1>发文管理</h1>
    <?php

      echo $this->session->adminname;

    ?>
  </div>
</div>

<script>
$(document).ready(function() {
    $(document).foundation();
})
</script>


