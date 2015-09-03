<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>欢迎“家”入网管！</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br/>        
    <form class="form-horizontal col-sm-10">
        <!--<hr class="col-sm-offset-2">-->
        <div class="form-group">
            <label for="user_name" class="col-sm-2 control-label">姓名</label>
            <input type="text" class="form-control" aria-describedby="user_name" id="user_name">
        </div>
        <div class="form-group">
            <label for="user_telephone" class="col-sm-2 control-label">联系方式</label>
            <input type="text" class="form-control" aria-describedby="user_telephone" id="user_telephone">
        </div>
        <div class="form-group">
            <label for="user_qq" class="col-sm-2 control-label">QQ号</label>
            <input type="text" class="form-control" aria-describedby="user_qq" id="user_qq">
        </div>
        <div class="form-group">
            <label for="user_number" class="col-sm-2 control-label">学号</label>
            <input type="text" class="form-control" aria-describedby="user_number"  placeholder="见学生卡" id="user_number">
        </div>
        <div class="form-group">
            <label for="user_major" class="col-sm-2 control-label">专业</label>
            <input type="text" class="form-control" aria-describedby="user_major" id="user_major">
        </div>
        <div class="form-group">
            <label for="user_sex" class="col-sm-2 control-label">性别</label>
            <div class="col-sm-10">
                <select class="form-control" id="user_sex" >
                    <option value="0">男</option>
                    <option value="1">女</option>
                    <option value="2">其他</option>
                    <option value="3">保密</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="user_sex" class="col-sm-2 control-label">性别</label>
            <div class="col-sm-10">
                <select class="form-control" id="user_sex" >
                    <option value="0">男</option>
                    <option value="1">女</option>
                    <option value="2">其他</option>
                    <option value="3">保密</option>
                </select>
            </div>
        </div>
        
        
        
        
        
        
        
        <div class="form-group">
            <div class="alert alert-info col-sm-10 col-sm-offset-2" id="rule_comment" role="alert"></div>
        </div>        
        <div class="form-group">
            <label for="score_judge" class="col-sm-2 control-label">加/减分</label>
            <div class="input-group col-sm-10">
                <span class="input-group-addon" id="score_mod"></span>
                <input type="text" class="form-control" onblur="checkScoreJudge(this.value)" aria-describedby="score_range" id="score_judge">
                <span class="input-group-addon" id="score_range"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="event_time" class="col-sm-2 control-label">发生时间</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="例：2015-05-11" id="event_time">
            </div>
        </div>
        <div class="form-group">
            <label for="event_tag" class="col-sm-2 control-label">标签</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="例：ACM程序设计大赛 请填写关键字以用于同项高计" id="event_tag">
            </div>
        </div>
        <div class="form-group">
            <label for="event_intro" class="col-sm-2 control-label">说明</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" id="event_intro"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="event_certify" class="col-sm-2 control-label">证明人/单位</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="event_certify">
            </div>
        </div>
    </form>
    <form action="<?= base_url('index.php/index/ajaxFileUpload')?>" class="form-horizontal col-sm-10" id="form1" name="form1" encType="multipart/form-data"  method="post" target="file_frame">
        <div class="form-group">
            <label for="event_certify_file" class="col-sm-2 control-label">作品材料</label>
            <div class="col-sm-9">
                <input type="hidden" hidden="hidden" class="form-control" name="certify_class_user_id" id="certify_class_user_id">
                <input type="hidden" hidden="hidden" class="form-control" name="certify_rule_id" id="certify_rule_id">
                <input type="hidden" hidden="hidden" class="form-control" name="certify_file_info" id="certify_file_info">
                <input type="file" class="form-control" id="event_certify_file" name="file">
            </div>
            <button class="btn btn-info" id="upload_submit" type="submit">上传</button>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-11 col-sm-offset-1">
                <button type="button" class="btn btn-info btn-block" onclick="submitScore()" id="score_log_submit">添加记录</button>
            </div>
        </div>
    </form>
    <iframe name='file_frame' id="file_frame" style='display:none'></iframe>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url('js/json.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('js/jquery.form.js')?>"></script>
    <script>
        
    </script>
</body>
</html>