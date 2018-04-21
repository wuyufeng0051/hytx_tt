	///****************图片**********************/
		// name_pic=1;
		function t1(o){
			if(o==1 || name_pic!=1){
			var file="file"+o;
			var img="img"+o;
			var hid="hidden"+o;
			var hidimg = "hidimg"+o;
			var aa="a"+o;
			}else{

			var file="file"+name_pic;
			var img="img"+name_pic;
			var hid="hidden"+name_pic;
			var hidimg="hidimg"+name_pic;
			var aa="a"+name_pic;
			}
			var docObj = document.getElementById(file);
			var imgObjPreview = document.getElementById(img);
			var hidden=document.getElementById(hid);
			var hidimg=document.getElementById(hidimg);
			// alert(hidden);
			if (docObj.files && docObj.files[0]) {
				hidden.src=window.URL.createObjectURL(docObj.files[0]); //获取file文件的路径
				hidden.onload=function(){
					var width=hidden.width;
					var height=hidden.height;
					var a=document.getElementById(aa);
						if(width>height){
						imgObjPreview.style.cssText='width:100%';	//重写css样式
						}else{
						imgObjPreview.style.cssText='height:100%;width:auto;';					
						}
				imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);

				var reader = new FileReader();
                reader.readAsDataURL(docObj.files[0]);
                reader.onload = function(e){
                	var mb = (e.total/1024)/1024;
					if(mb>= 2){
						layer.msg('图片超过2M');
						return;
					};
				//画布方式压缩图片质量和物理文件大小
					var img = document.createElement("img");
						img.src = this.result;

					//图片一旦加载完就执行
					img.onload = function(){
						width = img.naturalWidth;
						height = img.naturalHeight;
						if(width > 10000){
							width = width/16;
							height = height/16;
							img.width =width;
							img.height = height;

						}
						//创建画布
						canvas = document.createElement("canvas"),
						drawer = canvas.getContext("2d");
						//设置画布高度
						canvas.width = width;
						canvas.height = height;

						drawer.drawImage(img, 0, 0 ,canvas.width,canvas.height);
						src = canvas.toDataURL("image/jpeg", 0.6);
						
						// hidimg.attr('src',src);

                       hidimg.value=src;
					  

				}
			}

				imgObjPreview.style.display = 'block';


				}
			}else{
				return false;
			}
			if(o==name_pic){
				var count=$('.pro_img').length;
				if(count<10){
				name_pic++;
			var pic_div="<div><a class='pro_img' id='a"+name_pic+"' ><input type='file' id='file"+name_pic+"'  accept='image/*' multiple='multiple' runat='server' capture='camera' name='pic[]' onchange='t1("+name_pic+")'/><img src='http://www.bdniao.com/Public/Home/img/upload.jpg' id='img"+name_pic+"'></a><img  id='hidden"+name_pic+"' style='display:none;'><input class='pic_new' type='hidden' id='hidimg"+name_pic+"'></div>";
			$('#upload').append(pic_div); 
			var pcWidth=$('#upload').width()
		    var picImg=pcWidth/3-10;
		    $(".pro_img").width(picImg);
		    $(".pro_img").height(picImg);
			}		
		}
	}
	//
	var pcWidth=$('#upload').width()
    var picImg=pcWidth/3-10;
    $(".pro_img").width(picImg);
    $(".pro_img").height(picImg);
