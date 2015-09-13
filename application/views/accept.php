<?php if (in_array($this->session->userdata('acceptAccess'), array('宣传部', '外联部', '采编部', '策划部', '影音部', '技术部'))): ?>
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
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>录取登录</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="alert alert-info" role="alert">目前录取 <a id="person_sum"></a> 人</div>
    <div>
        
    </div>
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
