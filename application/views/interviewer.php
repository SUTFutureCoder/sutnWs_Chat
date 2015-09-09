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
    <input type="text" class="form-control" aria-describedby="user_name" id="user_name" value="<?= $userInfo['user_name'];?>" disabled>
</div>
<div class="form-group">
    <label for="user_telephone" class="control-label">联系方式</label>
    <input type="text" class="form-control" aria-describedby="user_telephone" id="user_telephone" value="<?= $userInfo['user_telephone'];?>" disabled>
</div>
<div class="form-group">
    <label for="user_qq" class="control-label">QQ号</label>
    <input type="text" class="form-control" aria-describedby="user_qq" id="user_qq" value="<?= $userInfo['user_qq'];?>" disabled>
</div>
<div class="form-group">
    <label for="user_number" class="control-label">学号</label>
    <input type="text" class="form-control" aria-describedby="user_number"  placeholder="见学生卡" id="user_number" value="<?= $userInfo['user_number'];?>" disabled>
</div>
<div class="form-group">
    <label for="user_major" class="control-label">专业</label>
    <input type="text" class="form-control" aria-describedby="user_major" id="user_major" value="<?= $userInfo['user_major'];?>" disabled>
</div>
<div class="form-group">
    <label for="user_sex" class="control-label">性别</label>
    <input type="text" class="form-control" aria-describedby="user_sex" id="user_sex" value="<?= $userInfo['user_sex'];?>" disabled>
</div>  
<div class="form-group">
    <label for="first_section" class="control-label">第一志愿</label>
    <input type="text" class="form-control" aria-describedby="first_section" id="first_section" value="<?= $userInfo['first_section'];?>" disabled>
</div>  
<div class="form-group">
    <label for="first_section" class="control-label">第二志愿</label>
    <input type="text" class="form-control" aria-describedby="second_section" id="second_section" value="<?= $userInfo['second_section'];?>" disabled>
</div>  
<div class="form-group">
    <label for="first_section" class="control-label">第三志愿</label>
    <input type="text" class="form-control" aria-describedby="third_section" id="third_section" value="<?= $userInfo['third_section'];?>" disabled>
</div>  
<div class="form-group">
    <label for="user_talent" class="control-label">特长</label>
    <textarea class="form-control" rows="5" id="user_talent" disabled><?= $userInfo['user_talent'];?></textarea>
</div>
<div class="form-group">
    <label for="file_img" class="control-label">作品材料</label>
    <img src="<?= $userInfo['img_address'];?>" alt="" id = "file_img">
</div>
</div>
<form  action="<?= site_url('Interviewer/userScore');?>" method="post">
    <div class="form-group">
        <label for="file_img" class="control-label"><?= $section;?>面试官打分</label>
        <input type="text"  class="form-control" aria-describedby="user_score" id="user_score" name="user_score">
        <input type="hidden" class="form-control" name="section_id" id = "interviewerSection" value="<?= $section_id;?>" >
        <input type="hidden" class="form-control" name="user_id" id = "user_id" value="<?= $userInfo['user_id'];?>">
    </div>
    <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-info btn-block" id="signUp_submit">确定</button>
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
</body>
</html>
