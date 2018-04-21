(function($){
var isIE = !!window.ActiveXObject || "ActiveXObject" in window;
	isIE && $('.reg_tel_font').hide();
var form = document.getElementById("erui_user_register");
/*用户名*/
var uName = document.getElementById("reg_user_name");
/*用户名提示信息*/
var uName_sign = document.getElementById("reg_uName_sign");
/*密码*/
var pwd1 = document.getElementById("register_pwd1");
/* 提示信息 */
var pwd1_msg = document.getElementById("pwd1_msg");
/* 密码强度 */
var pwd1_str = document.getElementById("pwd1_strength");
/*确认密码*/
var pwd2 = document.getElementById("register_pwd2");
/*公司名称*/
var coName = document.getElementById("company_name");
/*公司验证邮箱*/
var coEmail = document.getElementById("register_email");
// 邮箱提示信息
var coEmail_sign = document.getElementById("reg_email_sign");
/*联系人姓名*/
var conName = document.getElementById("reg_contacts_name");
// 联系人姓名提示
var conName_sign = document.getElementById("reg_conName_sign");
/*联系人手机*/
var regPhone = document.getElementById("register_phone");
// 联系人手机提示
var conPhone_sign = document.getElementById("reg_conName_phone_sign");
/*电话区号*/
// var areaCode = document.getElementById("");
/*电话*/
var regTel = document.getElementById("register_tel");
//电话提示
var reg_conName_tel_sign = document.getElementById("reg_conName_tel_sign");
/*详细地址*/
var regAddress = document.getElementById("register_address");
// 地址提示
var addr_sign = document.getElementById("reg_address_sign");
/* 同意协议按钮 */
var proCheck = document.getElementById("erui_protocol_check");
/* 提交按钮 */
var subBtn = document.getElementById("register_submit_btn");
/* 提交按钮的盒子 */
var reg_btn_box = document.getElementById("reg_btn_box");

var DEFAULT_VERSION = "9.0";
var ua = navigator.userAgent.toLowerCase();
var isIE = ua.indexOf("msie") > -1;

/* 删除 hidden 类名 */
function removeHidden(obj) {
	var clName = trim(obj.className);
	obj.className = clName.replace("hidden", "");
}

/* 添加 hidden 类名 */
function addHidden(obj) {
	var clName = trim(obj.className);
	if (!clName.match("hidden")) {
		clName = trim(clName + " hidden");
		obj.className = clName;
	}
}

/* 添加hide类名 */
function addHide(obj) {
	var clName = trim(obj.className);
	if (!clName.match("hide")) {
		clName = trim(clName + " hide");
		obj.className = clName;
	}
}

/* 删除hide类名 */
function removeHide(obj) {
	var clName = obj.className;
	clName = clName.replace("hide", "");
	obj.className = clName;
}

/* 用户名合法性验证--格式仅支持字母大小写、数字，下划线 */
function uNameFormat() {
	if (/^\w{8,20}$/.test(trim(uName.value))) {
		return true;
	}
	return false;
}

/* 密码合法性验证 */
function pwdFormat() {
	// 密码长度8-20位，必须包含大写、小写字母及数字
	var pwdStr = trim(pwd1.value);
	var pwdLen = pwdStr.length;
	if (pwdLen < 8 || pwdLen > 22) {
		return false;
	}

	if (/[A-Za-z]/.test(pwdStr) && /\d/.test(pwdStr)) {
		return true;
	}

	return false;
}

/* 判断密码长度，并展示 */
var danger = document.getElementById("register_pwd1_dangerous");
var warn = document.getElementById("register_pwd1_warn");
var fine = document.getElementById("register_pwd1_fine");

/* 根据密码长度显示密码强度 */
function jdStrength() {
	/* 密码长度 */
	// console.log(pwd1.value);
	var len = pwd1.value ? trim(pwd1.value).length : 0;
	// console.log(len);
	if (len >= 8 && len < 13) {
		// 弱--长度为[8-13)
		fine.style.backgroundColor = "#DCDCDC";
		warn.style.backgroundColor = "#DCDCDC";
		return danger.style.backgroundColor = "#FE0000";
	} else if (len >= 13 && len < 18) {
		// 中--长度为[13-18)
		fine.style.backgroundColor = "#DCDCDC";
		warn.style.backgroundColor = "#FCC550";
		return danger.style.backgroundColor = "#FE0000";
	} else if (len >= 18 && len <= 22) {
		// 强--长度为[18-22]
		danger.style.backgroundColor = "#FE0000";
		warn.style.backgroundColor = "#FCC550";
		return fine.style.backgroundColor = "#00CA1C";
	}
}

/*邮箱合法性验证*/
function verifyEmail() {
	var emailReg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
	var email = trim(coEmail.value);

	// 邮箱为空
	if (email.length <= 0) {
		removeHidden(coEmail_sign);
		coEmail_sign.innerText = "Please enter your company Email";
		return false;
	}

	//console.log(emailReg.test(email));
	if (!emailReg.test(email)) {
		removeHidden(coEmail_sign);
		coEmail_sign.innerText = "The email format is incorrect.";
		return false;
	}

	return true; // 点击注册按钮时验证用
}

/*手机号合法性验证*/
function verifyPhone() {
	// var phoneReg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[1678]|18[0-9]|14[57])[0-9]{8}$/;
	var phoneReg = /^[0-9]*$/;
	if (phoneReg.test(Number(trim(regPhone.value)))) {
		console.log(phoneReg.test(Number(trim(regPhone.value))));
		return true;
	}

	console.log(phoneReg.test(Number(trim(regPhone.value))));
	return false;
}

/*电话号合法性验证*/
function verifyTel() {
	// var phoneReg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[1678]|18[0-9]|14[57])[0-9]{8}$/;
	var phoneReg = /^[0-9]*$/;
	if (phoneReg.test(Number(trim(regTel.value)))) {
		// console.log(phoneReg.test(Number(trim(regTel.value))));
		return true;
	}

	// console.log(phoneReg.test(Number(trim(regTel.value))));
	return false;
}

/*trim兼容*/
function trim(str) {
	var reg = /(^\s+)|(\s+$)/g;
	return str.replace(reg, "");
}

/*用户名验证 uName.value*/
// 用户输入时提示语：用户名允许输入的长度为8-20位字符，格式仅支持字母大小写、数字，下划线
uName.onblur = function () {
	if (!uNameFormat()) {
		removeHidden(uName_sign);
		return;
	}
};
uName.onfocus = function () {
	addHidden(uName_sign);
	this.select();
};

/* 密码逻辑 */
// 提示信息：pwd1_msg  密码强度：pwd1_str
pwd1.onfocus = function () {
	/* 初始化 */
	// pwd1_msg.style.visibility = "hidden";
	// pwd1_str.style.display = "none";
	addHidden(pwd1_msg);
	addHide(pwd1_str);
};

pwd1.oninput = function () {
	if (pwdFormat()) {
		pwd1_msg.style.display = "none";
		pwd1_str.style.display = "inline-block";
		jdStrength();
	} else {
		// console.log(pwd1_msg);
		pwd1_str.style.display = "none";
		removeHidden(pwd1_msg);
		pwd1_msg.style.visibility = "";
		pwd1_msg.style.display = "inline-block";
		pwd1_msg.style.lineHeight = "15px";
		pwd1_msg.innerText = "8-20 characters including letters, numbers, or the underscore character";
	}
};

pwd1.onblur = function () {
	if (pwdFormat()) {
		pwd1_msg.style.display = "none";
		pwd1_str.style.display = "inline-block";
		jdStrength();
	} else {
		/* 改变密码提示框的样式 */
		function changeCss() {
			pwd1_str.style.display = "none";
			removeHidden(pwd1_msg);
			pwd1_msg.style.visibility = "";
			pwd1_msg.style.display = "inline-block";
			pwd1_msg.style.lineHeight = "15px";
		}

		if (trim(pwd1.value)) {
			changeCss();
			pwd1_msg.innerText = "8-20 characters including letters, numbers, or the underscore character";
		} else {
			changeCss();
			pwd1_msg.innerText = "Please enter your password";
		}
	}
};

/* 确认密码 */
pwd2.onblur = function () {
	var pwd2_sign = document.getElementById("reg_pwd2_sign");
	if (trim(pwd2.value) !== trim(pwd1.value)) {
		return removeHidden(pwd2_sign);
	}
	addHidden(pwd2_sign);
};

/* 公司名称 coName */
coName.onblur = function () {
	if (trim(coName.value).length <= 0) {
		removeHidden(document.getElementById("reg_coName_sign"));
	}
};
coName.onfocus = function () {
	addHidden(document.getElementById("reg_coName_sign"));
};

/* 邮箱 */
// coEmail_sign
coEmail.onblur = verifyEmail;
coEmail.onfocus = function () {
	addHidden(coEmail_sign);
};

/* 联系人姓名 */
conName.onblur = function () {
	// console.log(trim(conName.value).length);
	if (trim(conName.value).length <= 0) {
		removeHidden(conName_sign);
	}
};
conName.onfocus = function () {
	addHidden(conName_sign);
};

/*联系人手机*/
// regPhone
//conPhone_sign
// 手机号为空
regPhone.onblur = function () {
	if (trim(regPhone.value).length <= 0) {
		removeHidden(conPhone_sign);
		return conPhone_sign.innerText = "Please enter your cellphone number";
	}

	if (!verifyPhone()) {
		removeHidden(conPhone_sign);
		return conPhone_sign.innerText = "Wrong cellphone number format.";
	}
};
regPhone.onfocus = function () {
	addHidden(conPhone_sign);
};

//电话验证  regTel  reg_conName_tel_sign
regTel.onblur = function () {
	if (trim(regTel.value).length > 0) {
		if (!verifyTel()) {
			removeHidden(reg_conName_tel_sign);
			return reg_conName_tel_sign.innerText = "Wrong office number format.";
		}
	}
};
regTel.onfocus = function () {
	addHidden(reg_conName_tel_sign);
};

/* 公司详细地址 */
// regAddress addr_sign
regAddress.onblur = function () {
	if (trim(this.value).length <= 0) {
		removeHidden(addr_sign);
	}
};
regAddress.onfocus = function () {
	addHidden(reg_conName_tel_sign);
};

/* 验证所有必须输入是否合法 */
/*
 合法返回 true
 不合法返回 false
 */
function verifyAll() {
	// 用户名不合法
	if (!uNameFormat()) {
		return false;
	}
	// 密码不合法
	if (!pwdFormat()) {
		return false;
	}
	// 密码与确认密码不一致
	if (trim(pwd2.value) !== trim(pwd1.value)) {
		return false;
	}
	// 公司名称为空
	if (trim(coName.value).length <= 0) {
		return false;
	}
	// 公司邮箱不合法
	if (!verifyEmail()) {
		return false;
	}
	// 联系人姓名为空
	if (trim(conName.value).length <= 0) {
		return false;
	}
	// 联系人手机号不合法
	if (!verifyPhone()) {
		return false;
	}
	// 电话号码不合法
	if (!verifyTel()) {
		return false;
	}
	// 地址为空
	if (trim(regAddress.value).length <= 0) {
		return false;
	}
	// // 未同意协议
	// if (!proCheck.checked) {
	//     return false;
	// }

	// 所有输入均合法时，允许提交
	return true;
}

/*阻止冒泡的兼容写法*/
function stopProp(e) {
	if (e.stopPropagation) {
		e.stopPropagation();
	} else {
		window.event.cancelBubble = true;
	}
}

/* 添加类样式 */
function addClassName(obj, name) {
	if (obj.className.indexOf(name) > -1) {
		return null;
	}
	var tmpName = trim(obj.className) + " " + name;
	// console.log(tmpName);
	obj.className = tmpName;
}

/* 兼容IE的阻止submit提交 - 开始 */
/*var form = document.getElementById("form");
 var btn = document.getElementById("btn");
 var uName = document.getElementById("uName");*/

/* 条件不满足时，干掉submit按钮换上另一个按钮 */
var inputBtn = document.createElement("input");
inputBtn.type = "button";
inputBtn.value = "Register Now";

subBtn.onmouseenter = function () {
	if (!verifyAll()) {
		this.style.display = "none";
		inputBtn.style.display = "inline-block";
		// inputBtn.className = "btn nbtn";
		addClassName(inputBtn, "register_submit");
		reg_btn_box.appendChild(inputBtn);
	}
};

inputBtn.onmouseleave = function () {
	this.style.display = "none";
	subBtn.style.display = "inline-block";
};
/* 兼容IE的阻止submit提交 - 结束 */

/* 中国 - 开始 */
/* 假数据 */
// var country = ["中国1", "中国2", "中国3", "中国4", "中国5", "中国6", "中国7", "刚果8", "哥伦中比亚8", "哥斯达黎加", "中格林纳达9", "格陵兰岛", "哈萨克斯坦", "海中地9", "韩国", "荷兰", "洪都拉斯", "中非共和国10", "中国11", "刚果", "哥伦比亚", "哥斯达黎加", "格林纳达", "格陵兰岛", "哈萨克斯坦", "海地", "韩国", "荷兰", "洪都拉斯", "中非共和国12"];

var province = {
	"山东": ["济南", "青岛", "淄博", "枣庄", "东营", "烟台", "潍坊", "济宁", "泰安", "威海", "日照", "滨州", "德州", "聊城", "临沂", "菏泽", "莱芜"],
	"北京": ["东城区", "西城区", "朝阳区", "丰台区", "石景山区", "海淀区", "门头沟区", "房山区", "通州区", "顺义区", "昌平区", "大兴区", "怀柔区", "平谷区", "密云区", "延庆区"],
	"河北": ["石家庄", "唐山", "邯郸", "秦皇岛", "保定", "张家口", "承德", "廊坊", "沧州", "衡水", "邢台"]
};
var box = document.getElementById("reg_country_box");
var ul = document.getElementById("countrys");
// var inp = document.getElementById("erui_register_country");
var country = [];

/*inp.onkeyup = function () {
 var searchKey = trim(this.value);
 // console.log(searchKey);

 if (searchKey === "undefined") {
 searchedCountrys = province;
 } else {
 // console.log(country[3].indexOf("达")); // -1表示没有找到
 get(searchKey, country);
 if (searchedCountrys.length > 0) {
 // borderNone(inp, ["bottom"]);
 inp.style.webkitBorderBottomLeftRadius = "0px";
 inp.style.webkitBorderBottomRightRadius = "0px";
 }
 }

 // 创建li并添加到ul标签
 createLi(ul);

 // 显示标签ul
 ul.style.display = "block";
 };*/
/*inp.onclick = function () {
 var searchKey = trim(this.value);
 // console.log(searchKey);

 if (searchKey === "undefined") {
 searchedCountrys = province;
 } else {
 // console.log(country[3].indexOf("达")); // -1表示没有找到
 get(searchKey, country);
 if (searchedCountrys.length > 0) {
 // borderNone(inp, ["bottom"]);
 inp.style.webkitBorderBottomLeftRadius = "0px";
 inp.style.webkitBorderBottomRightRadius = "0px";
 }
 }

 // 创建li并添加到ul标签
 createLi(ul);

 // 显示标签ul
 ul.style.display = "block";
 };*/

/*if (ul.addEventListener) {
 ul.addEventListener("click", function (e) {
 console.log(e.target.innerHTML);
 console.log(e.target.nodeName.toUpperCase());
 // 检查事件源e.targe是否为Li
 if (e.target && e.target.nodeName.toUpperCase() === "LI") {
 // 真正的处理过程在这里
 inp.value = e.target.innerHTML;
 this.style.display = "none";
 inp.style.borderBottomLeftRadius = "2px";
 inp.style.borderBottomRightRadius = "2px";
 }
 });
 } else {
 ul.attachEvent("onclick", function (e) {
 // console.log(e.target.innerHTML);
 // console.log(e.target.nodeName.toUpperCase());
 // 检查事件源e.targe是否为Li
 if (e.target && e.target.nodeName.toUpperCase() === "LI") {
 // 真正的处理过程在这里
 // inp.value = e.target.innerHTML;
 this.style.display = "none";
 // inp.style.borderBottomLeftRadius = "2px";
 // inp.style.borderBottomRightRadius = "2px";
 }
 });
 }*/

/*ul.onmouseleave = function () {
 this.style.display = "none";
 };*/

if (isIE) {
	var safariVersion = ua.match(/msie ([\d.]+)/)[1]; // 拿到ie版本号
	if (safariVersion <= DEFAULT_VERSION) {
		//ul.style.width = "100px";
	}
}

/* 根据用户输入，搜索国家 */
function get(key, country) {
	var tmpArr = [];
	for (var i = 0; i < country.length; i++) {
		if (country[i].indexOf(key) > -1) {
			tmpArr.push(country[i]);
		}
	}
	searchedCountrys = tmpArr;
}
/*
 * 创建li并将创建好的li插入到ul
 * obj:表示插入目标对象，例:ul
 */
function createLi(obj) {
	obj.innerHTML = "";
	var frg = document.createDocumentFragment();
	for (var j = 0; j < searchedCountrys.length; j++) {
		var li = document.createElement("li");
		li.innerHTML = searchedCountrys[j];
		frg.appendChild(li);
	}
	obj.appendChild(frg);
}

/*
 * 设置标签的某个/某几个border为display:none
 * 参数为数组[top,right,bottom,left]
 * */
function borderNone(obj, borderArr) {
	var len1 = borderArr.length;
	var tmpArr = [];

	for (var i = 0; i < len1; i++) {
		var borderOption = "border" + borderArr[i].charAt(0).toUpperCase() + borderArr[i].slice(1);
		tmpArr.push(borderOption);
	}

	var len2 = tmpArr.length;
	for (var j = 0; j < len2; j++) {
		console.log(tmpArr[j]);
		obj.style[tmpArr[j]] = "none";
//            obj.style.borderBottom = "none";
	}
}

/*
 * 显示border
 * 参数为数组[top,right,bottom,left]
 * */
function borderShow(obj, borderArr) {
	var len1 = borderArr.length;
	var tmpArr = [];

	for (var i = 0; i < len1; i++) {
		var borderOption = "border" + borderArr[i].charAt(0).toUpperCase() + borderArr[i].slice(1);
		tmpArr.push(borderOption);
	}

	var len2 = tmpArr.length;
	for (var j = 0; j < len2; j++) {
		console.log(tmpArr[j]);
		obj.style[tmpArr[j]] = "1px solid #ccc";
//            obj.style.borderBottom = "none";
	}
}

/* 中国 - 结束 */


/*注册按钮*/
/* 兼容IE8的placeholder - 开始 */
var JPlaceHolder = {
    //检测
    _check : function(){
        return 'placeholder' in document.createElement('input');
    },
    //初始化
    init : function(){
        if(!this._check()){
            this.fix();
        }
    },
    //修复
    fix : function(){
        jQuery('#input :input[placeholder]').each(function(index, element) {
            var self = $(this), txt = self.attr('placeholder');
          
            var pos = self.position(), h = self.outerHeight(true), paddingleft = self.css('padding-left');
            var holder = $('<span></span>').text(txt).css({position:'absolute', left:pos.left, top:pos.top+6, height:h, lienHeight:h, paddingLeft:paddingleft, color:'#aaa'}).appendTo(self.parent());
            self.focusin(function(e) {
                holder.hide();
            }).focusout(function(e) {
                if(!self.val()){
                    holder.show();
                }
            });
            holder.click(function(e) {
                holder.hide();
                self.focus();
            });
        });
    }
};
//执行
jQuery(function(){
    JPlaceHolder.init();    
});
/* 兼容IE8的placeholder - 结束 */

/*动态创建option并渲染到页面*/
/*(function createOption() {
 // countryList是在getCountryList.js中获取的国家列表
 for (var i = 0; i < countryList.length; i++) {
 var $option = $("<option></option>").val(countryList[i].id).text(countryList[i].name);
 $("#erui_register_country").append($option);
 }
 })();*/

$('#register_submit_btn').click(function () {
	$.ajax({
		url: '/index/Login/registerdo',
		data: {
			"user_name": $('#reg_user_name').val(),
			"password": $('#register_pwd1').val(),
			"name": $('#company_name').val(),
			"email": $('#register_email').val(),
			"first_name": $('#reg_contacts_name').val(),
			"mobile": $('#register_phone').val(),
			"phone": $('#register_tel').val(),
			"country": $('#erui_register_country').val(),
			"address": $('#register_address').val()
		},
		type: 'post',
		dataType: 'json',
		success: function (data) {
			if (data.code == 1) {
				var arr = data.data;
				window.location.href = "/index/Login/succ?key=" + arr.key + "&email=" + arr.email + "&name=" + arr.name;
			} else {
				alert(data.message);
			}
			// view("修改成功！");
		}
	});
});
})($);


