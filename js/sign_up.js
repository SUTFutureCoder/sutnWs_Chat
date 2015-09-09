
$(document).ready(function() {
	var dom = {
	  	userName : $('#user_name'),
	  	userTelephone : $('#user_telephone'),
	  	userQQ : $('#user_qq'),
	  	userNumber : $('#user_number'),
	  	userMarjor : $('#user_major'),
	  	userSex : $('#user_sex'),
	  	sectionWill : $('#section_will')
	};

	var checkReturn = {
		checkName : false,
		checkTelephone : false,
		checkQQ : false,
		checkNumber : false,
		checkMarjor : false,
		sectionWill : false,
		checkValidatecode : false
	};

	var signUpCheck = {
	    init: function(){

	        this.eventCheck();
	    },

	   /* checkSign : function() {
	    	if(checkReturn.checkName && checkReturn.checkTelephone && checkReturn.checkQQ && checkReturn.checkNumber && checkReturn.checkMarjor && checkReturn.sectionWill && checkReturn.checkValidatecode) {
	    		return true;
	    	} else {
	    		return false;
	    	}
	    },
*/
	    checkValidatecode : function() {
	    	var validatecode = $('#validatecode').val();
	    	if(validatecode.length != 4) {
	    		 checkReturn.checkValidatecode = false;
	    		return false;
	    	} else {
	    		var url = $('#hide_site_url').val() + '/Sign_up/checkValidatecode';
	    		$.post(url,{
	    			validatecode : validatecode
	    		},function(data) {
	    			checkReturn.checkValidatecode = data;
	    			return data;
	    		});
	    	}
	    },

	    eventCheck: function() {
	    	dom.userName.bind('input propertychange blur', function() {
	    		var name = $(this).val();
	    		var len = name.length;
	    		var myReg = /^[\u0391-\uFFE5A-Za-z]+$/;
				if(len == 0) {
					checkReturn.checkName = false;
				} else if(!myReg.test(name)) {
					checkReturn.checkName = false;
	    		} else {
	    			checkReturn.checkName = true;
	    		}
	    	});

	    	dom.userTelephone.bind('input propertychange blur',function() {
	    		var telephone = $(this).val();
	    		var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
	    		if(!reg.test(telephone)) {
	    		 	checkReturn.checkTelephone = false;
	    		} else {
	    		 	checkReturn.checkTelephone = true;
	    		}
	    	});

	    	dom.userQQ.bind('input propertychange blur',function() {
	    		var qq = $(this).val();
	    		//alert(qq);
	    		var len = qq.length;
	    		if(len >= 5 && len <= 16) {
	    			checkReturn.checkQQ = true;
	    		} else {
	    			checkReturn.checkQQ = false;
	    		}
	    	});

	    	dom.userNumber.bind('input propertychange blur',function() {
	    		var number = $(this).val();
	    		var len = number.length;
	    		if(len != 9) {
	    			checkReturn.checkNumber =  false;
	    		} else {
	    			//checkReturn.checkNumber =  true;
	    			url = $('#hide_site_url').val() + '/Sign_up/checkNumber';
	    			$.post(url,{number:number},function(data) {
	    				if(data == true) {
	    					checkReturn.checkNumber =  true;
	    				} else {
	    					checkReturn.checkNumber =  false;
	    				}
	    			});
	    		}
	    	});

	    	dom.userMarjor.bind('input propertychange blur',function() {
	    		var marjor = $(this).val;
	    		var len = marjor.length;
	    		if(len > 0 && len <= 30) {
	    			checkReturn.checkMarjor = true;
	    		} else {
	    			checkReturn.checkMarjor = false;
	    		}
	    	});

	    	dom.sectionWill.on('click change', '.section_will_select', function(){
	    	    var checkFirstSection = $('#first_section').val();
	    	    var checkSceondSection = $('#second_section').val();
	    	    var checkThirdSection = $('#third_section').val();
	    	    if(checkFirstSection != 0) {
	    	    	checkReturn.sectionWill = true;
	    	    } else {
	    	    	checkReturn.sectionWill = false;
	    	    }
	    	});
	    }
	}



	signUpCheck.init();
	//signUpCheck.checkSign();
	$('#signUp_submit').click(function() {
		var checkValidatecode = signUpCheck.checkValidatecode();
			if(checkReturn.checkName == false) {
				alert("请检查姓名填写是否正确");
			} else if(checkReturn.checkTelephone == false) {
				alert("请检查联系方式填写是否正确");
			} else if(checkReturn.checkQQ == false) {
				alert("请检查QQ填写是否正确");
			} else if(checkReturn.checkNumber == false) {
				alert("请检查学号填写是否正确");
			} else if(checkReturn.checkMarjor == false) {
				alert("请检查专业填写是否正确");
			} else if(checkReturn.sectionWill == false){
				alert("请检查志愿是否填写正确");
			} else if(checkValidatecode == false) {
				alert("验证码填写错误");
				$('#validatecode_img').click();
			}else {
				/*var check = signUpCheck.checkSign();
				if(check != true) {
					alert("请检查你填写的信息是否正确!");
				} else {*/
					//alert('1');
					var url = $('#hide_site_url').val() + '/Sign_up/submitUser';
					$.post(url,{
						userName : $('#user_name').val(),
						userTelephone : $('#user_telephone').val(),
						userQQ : $('#user_qq').val(),
						userNumber : $('#user_number').val(),
						userMajor : $('#user_major').val(),
						userSex : $('#user_sex').val(),
						userFirstSection : $('#first_section').val(),
						userSecondSection : $('#second_section').val(),
						userThirdSection : $('#third_section').val(),
						user_talent : $('#user_talent').val()
					},function(data) {
						alert(data);
						if(data == false) {
							alert('"家"入失败！请仔细检查你填写的信息是否正确!');
						} else {
							/*var successInfo = eval("("+data+")");
							$('#success_info').on('shown.bs.modal', function () {
							  
							})*/
						}
					});
				//}
			}
	});
});