
$(document).ready(function() {
	var dom = {
	  	userName : $('#user_name'),
	  	userTelephone : $('#user_telephone'),
	  	userQQ : $('#user_qq'),
	  	userNumber : $('#user_number'),
	  	userMarjor : $('#user_major'),
	  	userSex : $('#user_sex')
	};

	var checkReturn = {
		checkName : false,
		checkTelephone : false,
		checkQQ : false,
		checkNumber : false,
		checkMarjor : false
	};

	var signUpCheck = {
	    init: function(){

	        this.eventCheck();
	    },

	    checkSign : function() {
	    /*	if(checkReturn.checkName && checkReturn.checkTelephone &&
	    	 checkReturn.checkQQ && checkReturn.checkNumber && checkReturn.checkMarjor) {
	    		return true;
	    	} else {
	    		return false;
	    	}*/
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
	    	});
	    }
	}

	signUpCheck.init();
	signUpCheck.checkSign();
});