<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>面试官登录</title>
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
			} else {
				window.location.href = '<?= site_url();?>' + '/Interviewer/showInterviewer?section=' + data + '&'+strs['1'] ;
			}
		});
	} else {
		alert("密码不正确！");
		window.location.reload();
	}
</script>	
</body>
</html>