<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>面试官登录</title>
</head>
<body>
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" >
	var pwd = prompt('输入密码');
	var url = '<?= site_url();?>' + '/Interviewer/checkPwd';
	if(!pwd) {
		window.location.href = '<?= site_url();?>';
	}else if(pwd.length > 0 && pwd.length < 20) {
		$.post(url,{
			interviewerPwd : pwd
		},function(data) {
			//alert(data);
			if(data == false) {
				//alert(1);
				alert("密码不正确！");
				window.location.reload();
			}
		});
	} else {
		alert("密码不正确！");
		//window.location.reload();
	}
</script>	
</body>
</html>