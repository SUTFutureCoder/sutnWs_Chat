<?php if ($this->session->userdata('acceptAccess') && 0 < $this->session->userdata('acceptAccess') && 7 > $this->session->userdata('acceptAccess')): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>录取列表</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="alert alert-info" role="alert">目前录取 <a id="person_sum"><?= $userAcceptSum ?></a> 人</div>
    <div>
        
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>姓名</th>
                <th>学号</th>
                <th>电话号码</th>
                <th>专业</th>
                <th>特长</th>
                <th>性别</th>
                <th>打分</th>
                <th>录取状态</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($freshUserList as $freshUserValue): ?>
            <tr class="user_info" id="<?= $freshUserValue['user_id'] ?>">
                <th scope="row"><?= $i++ . ' - id:' . $freshUserValue['user_id'] ?></th>
                <td><?= $freshUserValue['user_name'] ?></td>
                <td><?= $freshUserValue['user_number'] ?></td>
                <td><?= $freshUserValue['user_telephone'] ?></td>
                <td><?= $freshUserValue['user_major'] ?></td>
                <td class="col-sm-4"><?= $freshUserValue['user_talent'] ?></td>
                <?php if (0 == $freshUserValue['user_sex']): ?>
                    <td>男</td>
                <?php elseif (1 == $freshUserValue['user_sex']): ?>
                    <td>女</td>
                <?php elseif (2 == $freshUserValue['user_sex']): ?>
                    <td>其他</td>
                <?php elseif (3 == $freshUserValue['user_sex']): ?>
                    <td>保密</td>
                <?php endif; ?>
                <td style="color: red"><?= $freshUserValue['score'] ?></td>
                <?php if ($freshUserValue['valid'] ): ?>
                    <td><button user_id="<?= $freshUserValue['user_id'] ?>" act="0" type="button" class="btn btn-danger accept_button">取消录取</button></td>
                <?php else: ?>
                    <td><button user_id="<?= $freshUserValue['user_id'] ?>" act="1" type="button" class="btn btn-success accept_button">录取</button></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
 <script type="text/javascript" src="<?= base_url('js/jquery.form.js')?>"></script>
<script type="text/javascript" >
(function(){
    var dom = {
        userInfo : $(".user_info"),
        personSum : $("#person_sum")
    }
    
    var accept = {
        init : function (){
            this.eventFn();
        },
        
        eventFn : function(){
            dom.userInfo.on('click', '.accept_button', function(){
                var url = "<?= base_url('index.php/accept/acceptToggle') ?>";
                var targetDom = $(this);
                var user_id = targetDom.attr('user_id');
                var section_id = <?= $this->session->userdata('acceptAccess') ?>;
                var toggle = targetDom.attr('act');
                $.post(url,{
			user_id : user_id,
                        section_id : section_id,
                        toggle : toggle
		},function(data) {
                        var data = JSON.parse(data);
			if(data['code'] != 1) {
				alert(data['status']);
			} else {
                                targetDom.attr('act', data['toggle']);
                                if (data['toggle']){
                                    dom.personSum.html(dom.personSum.html() * 1 - 1);                                    
                                    targetDom.html('录取').removeClass('btn-danger').addClass('btn-success');
                                } else {
                                    dom.personSum.html(dom.personSum.html() * 1 + 1);
                                    targetDom.html('取消录取').removeClass('btn-success').addClass('btn-danger');;
                                }
			}
		});
            });
        }
    }
    accept.init();
})();
</script>	
</body>
</html>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>录取登录</title>
</head>
<body>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" >
	/*function GetRequest() { 
		var url = location.search; //获取url中"?"符后的字串 
		var theRequest = new Object(); 
		if (url.indexOf("?") != -1) { 
			var str = url.substr(1); 
			strs = str.split("&"); 
			for(var i = 0; i < strs.length; i ++) { 
				theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]); 
			} 
		} 
		return theRequest; 
	} 
	var Request = new Object(); */
	//Request = GetRequest(); 
	var str = location.search;
	var strs = str.split("?");
	var pwd = prompt('输入密码');
	var url = '<?= site_url();?>' + '/accept/checkPwd';
	if(!pwd) {
		window.location.href = '<?= site_url();?>';
	}else if(pwd.length > 0 && pwd.length < 20) {
		$.post(url,{
			acceptAccess : pwd
		},function(data) {
			//alert(data);
			if(data == false) {
				//alert(1);
				alert("密码不正确！");
				window.location.reload();
			} else {
				window.location.href = '<?= site_url();?>' + '/accept/acceptFresh';
			}
		});
	} else {
		alert("密码不正确！");
		window.location.reload();
	}
</script>	
</body>
</html>
<?php endif; ?>
