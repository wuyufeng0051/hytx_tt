/**
 * Created by tanytree on 2016/9/1.
 * 注意：这个文件包含了组件的信息提交和组件的渲染俩大块
 */
//这里是初始化所有组件生成到页面上
$(function(){
	var _container=$("#anythingContent");
	// 生成每个组件的 HTML 代码
	var createHTML = {
		id_checkbox: function(o){
			var options = '',
				count = 0,
				layout = '',
				serial = o.eid.replace(/[^\d]/g,''),
				instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div><div class="modCell tl">':'<p class="instruct"></p></div><div class="modCell tl">'),
				titleField = '<div class="activeFormMod checkBoxAndRadio checkboxMod"> <div class="formWrap"><div class="haederText"><h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i><i class="redTip">［请<b>至少</b>选择<s></s>项]</i></h2>',
				mainField = '',
				layoutMap = {
					'column-1': 1,
					'column-2': 2,
					'column-3': 3,
					'column-4': 4
				},
				layoutVal = false;
			if(layoutMap[o.layout] !== 1){
				layoutVal = layoutMap[o.layout];
			}
			$.each(o.value, function(n,v){
				options += '<li class="optionsLine"><label><input type="checkbox" name="checkbox'+serial+'" disabled="true" value="'+(v.lid||count)+'" '+((v.selected)?'checked="checked"':'')+'><span class="optionValue">'+v.name+'</span></label></li>';
				count++;
			});
			if(o.layout){
				layout = 'column-'+ o.layout;
			}
			mainField = '<div class="checkbox"><ul class="optionGarden clearfix '+layout+'">'+options+'</ul></div></div></div></div>';
			return titleField+instructField+mainField;
		},
		id_dropdown: function (o) {
			var options = '',
				count = 0,
				instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div><div class="modCell">':'<p class="instruct"></p></div><div class="modCell">'),
				titleField = '<div class="activeFormMod selectMod"><div class="formWrap"><div class="haederText"><h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2>',
				mainField;
			$.each(o.value, function(n,v){
				if(!v.hasOwnProperty('input')){
					options += '<option name="'+(v.lid||count)+'" '+((v.selected)?'selected="selected"':'')+'>'+v.name+'</option>';
					count++;
				}
			});
			mainField = '<div class="select" ><select>'+options+'</select></div></div></div></div>';
			return titleField+instructField+mainField;
		},
		id_multiple: function (o) {
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div><div class="modCell">':'<p class="instruct"></p></div><div class="modCell">'),
				titleField = '<div class="activeFormMod textMod"><div class="formWrap"><div class="haederText"><h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2>',
				mainField = '<textarea disabled="true">'+((o.value)?o.value:"")+'</textarea></div></div></div>';
			return titleField+instructField+mainField;
		},
		id_radio: function(o){
			var options = '',
				count = 0,
				serial = o.eid.replace(/[^\d]/g,''),
				layout = '',
				instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div><div class="modCell tl">':'<p class="instruct"></p></div><div class="modCell tl">'),
				titleField = '<div class="activeFormMod checkBoxAndRadio radioMod"> <div class="formWrap"><div class="haederText"><h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2>',
				mainField = '',
				layoutMap = {
					'column-1': 1,
					'column-2': 2,
					'column-3': 3,
					'column-4': 4
				},
				layoutVal = false;

			if(layoutMap[o.layout] !== 1){
				layoutVal = layoutMap[o.layout];
			}
			$.each(o.value, function(n,v){
				options += '<li class="optionsLine"><label><input type="radio" name="radio'+serial+'" disabled="true" value="'+(v.lid||count)+'" '+((v.selected)?'checked="checked"':'')+'><span class="optionValue">'+v.name+'</span></label></li>';
				count++;
			});
			if(o.layout){
				layout = 'column-'+ o.layout;
			}
			mainField = '<div class="radio"><ul class="optionGarden clearfix '+layout+'">'+options+'</ul></div></div></div></div>';
			return titleField+instructField+mainField;
		},
		id_singleline: function (o) {
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div><div class="modCell">':'<p class="instruct"></p></div><div class="modCell">'),
				titleField = '<div class="activeFormMod textMod"><div class="formWrap"><div class="haederText"><h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2>',
				mainField = '<input type="text" '+((o.value)?'value="'+o.value+'"':"")+' disabled="true"></div></div></div>';
			return titleField+instructField+mainField;
		},
		id_code: function (o) {
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p> </div>':'<p class="instruct"></p> </div>'),
				titleField = '<div class="activeFormMod codeMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">'+o.title+'</span></h2>',
				mainField = '<div class="modCell"> <input type="text" class="minInput"  '+((o.value)?'value="'+o.value+'"':"")+' disabled="true"><span class="code"><img src="{pigcms:$staticPath}/tpl/static/custom/formImg/placeholder/code.png"></span><a href="javascript:;" class="btn"></a> </div> </div> </div>';
			return titleField+instructField+mainField;
		},
		id_section: function(o) {
			var instructField = ((o.instruct)?'<p class="instruct subtitle" style="'+ (o.alignstyle||'') +'">'+_dlMarkEval(o.instruct)+'</p></div></div></div>':'<p class="instruct subtitle" style="'+ (o.alignstyle||'') +'"></p></div></div></div>'),
				titleField = '<div class="activeFormMod sectionMod"><div class="formWrap"><div class="modCell"><h3 class="title title_field" style="'+ (o.titlealignstyle||'') + '">'+o.title+'</h3>';

			return titleField+instructField;
		},
		id_picture: function(o) {
			var instructField = ((o.instruct)?' <p class="instruct subtitle" style="'+ (o.alignstyle||'') +'">'+_dlMarkEval(o.instruct)+'</p> </div> </div> </div>':'<p class="instruct subtitle" style="'+ (o.alignstyle||'') +'"></p> </div> </div> </div>'),
				mainField = '<div class="activeFormMod imgMod"> <div class="formWrap"> <div class="modCell"> <div class="i-pic title_field img_title"  img-link="'+ o.imglink+'"> <img style="'+((o.pictureshow==='normal' || !o.pictureshow)?'width:100%':'max-width:100%')+'" src="'+decodeURIComponent(o.img)+'"><input type="file" class="in_pic_upload" name="_FILE_"> </div>';
			return mainField+instructField;
		},
		id_fileupload: function(o) {
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div> ':'<p class="instruct"></p></div>'),
				titleField = '<div class="activeFormMod fileUploadMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2> ',
				mainField = '<div class="modCell"> <ul class="clearfix imgList"> <li> <img src="'+siteurl+'/tpl/static/custom/formImg/placeholder/midImg.png"> <i class="delete"></i> </li> <li> <img src="'+siteurl+'/tpl/static/custom/formImg/placeholder/midImg.png"> <i class="delete"></i> </li> <li> <img src="'+siteurl+'/tpl/static/custom/formImg/placeholder/midImg.png"> <i class="delete"></i> </li> <li> <img src="'+siteurl+'/tpl/static/custom/formImg/placeholder/midImg.png"> <i class="delete"></i> </li> </ul> <ul class="btn clearfix"> <li class="pr add"> <input type="file" accept="image" name="file" disabled="true" class="pa"> <a href="javascript:;"></a> </li> <li class="reduce"> <a href="javascript:;"></a> </li> <li class="cancel"> <a href="javascript:;">取消</a> </li> </ul> </div> </div> </div>';
			return titleField+instructField+mainField;
		},
		id_picturecheckbox: function(o){
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p> </div> <div class="modCell tc">':'<p class="instruct"></p> </div> <div class="modCell tc">'),
				titleField = '<div class="activeFormMod checkBoxAndRadio checkboxWithImgMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i><i class="redTip">［请<b>至少</b>选择<s></s>项]</i></h2> ',
				mainField,
				serial = o.eid.replace(/[^\d]/g,''),
				tmpHTML = '';
			if(o.value){
				$.each(o.value, function(n, v) {
					var _img = '';
					if(v.img){
						_img = '<img class="picc_img" src="'+decodeURIComponent(v.img)+'">';
					}
					tmpHTML += '<li class="picturecheckbox-item" listfield="'+n+'"><div class="piccheckbox_img i-pic">'+_img+'</div><div class="piccheckbox_contect"><input type="checkbox" name="picturecheckbox'+serial+'" value="'+(v.lid||n)+'" '+((v.selected)?'checked="checked"':'')+' disabled="disabled"><span class="optionValue">'+v.name+'</span></div></li>';
				});
			}
			mainField = '<div class="picture_checkbox"><ul class="pictureCheckboxList clearfix">'+tmpHTML+'</ul></div></div> </div> </div>';
			return titleField+instructField+mainField;
		},
		id_pictureradio: function(o){
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p> </div> <div class="modCell tc">':'<p class="instruct"></p> </div> <div class="modCell tc">'),
				titleField = '<div class="activeFormMod checkBoxAndRadio radioWithImgMod"> <div class="formWrap"> <div class="haederText"> <h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2> ',
				mainField,
				serial = o.eid.replace(/[^\d]/g,''),
				tmpHTML = '';
			if(o.value){
				$.each(o.value, function(n, v) {
					var _img = '';
					if(v.img){
						_img = '<img class="picc_img" src="'+decodeURIComponent(v.img)+'">';
					}
					tmpHTML += '<li class="pictureradio-item" listfield="'+n+'"><div class="picradio_img i-pic">'+_img+'</div><input type="radio" name="pictureradio'+serial+'" value="'+(v.lid||n)+'" '+((v.selected)?'checked="checked"':'')+' disabled="disabled"><span class="optionValue">'+v.name+'</span></li>';
				});
			}

			mainField = '<div class="picture_radio"><ul class="pictureRadioList clearfix">'+tmpHTML+'</ul></div></div> </div> </div>';
			return titleField+instructField+mainField;
		},
		id_city: function(o){
			return this.id_singleline(o);
		},
		id_date: function(o){
			var instructField = ((o.instruct)?'<p class="instruct">'+_dlMarkEval(o.instruct)+'</p></div><div class="modCell">':'<p class="instruct"></p></div><div class="modCell">'),
				titleField = '<div class="activeFormMod textMod"><div class="formWrap"><div class="haederText"><h2><span class="title">'+o.title+'</span><i class="com_required">'+((o.required)==1?'*':'')+'</i></h2>',
				mainField = '<input type="text" class="date" '+((o.value)?'value="'+o.value+'"':"")+' disabled="true" datetype="'+o.datetype+'"></div></div></div>';
			return titleField+instructField+mainField;
		},
		id_email: function(o){
			return this.id_singleline(o);
		},
		id_id: function(o){
			return this.id_singleline(o);
		},
		id_number: function(o){
			return this.id_singleline(o);
		},
		id_phone: function(o){
			return this.id_singleline(o);
		}
	};

	// 生成一个对象的HTML / 可以获取对象的ID *
	var _createComponent = function (o){
		var componentHTML = '<li class="locked" id="'+o.eid+'" name="'+o.name+'">'+createHTML[o.name](o)+'</li>';
		return componentHTML;
	};
	// 通过JSON串来构建表单
	var _createFormViaJSON = function (opt){
		// 传入一个json对象
		var com = null;
		if(opt){
			$(".addModBtn").remove();
			$.each(opt, function(n,v){
				com = $(_createComponent(v));
				com.appendTo(_container.find(".form_component"));
				if(v.layout){
					com.data('layoutType', v.layout);
				}
				if(v.name === 'id_checkbox' || v.name === 'id_picturecheckbox'){
					if(v.stype!='9'){
						com.data('__MGComponentSelect',{
							enable: true,
							number: v.snumber,
							type: v.stype
						});
						com.find(".redTip").show().find("s").text(v.snumber);
						var typeNum='';
						if(v.stype==1){
							typeNum='至少';
						}else if(v.stype==2){
							typeNum='最多';
						}else if(v.stype==3){
							typeNum='恰好';
						}else{
							typeNum='';
						}
						com.find(".redTip").find("b").text(typeNum);
					}
				}
				if(v.name==='id_fileupload'){
					com.data('imgnum',v.imgnum);
				}
				if(v.name === 'id_picture'){
					com.find('.img_title').find('img').data('style',v.pictureshow||'normal');
				}
				if(v.filetype){
					com.data('typedata', v.filetype);
				}
			});
			//20160902 tanytree
			formItemSortable();//组件初始化后排序方法绑定一下
			addOptionDrag();//组件初始化后拖拽方法绑定一下
			//这里是个坑，注意
			serialSet();//这里调一一下id计算的方法，一定要调，否则id的大小会被干掉，从1开始。至于为什么，自己研究了。
			//alert(dlMain.formAnalysisList);
		}
	};
	// todo 'custom_elements'json变量在页面上打印的，当前文件没有这个变量
	if(custom_elements=='null'){
		return false;
	}else{
		//console.log(JSON.parse(custom_elements));
		_createFormViaJSON(JSON.parse(custom_elements));
	}
});
//组件信息json收集提交方法，此方法在页面中被调用
$("#actName h2").click(function(){
	componentlist();
})
function componentlist(){
	var jsonStringArray = [];
	$(".activeMod").find("ul li").each(function(){
		var $component = $(this),
			componentName = $component.attr("name"),
			jsonString = "{"+
				"\"name\":\""+componentName+"\","+
				"\"eid\":\""+$component.attr("id")+"\","+
				"\"title\":"+JSON.stringify(($component.find(".title").html()||'').replace(/[\r\n]/igm,'<br/>'))+","+
				"\"required\":"+ (!($component.find(".com_required").text().length == 0)) +","+
				"\"instruct\":"+JSON.stringify( _dlMarkParse((($component.find(".instruct").length)?$component.find(".instruct").html():'').replace(/[\r\n]/igm,'<br/>')))+",",
			options,flag = true;

		switch(componentName){
			case "id_code":
			case "id_city":
			case "id_email":
			case "id_id":
			case "id_phone":
			case "id_singleline":
			case "id_multiple":
				jsonString += "\"value\":"+JSON.stringify($component.find("input:text,textarea").val()||'');
				break;
			case "id_number":
				jsonString += "\"numtype\":"+JSON.stringify($component.find("input:text").attr('number-type')||'')+",";
				jsonString += "\"value\":"+JSON.stringify($component.find("input:text,textarea").val()||'');
				break;
			case "id_fileupload":
				jsonString += "\"imgnum\":"+JSON.stringify($component.data("imgnum")||"4")+",";
				jsonString += "\"value\":\"\"";
				break;
			case 'id_date':
				jsonString += "\"datetype\":\""+$component.find('.date').attr('datetype')+"\"";
				break;
			case "id_section":
					jsonString += "\"alignstyle\":"+JSON.stringify('text-align:'+$component.find('.subtitle').css('text-align'))+",";
					jsonString += "\"titlealignstyle\":"+JSON.stringify('text-align:'+$component.find('.title_field').css('text-align'))+",";
					jsonString += "\"subtitle\":" +JSON.stringify( _dlMarkParse($component.find(".subtitle").text().replace(/[\r\n]/igm,'<br/>')))+"";
				break;
			case "id_picture":
				var src = '';
				if($component.find('.title_field img').length >0){
					src = encodeURIComponent($component.find('.title_field img').attr('src'));
				}
				jsonString += "\"img\":"+JSON.stringify(src)+",";
				jsonString += "\"imglink\":"+JSON.stringify($component.find('.title_field').attr('img-link')||false)+",";
				jsonString += "\"alignstyle\":"+JSON.stringify('text-align:'+$component.find('.subtitle').css('text-align')||false)+",";
				jsonString += "\"pictureshow\":"+JSON.stringify($component.find('.img_title').find('img').data('style')||"normal")+",";
				jsonString +=  "\"subtitle\":" +JSON.stringify( _dlMarkParse($component.find(".subtitle").html().replace(/[\r\n]/igm,'<br/>')))+"";
				break;
			case "id_dropdown":
				options = [];
				$component.find("option").each(function(){
					if ($(this).attr("name") == "-1") {
						options.push(JSON.stringify({
							name: $(this).text(),
							selected: ($(this).attr("selected") == "selected"),
							lid: $(this).attr('listfield'),
						}));
					}else{
						options.push(JSON.stringify({
							name: $(this).text(),
							selected: ($(this).attr("selected") == "selected"),
							lid: $(this).attr('name')
						}));
					}
				});
				jsonString += "\"value\":["+options.join(",")+"]";
				break;
			case "id_picturecheckbox":
				options = [];
				if($component.data('__MGComponentSelect')){
					if($component.data('__MGComponentSelect').enable){
						jsonString += '"snumber":'+($component.data('__MGComponentSelect').number||'""')+',"stype":'+$component.data('__MGComponentSelect').type+',';
					}
				}
				$component.find(".picturecheckbox-item").each(function(){
					var $this = $(this),
						$_img = $this.find('.picc_img'),
						imgSrc = '';
					if($_img.length>0){
						imgSrc = encodeURIComponent($_img.attr('src'));
					}
					options.push(JSON.stringify({
						name: $this.find('span.optionValue').text(),
						selected: $this.find('input:first').attr('checked')=='checked',
						img: imgSrc,
						lid: $this.find('input:first').attr('value')
					}));
				});
				if($component.data('Logic_Setting')){
					jsonString += '"jump":'+JSON.stringify($component.data('Logic_Setting'))+',';
				}
				jsonString += '"value":['+options.join(',')+']';
				break;
			case "id_pictureradio":
				options = [];
				$component.find(".pictureradio-item").each(function(){
					var $this = $(this),
						$_img = $this.find('.picc_img'),
						imgSrc = '';
					if($_img.length>0){
						imgSrc = encodeURIComponent($_img.attr('src'));
					}
					options.push(JSON.stringify({
						name: $this.find('span.optionValue').text(),
						selected: $this.find('input:first').attr('checked')=='checked',
						img: imgSrc,
						lid: $this.find('input:first').attr('value')
					}));
				});

				jsonString += '"value":['+options.join(',')+']';
				break;
			case "id_checkbox":
			case "id_radio":
				options = [];
				//console.log($component.data('__MGComponentSelect'));
				if($component.data('__MGComponentSelect')){
					//console.log($component.data('__MGComponentSelect').enable);
					if($component.data('__MGComponentSelect').enable){
						jsonString += '"snumber":'+($component.data('__MGComponentSelect').number||'""')+',"stype":'+$component.data('__MGComponentSelect').type+',';
					}
				}
				if($component.data('layoutType')){
					jsonString += '"layout":'+JSON.stringify($component.data('layoutType'))+',';
				}else{
					jsonString += '"layout":'+1+',';
				}
				$component.find(".optionGarden>.optionsLine").each(function(){
					options.push(JSON.stringify({
						name: $(this).find("label").text(),
						selected: ($(this).find("input:first").attr("checked") == "checked"),
						lid: $(this).find("input:first").attr('value')
					}));
				});
				jsonString += "\"value\":["+options.join(",")+"]";
				break;

			default:
				flag = false;
				break;
		}
		jsonString +="}";
		if(flag){
			jsonStringArray.push(jsonString);
		}
	});
	strJson="{\"form\":{\"component\":["+jsonStringArray.join(",")+"]}}";
	$("#componentJsonStr").val(strJson);
	// todo 'dlMain.styleOption'json变量存在dlMain文件中，当前文件没有这个变量

	$("#componentStyleJsonStr").val(JSON.stringify(dlMain.styleOption));
	//console.log(strJson);
}
function _dlMarkEval(s){
	// 字符串转换成 html 的字符串
	var LINK_REG = /\[(.+?)]\(([^\(\)]*?)\)/g,
		LINK_TEST_REG = /^(file|gopher|news|nntp|telnet|http|ftp|https|ftps|sftp):\/\//;
	return s.replace(LINK_REG,function($0,$1,$2){

		var linkList = $.trim($2).split(' ');
		uriTest = (!LINK_TEST_REG.test(linkList[0])),
			newURI = '',
			tmpTitle = '';

		if(uriTest){
			return $0;
		} else {
			newURI = linkList[0].split("://");
			newURI = newURI[0]+'://'+encodeURIComponent(newURI[1]);
			if(linkList[1]){
				tmpTitle = 'title='+JSON.stringify(linkList[1]);
			}
		}
		return '<a link-save="'+newURI+'" target="_blank">'+$1+'</a>';
	});
}
function _dlMarkParse(s){
	// html 字符串 转换为 mark 形式
	var TAG_A_REG = /<a[^>]*link-save="([^"]*)"[^>]*>([^<>]*)<img[^>]*src="images\/icon\/externalLink.png"[^>]*><\/a>/gi;
	return s.replace(TAG_A_REG,function($,$1,$2){
		return '['+$2+']('+decodeURIComponent($1)+')';
	});
}
jQuery.extend({
	/**
	 * @see 将javascript数据类型转换为json字符串
	 * @param 支持object, array, string, function, number, boolean, regexp
	 * @return 返回json字符串
	 */

	toJSON: function(o) {

		var $specialChars = { '\b': '\\b', '\t': '\\t', '\n': '\\n', '\f': '\\f', '\r': '\\r', '"': '\\"', '\\': '\\\\' };
		var $replaceChars = function(chr) {
			return $specialChars[chr] || '\\u00' + Math.floor(chr.charCodeAt() / 16).toString(16) + (chr.charCodeAt() % 16).toString(16);
		};
		var s = [];
		switch ($.type(o)) {
			case 'undefined':
				return 'undefined';
				break;
			case 'null':
				return 'null';
				break;
			case 'number':
			case 'boolean':
			case 'date':
			case 'function':
				return o.toString();
				break;
			case 'string':
				return '"' + o.replace(/[\x00-\x1f\\"]/g, $replaceChars) + '"';
				break;
			case 'array':
				for (var i = 0, l = o.length; i < l; i++) {
					s.push($.toJSON(o[i]));
				}
				return '[' + s.join(',') + ']';
				break;
			case 'error':
			case 'object':
				for (var p in o) {
					s.push(p + ':' + $.toJSON(o[p]));
				}
				return '{' + s.join(',') + '}';
				break;
			default:
				return '';
				break;
		}
	}
});

$(window).load(function(){
	$("#anythingContent .mianMod").css("visibility","visible");
});