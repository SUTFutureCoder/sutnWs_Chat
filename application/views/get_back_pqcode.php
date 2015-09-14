<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>网管面试二维码找回页</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<br/>
<form class="form-horizontal col-sm-offset-1 col-sm-10" >
<div class="basic_info">
 <div class="form-group">
            <label for="user_telephone" class="control-label">联系方式</label>
            <input type="text" class="form-control" aria-describedby="user_telephone" id="user_telephone">
</div>
<div class="form-group">
            <label for="user_qq" class="control-label">QQ号</label>
            <input type="text" class="form-control" aria-describedby="user_qq" id="user_qq">
</div>   
    <div class="form-group">
                <div class="col-sm-12">
                    <button class="form-control btn btn-primary" type="button" id="interviewerScore"  >确定</button>
                </div>
    </div>
</form>
<?php require('success_info.php');?>
    <button type="button" class="btn btn-primary " data-toggle="modal"  data-backdrop="" data-target="#success_info" id = "success_info_but" aria-hidden="ture" style='display:none'></button>
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
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  $('#interviewerScore').click(function() {

    $.post('<?= site_url('Interviewer/get_back_pqcode')?>',{
        user_telephone : $('#user_telephone').val(),
        user_qq : $('#user_qq').val()
    },function(data) {
        var data = JSON.parse(data);
        if(data['code'] != 1) {
          alert(data['message']);
        } else {
          $('#span_success_id').text(data['user_id']);
          $('#pqcode').attr('src',data['url']);
          $('#success_info_but').click();
        }
      }); 
    });   

});
</script>
</body>
</html>
