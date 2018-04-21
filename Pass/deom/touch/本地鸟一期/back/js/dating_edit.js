$(function(){
	// 接受入驻条款
	$('.agree ').click(function(){
		var x = $(this);
		if (x.hasClass('agree_bc')) {
			x.removeClass('agree_bc');
		}else{
			x.addClass('agree_bc');
		}
	})
	  // $('.cheng p span').click(function(){
	  //   $('.cheng').hide();
	  //   $('.disk').hide();
	  // })
	  $('.disk').click(function(){
	    $('.cheng').hide();
	    $('.disk').hide();
	    $('.delete').hide();
	  })

    $.ajax({
        data: {},//请求接口传递的参数
        url: "selects",//接口URL地址
        dataType: 'json',//JSONP格式，跨域请求使用
        jsonp: 'callback',
        success: function (result) {
            var sex=[{'id':'0','value':'美女'},{'id':'1','value':'帅哥'}];
            var age=[{'id':'2018','value':'2018'}, {'id':'2017','value':'2017'}, {'id':'2016','value':'2016'}, {'id':'2015','value':'2015'}, {'id':'2014','value':'2014'}, {'id':'2013','value':'2013'}, {'id':'2012','value':'2012'}, {'id':'2011','value':'2011'}, {'id':'2010','value':'2010'}, {'id':'2009','value':'2009'}, {'id':'2008','value':'2008'}, {'id':'2007','value':'2007'}, {'id':'2006','value':'2006'}, {'id':'2005','value':'2005'}, {'id':'2004','value':'2004'}, {'id':'2003','value':'2003'}, {'id':'2002','value':'2002'}, {'id':'2001','value':'2001'}, {'id':'2000','value':'2000'}, {'id':'1999','value':'1999'}, {'id':'1998','value':'1998'}, {'id':'1997','value':'1997'}, {'id':'1996','value':'1996'}, {'id':'1995','value':'1995'}, {'id':'1994','value':'1994'}, {'id':'1993','value':'1993'}, {'id':'1992','value':'1992'}, {'id':'1991','value':'1991'}, {'id':'1990','value':'1990'}, {'id':'1989','value':'1989'}, {'id':'1988','value':'1988'}, {'id':'1987','value':'1987'}, {'id':'1986','value':'1986'}, {'id':'1985','value':'1985'}, {'id':'1984','value':'1984'}, {'id':'1983','value':'1983'}, {'id':'1982','value':'1982'}, {'id':'1981','value':'1981'}, {'id':'1980','value':'1980'}, {'id':'1979','value':'1979'}, {'id':'1978','value':'1978'}, {'id':'1977','value':'1977'}, {'id':'1976','value':'1976'}, {'id':'1975','value':'1975'}, {'id':'1974','value':'1974'}, {'id':'1973','value':'1973'}, {'id':'1972','value':'1972'}, {'id':'1971','value':'1971'}, {'id':'1970','value':'1970'}, {'id':'1969','value':'1969'}, {'id':'1968','value':'1968'}, {'id':'1967','value':'1967'}, {'id':'1966','value':'1966'}, {'id':'1965','value':'1965'}, {'id':'1964','value':'1964'}, {'id':'1963','value':'1963'}, {'id':'1962','value':'1962'}, {'id':'1961','value':'1961'}, {'id':'1960','value':'1960'}, {'id':'1959','value':'1959'}, {'id':'1958','value':'1958'}, {'id':'1957','value':'1957'}, {'id':'1956','value':'1956'}, {'id':'1955','value':'1955'}, {'id':'1954','value':'1954'}, {'id':'1953','value':'1953'}, {'id':'1952','value':'1952'}, {'id':'1951','value':'1951'},{'id':'1950','value':'1950'}];
            var type= result.data.dating_type;
            var marry=result.data.marry_state;
            var height=[{'id':'150','value':'150'}, {'id':'151','value':'151'}, {'id':'152','value':'152'}, {'id':'153','value':'153'}, {'id':'154','value':'154'}, {'id':'155','value':'155'}, {'id':'156','value':'156'}, {'id':'157','value':'157'}, {'id':'158','value':'158'}, {'id':'159','value':'159'}, {'id':'160','value':'160'}, {'id':'161','value':'161'}, {'id':'162','value':'162'}, {'id':'163','value':'163'}, {'id':'164','value':'164'}, {'id':'165','value':'165'}, {'id':'166','value':'166'}, {'id':'167','value':'167'}, {'id':'168','value':'168'}, {'id':'169','value':'169'}, {'id':'170','value':'170'}, {'id':'171','value':'171'}, {'id':'172','value':'172'}, {'id':'173','value':'173'}, {'id':'174','value':'174'}, {'id':'175','value':'175'}, {'id':'176','value':'176'}, {'id':'177','value':'177'}, {'id':'178','value':'178'}, {'id':'179','value':'179'}, {'id':'180','value':'180'}, {'id':'181','value':'181'}, {'id':'182','value':'182'}, {'id':'183','value':'183'}, {'id':'184','value':'184'}, {'id':'185','value':'185'}, {'id':'186','value':'186'}, {'id':'187','value':'187'}, {'id':'188','value':'188'}, {'id':'189','value':'189'}, {'id':'190','value':'190'}, {'id':'191','value':'191'}, {'id':'192','value':'192'}, {'id':'193','value':'193'}, {'id':'194','value':'194'}, {'id':'195','value':'195'}, {'id':'196','value':'196'}, {'id':'197','value':'197'}, {'id':'198','value':'198'}, {'id':'199','value':'199'}, {'id':'200','value':'200'}];
            var school=result.data.education;
            var money=result.data.month_income;
            var house=result.data.has;
            var gong=[{'id':'1','value':'公开'},{'id':'0','value':'不公开'}];

            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger1',
                title: '性别',
                wheels: [
                    {data: sex}
                ],
                position: [0], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
					$('#dating_sex').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger2',
                title: '年龄',
                wheels: [
                    {data: age}
                ],
                position: [18], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_birthyear').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger3',
                title: '交友类型',
                wheels: [
                    {data: type}
                ],
                position: [1], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_type').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger4',
                title: '婚姻状况',
                wheels: [
                    {data: marry}
                ],
                position: [0], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_marrystate').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger5',
                title: '身高',
                wheels: [
                    {data: height}
                ],
                position: [20], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_height').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger6',
                title: '学历',
                wheels: [
                    {data: school}
                ],
                position: [1], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_educate').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger7',
                title: '月收入',
                wheels: [
                    {data: money}
                ],
                position: [1], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_monthincome').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger8',
                title: '车房情况',
                wheels: [
                    {data: house}
                ],
                position: [0], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_has').val(data[0]['id']);
                }
            });
            var mobileSelect1 = new MobileSelect({
                trigger: '#trigger9',
                title: '',
                wheels: [
                    {data: gong}
                ],
                position: [0], //初始化定位 打开时默认选中的哪个  如果不填默认为0
                callback:function(indexArr, data){
                    console.log(data[0]['id']); //返回选中的json数据
                    $('#dating_phoneisopen').val(data[0]['id']);
                }
            });
        }
    });

    $('.delete .cancel').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
    $('.disk').click(function(){
    	$('.delete').hide();
	    $('.disk').hide();
    })
    $(function(){
        $('.change').click(function(){
            $(this).hide();
            $(this).closest('.user-fav').find('input').removeAttr("disabled");
            $('.change_box').show();
            $('.send').show();
        })
    })
})