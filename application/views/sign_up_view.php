<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>欢迎“家”入网管！</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br/>        
    <form class="form-horizontal col-sm-offset-1 col-sm-10" >
        <!--<hr class="col-sm-offset-2">-->
        <div class="basic_info">
        <div class="form-group">
            <label for="user_name" class="control-label">姓名</label>
            <input type="text" class="form-control" aria-describedby="user_name" id="user_name" >
        </div>
        <div class="form-group">
            <label for="user_telephone" class="control-label">联系方式</label>
            <input type="text" class="form-control" aria-describedby="user_telephone" id="user_telephone">
        </div>
        <div class="form-group">
            <label for="user_qq" class="control-label">QQ号</label>
            <input type="text" class="form-control" aria-describedby="user_qq" id="user_qq">
        </div>
        <div class="form-group">
            <label for="user_number" class="control-label">学号</label>
            <input type="text" class="form-control" aria-describedby="user_number"  placeholder="见学生卡" id="user_number">
        </div>
        <div class="form-group">
            <label for="user_major" class="control-label">专业</label>
            <input type="text" class="form-control" aria-describedby="user_major" id="user_major">
        </div>
        
    
        <div class="form-group">
            <label for="user_sex" class="control-label">性别</label>
            <select class="form-control"  id="user_sex" >
                <option value="0">男</option>
                <option value="1">女</option>
                <option value="2">其他</option>
                <option value="3">保密</option>
            </select>
        </div>        
        </div>
        
        
        <div class="alert alert-success" role="alert">网管的全部培训课程面向全校同学开放，部门仅作职能分配而存在。网管是一家人！</div>
        <div id="section_will">
        <div class="form-group">
            <label for="first_section" class="control-label">第一志愿</label>
            <select class="form-control section_will_select" id="first_section">
                <option value="0">请选择</option>
                <?php foreach ($sectionList as $sectionValue): ?>
                    <option value="<?= $sectionValue['section_id'] ?>"><?= $sectionValue['section_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="alert alert-info section_comment" role="alert"></div>
        </div>
        
        <div class="form-group">
            <label for="second_section" class="control-label">第二志愿【可选】</label>
            <select class="form-control section_will_select" id="second_section" >
                <option value="0">请选择</option>
                <?php foreach ($sectionList as $sectionValue): ?>
                    <option value="<?= $sectionValue['section_id'] ?>"><?= $sectionValue['section_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="alert alert-info section_comment" role="alert"></div>
        </div>
        
        <div class="form-group">
            <label for="third_section" class="control-label">第三志愿【可选】</label>
            <select class="form-control section_will_select" id="third_section" >
                <option value="0">请选择</option>
                <?php foreach ($sectionList as $sectionValue): ?>
                    <option value="<?= $sectionValue['section_id'] ?>"><?= $sectionValue['section_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="alert alert-info section_comment" role="alert"></div>
        </div>
        </div>
        
        
        <div class="form-group">
            <label for="user_talent" class="control-label">特长</label>
            <textarea class="form-control" rows="5" id="user_talent"></textarea>
        </div>
    </form>
    <form action="<?= base_url('index.php/sign_up/ajaxFileUpload')?>" id="file_upload" class="form-horizontal col-sm-10 col-sm-offset-1" id="form1" name="form1" encType="multipart/form-data"  method="post" target="file_frame" onclick="return get_number()">
        <div class="form-group">
            <label for="file" class="col-sm-2 control-label">作品材料【选填】</label>
            <div class="col-sm-9">
                <input type="hidden" hidden="hidden" class="form-control" name="file_user_number" id="file_user_number">
                <input type="file" class="form-control" id="event_certify_file" name="file">
            </div>
            <button class="btn btn-info" id="upload_submit" type="submit">上传</button>
        </div>
        <div class="form-group" id="validate">
            <label for="validatecode" class="control-label">验证码</label>
            <input type="text" class="form-control col-sm-4" aria-describedby="validatecode" id="validatecode">
            <img id="validatecode_img" src="<?= base_url('index.php/index/getagnomen')?>" width="100">
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info btn-block" id="signUp_submit">"家"入网管</button>
            </div>
        </div>
    </form>
    <iframe name='file_frame' id="file_frame" style='display:none'></iframe>
    <?php require('success_info.php');?>
    <button type="button" class="btn btn-primary " data-toggle="modal"  data-backdrop="" data-target="#success_info" id = "success_info_but" aria-hidden="ture" style='display:none'></button>
    <br/>
    <br/>
    <hr class="col-sm-10 col-sm-offset-1">
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
    <input type="hidden" id = "hide_site_url" name = "hide_site_url" value="<?= site_url();?>"/>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url('js/json.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('js/jquery.form.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('js/sign_up.js')?>"></script>
    <script>
    function get_number(){
        if($('#user_number').val() == undefined){
            return false;
        }
        else{
            $('#file_user_number').val($('#user_number').val());
            return true;
        }
    }
    (function(){
        var dom = {
            basicInfo : $('#basic_info'),
            sectionWill : $('#section_will'),
            fileUpload : $('#file_upload'),
            validate : $('#validate')
        };
        
        var section = [];
        section[0] = '';
        <?php foreach ($sectionList as $sectionValue): ?>
            section[<?= $sectionValue['section_id'] ?>] = '<?= trim($sectionValue['section_describe']) ?>';
        <?php endforeach; ?>

        var signUp = {
            init: function(){
                this.eventFn();
            },

            //事件参数
            eventFn: function(){
                dom.sectionWill.on('change', '.section_will_select', function(){
                    var comment = $(this).parent().find('.section_comment');
                    comment.html(section[$(this).val()]);
                });
                
                dom.validate.on('click', '#validatecode_img', function(){
                    var img = $(this);
                    img.attr('src', '<?= base_url('index.php/index/getagnomen')?>');
                });

            }
        };
        signUp.init();
    })();
    </script>
</body>
</html>