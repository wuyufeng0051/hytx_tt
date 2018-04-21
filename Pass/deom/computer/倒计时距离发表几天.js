	// 页面调用
	function timeStamp(){
	var time=$('.time')
	$.each(time,function(index,item){
	 if ($(this).text().length > 13) {
	   var timeText=$(this).text();
 	    getDateDiff(stringToTime(timeText));
	    $(this).text(getDateDiff(stringToTime(timeText)));
	  }
	})
	}

	timeStamp();



	// 脚本文件
 	function getTimes(str, f, type) {
	var t = (f) ? parseInt(str) * 1000 : parseInt(str);
	var d = new Date(t);
	var y = d.getFullYear();
	var m = setNum(d.getMonth() + 1);
	var da = setNum(d.getDate());
	var m2 = d.getMonth() + 1;
	var h = setNum(d.getHours());
	var mm = setNum(d.getMinutes());
	var ss = setNum(d.getSeconds());
	if (type == 1) {
	return y + " " + m + " " + da + " " + h + " " + mm;
	} else if (type == 2) {
	return y + "年" + m + "月" + da + "日 " + h + ":" + mm + ":" + ss;
	} else if (type == 3) {
	return h + ":" + mm + ":" + ss;
	} else if (type == 4) {
	return y + " " + m + " " + da + " " + h + " " + mm;
	} else if (type == 5) {
	return y + "年" + m + "月" + da + "日 ";
	} else if (type == 6) {
	return da + "" + m2 + "月";
	} else if (type == 7) {
	return y + "." + m + "." + da;
	} else if (type == 8){
	return y + "-" + m + "-" + da;
	} else if (type == 9){
	return y + m + da + h + mm + ss;
	} else if (type == 11) {
	return y + "-" + m + "-" + da;
	}else if (type == 13) {
	return y + "-" + m + "-" + da +' '+ h + ":" + mm ;
	}else if (type == 14) {
	return y;
	}else if (type == 15) {
	return y+"年"+m+"月"+da+"日";
	}else {
	return y + "/" + m + "/" + da;
	}
	}

	/*个位补零*/
	function setNum(s) {
	return (parseInt(s) > 9) ? s : '0' + s;
	}

	/**
	* 根据年、月、日获取时间戳
	* @param String str 年、月、日
	*/
	function stringToTime(stringData){
	stringData = stringData.replace(/-/g,'/');
	var date = new Date(stringData);
	var time = date.getTime();
	return time;
	}

	/* 计算时间差
	* @param Long createTime 时间戳
	*/
	function getDateDiff(time) {
	var result1 = "";
	var str2 = time;
	var minute = 1000 * 60;
	var hour = minute * 60;
	var day = hour * 24;
	var halfamonth = day * 15;
	var month = day * 30;
	var now = new Date().getTime();
	var diffValue = now - str2;
	var monthC = diffValue / month;
	var weekC = diffValue / (7 * day);
	var dayC = diffValue / day;
	var hourC = diffValue / hour;
	var minC = diffValue / minute;
	if (monthC >= 1) {
	result1 = getTimes(str2, false, 15);
	 
	} else if (weekC >= 1) {
	result1 = parseInt(weekC) + "周前";
	} else if (dayC >= 1) {
	result1 = parseInt(dayC) + "天前";
	// var date =  new Date(parseInt(time)).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");      
	 // result1 = date;
	} else if (hourC >= 1) {
	result1 = parseInt(hourC) + "个小时前";
	} else if (minC >= 1) {
	result1 = parseInt(minC) + "分钟前";
	} else
	result1 = "刚刚发表";
	return result1;
	}
