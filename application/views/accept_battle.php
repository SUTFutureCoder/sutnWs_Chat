<?php if ($this->session->userdata('acceptBattle')): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>抢人列表</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                        <td><button type="button" userId='<?= $userInfoValue['user_id'] ?>' section='<?= $userListValue['section_id'] ?>' class=" battle_button btn btn-success"><?= $sectionList[$userListValue['section_id']] ?>录取</button></td>
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
        battle_button : $(".battle_button")
    }
    
    var battle = {
        init : function (){
            this.eventFn();
        },
        
        eventFn : function(){
            dom.battle_button.on('click', function(){
                var url = "<?= base_url('index.php/accept/acceptBattleChoose') ?>";
                var targetDom = $(this);
                var user_id = targetDom.attr('userId');
                var section_id = targetDom.attr('section');
                var button_word = targetDom.html();
                $.post(url,{
			userId : user_id,
                        chooseSection : section_id,
		},function(data) {
                        var data = JSON.parse(data);
                        alert(data['status']);
			if(data['code'] == 1) {
                            targetDom.parent().parent().parent().html('已被' + button_word);
			}
		});
            });
        }
    }
    battle.init();
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
