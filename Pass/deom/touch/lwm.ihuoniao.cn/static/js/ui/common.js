var huoniao = {
	
	//转换PHP时间戳
	transTimes: function(timestamp,n){
		update = new Date(timestamp*1000);//时间戳要乘1000
		year   = update.getFullYear();
		month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
		day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
		hour   = (update.getHours()<10)?('0'+update.getHours()):(update.getHours());
		minute = (update.getMinutes()<10)?('0'+update.getMinutes()):(update.getMinutes());
		second = (update.getSeconds()<10)?('0'+update.getSeconds()):(update.getSeconds());
		if(n==1){
			return (year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second);
		}else if(n==2){
			return (year+'-'+month+'-'+day);
		}else{
			return 0;
		}
	}
	
}