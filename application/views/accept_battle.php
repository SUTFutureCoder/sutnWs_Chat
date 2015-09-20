<?php if ($this->session->userdata('acceptBattle')): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>抢人列表</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="alert alert-info person_sum" role="alert">
        总数：<a id="person_sum_all"><?= array_sum($sectionSum) ?></a>
        宣传：<a id="person_sum_xuanchuan"><?= $sectionSum[0] ?></a>
        外联：<a id="person_sum_wailian"><?= $sectionSum[1] ?></a>
        采编：<a id="person_sum_caibian"><?= $sectionSum[2] ?></a>
        策划：<a id="person_sum_cehua"><?= $sectionSum[3] ?></a>
        影音：<a id="person_sum_yingyin"><?= $sectionSum[4] ?></a>
        技术：<a id="person_sum_jishu"><?= $sectionSum[5] ?></a>
    </div>
    <div>
        
    </div>
    <?php foreach ($userInfo as $userInfoValue): ?>
    <div class="panel panel-primary battle-panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $userInfoValue['user_id'] ?></h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>姓名</td> 
                        <td><?= $userInfoValue['user_name'] ?></td> 
                    </tr>
                    <tr>
                        <td>联系方式</td> 
                        <td><?= $userInfoValue['user_telephone'] ?></td> 
                    </tr>
                    <tr>
                        <td>专业</td> 
                        <td><?= $userInfoValue['user_major'] ?></td> 
                    </tr>
                    <tr>
                        <td>性别</td> 
                        <?php if (0 == $userInfoValue['user_sex']): ?>
                        <td>男</td> 
                        <?php elseif (1 == $userInfoValue['user_sex']): ?>
                        <td>女</td> 
                        <?php else :?>
                        <td>其他</td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>特长</td> 
                        <td><?= $userInfoValue['user_talent'] ?></td> 
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-hover table-striped">
                <thead>
                    <th>部门</th>
                    <th>打分</th>
                    <th>录取</th>
                </thead>
                <tbody>
                    <?php foreach ($userList[$userInfoValue['user_id']]['section'] as $userListValue): ?>
                    <tr>
                        <td><?= $sectionList[$userListValue['section_id']] ?></td> 
                        <td><?= $userListValue['score'] ?></td> 
                        <td><button type="button" class="btn btn-success"><?= $sectionList[$userListValue['section_id']] ?>录取</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
    
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
 <script type="text/javascript" src="<?= base_url('js/jquery.form.js')?>"></script>
<script type="text/javascript" >
(function(){
    var dom = {
        userInfo : $(".user_info")
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
                                    targetDom.html('录取').removeClass('btn-danger').addClass('btn-success');
                                } else {
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
	<title>抢人登录</title>
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
	var url = '<?= site_url();?>' + '/accept/checkBattlePwd';
	if(!pwd) {
		window.location.href = '<?= site_url();?>';
	}else if(pwd.length > 0 && pwd.length < 20) {
		$.post(url,{
			acceptBattleAccess : pwd
		},function(data) {
			//alert(data);
			if(data == false) {
				//alert(1);
				alert("密码不正确！");
				window.location.reload();
			} else {
				window.location.href = '<?= site_url();?>' + '/accept/acceptBattle';
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
