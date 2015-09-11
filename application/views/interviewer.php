<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>网管面试页</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<br/>
<div class="container col-sm-offset-1 col-sm-10" >
<div class="basic_info">
<div class="form-group">
    <label for="user_name" class="control-label">姓名</label>
    <pre><div><?= $userInfo['user_name'];?></div></pre>
</div>
<div class="form-group">
    <label for="user_telephone" class="control-label">联系方式</label>
    <pre><div><?= $userInfo['user_telephone'];?></div></pre>
</div>
<div class="form-group">
    <label for="user_qq" class="control-label">QQ号</label>
    <pre><div><?= $userInfo['user_qq'];?></div></pre>
</div>
<div class="form-group">
    <label for="user_number" class="control-label">学号</label>
    <pre><div><?= $userInfo['user_number'];?></div></pre>
</div>
<div class="form-group">
    <label for="user_major" class="control-label">专业</label>
    <pre><div><?= $userInfo['user_major'];?></div></pre>
</div>
<div class="form-group">
    <label for="user_sex" class="control-label">性别</label>
    <pre><div><?= $userInfo['user_sex'];?></div></pre>
</div>  
<div class="form-group">
    <label for="first_section" class="control-label">第一志愿</label>
    <pre><div><?= $userInfo['first_section'];?></div></pre>
</div>  
<div class="form-group">
    <label for="second_section" class="control-label">第二志愿</label>
    <pre><div><?= $userInfo['second_section'];?></div></pre>
</div>  
<div class="form-group">
    <label for="third_section" class="control-label">第三志愿</label>
    <pre><div><?= $userInfo['third_section'];?></div></pre>
</div>  
<div class="form-group">
    <label for="user_talent" class="control-label">特长</label>
    <pre><div><?= $userInfo['user_talent'];?></div></pre>
</div>

</div>
<form >
    <div class="form-group">
        <label for="file_img" class="control-label"><?= $section;?>面试官打分</label>
        <input type="text"  class="form-control" aria-describedby="user_score" id="user_score" name="user_score">
        <input type="hidden" class="form-control" name="section_id" id = "section_id" value="<?= $section_id;?>" >
        <input type="hidden" class="form-control" name="user_id" id = "user_id" value="<?= $userInfo['user_id'];?>">
    </div>
    <div class="form-group">
                <div class="col-sm-12">
                    <button class="form-control btn btn-primary" type="button" id="interviewerScore"  >确定</button>
                </div>
            </div>
</form>
<br/>
<br/>
<br/>
<br/>
</div>
<footer class="footer">
  <div class="container">
    <div class="row footer-top">
      <div class="col-sm-6 col-lg-6">
        <h4>
            <img src="<?= base_url('images/nws_small.jpg')?>">
        </h4>
      </div>
      <div class="col-sm-6  col-lg-5 col-lg-offset-1">
        <div class="row about">
          <div class="col-xs-3">
            <h4>关于</h4>
            <ul class="list-unstyled">
              <li><a href="http://youth.sut.edu.cn/news.asp?id=884&classid=6">关于我们</a></li>
              <li><a href="http://youth.sut.edu.cn/news.asp?id=1494&classid=6">友情链接</a></li>
            </ul>
          </div>
          <div class="col-xs-3">
            <h4>联系方式</h4>
            <ul class="list-unstyled">
              <li><a href="mailto:FutureCoder@aliyun.com">QQ:506200331</a></li>
            </ul>
          </div>
          <div class="col-xs-3">
            <h4>旗下网站</h4>
            <ul class="list-unstyled">
              <li><a href="http://zx.sutapp.com/" target="_blank">招新主页</a></li>
              <li><a href="http://festival.sutapp.com/" target="_blank">网络文化节</a></li>
              <li><a href="http://youth.sut.edu.cn/" target="_blank">青春风景网</a></li>
              <li><a href="http://football.sutapp.com/" target="_blank">工大足球</a></li>
            </ul>
          </div>
          <div class="col-xs-3">
            <h4>官方微信</h4>
            <img src="<?= base_url('images/wg_small.png')?>">
          </div>
        </div>

      </div>
    </div>
    <hr>
    <div class="row footer-bottom">
      <ul class="list-inline text-center">
          <li><a>©沈阳工业大学校团委网络管理中心 2015</a></li>
      </ul>
    </div>
  </div>
</footer>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('#interviewerScore').click(function() {

    $.post('<?= site_url('Interviewer/userScore')?>',{
        user_id : $('#user_id').val(),
        section_id : $('#section_id').val(),
        user_score : $('#user_score').val()
    },function(data) {
        //alert(data);
        var data = JSON.parse(data);
        if(data['code'] == -1) {
          alert(data['message']);
        } else {
          alert(data['message']);
          /*window.opener=null;
          window.open('', '_self'); 
          window.close();*/
        }
      }); 
    });   

});
</script>
</body>
</html>
