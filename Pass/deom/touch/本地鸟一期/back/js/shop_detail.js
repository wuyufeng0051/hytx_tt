$(function(){
	// 顶部图片展示
	var mySwiper = new Swiper('.swiper-container', {
		loop : false,
		pagination: '.swiper-pagination',
		paginationType: 'fraction',
	})
	// 商家介绍tab切换
	$('.intro_tab .intor_lead ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('il_bc').siblings().removeClass('il_bc');
		$('.intor_list .intor_txt').eq(index).show().siblings().hide();
	})

	// 联系方式弹出层
	$('.tel').click(function(){
		$('.phone').show();
		$('.disk').show();
	})
	$('.close').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})
	$('.disk').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})

	// 分享引导弹出层
	$('.share').click(function(){
		$('.share_box').show();
		$('.disk').show();
	})
	$('.share_box').click(function(){
		$('.share_box').hide();
		$('.disk').hide();
	})

    // 微信联系方式弹出层
	$('.wei').click(function(){
		$('.QR_code').show();
		$('.disk').show();
	})
	$('.disk').click(function(){
		$('.QR_code').hide();
		$('.disk').hide();
	})

    // 地图弹出层
    $('.dao').click(function(){
        var t = $(this);
        $('.map').addClass('show').animate({"left":"0"},200);
    })
    $('.map .back , .map .sure').click(function(){
         var t = $(this);
        $('.map').animate({"left":"100%"},200);
        $('body').removeClass('by');
    })
    $('.dao').click(function(){
        var dom = $('.map')
        if (dom.hasClass('show')) {
            $('body').addClass('by')
        }else{
            $('body').removeClass('by')
        }
    })

    // 百度地图API功能
//     var map = new BMap.Map('allmap');
//     var poi = new BMap.Point(116.307852,40.057031);
//     map.centerAndZoom(poi, 16);
//     map.enableScrollWheelZoom();

//     var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
//                     '<img src="../upfile/baidu.png" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>' +
//                     '地址：北京市海淀区上地十街10号<br/>电话：(010)59928888<br/>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部。' +
//                   '</div>';

//     //创建检索信息窗口对象
//     var searchInfoWindow = null;
//     searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
//             title  : "百度大厦",      //标题
//             width  : 290,             //宽度
//             height : 105,              //高度
//             panel  : "panel",         //检索结果面板
//             enableAutoPan : true,     //自动平移
//             searchTypes   :[
//                 BMAPLIB_TAB_SEARCH,   //周边检索
//                 BMAPLIB_TAB_TO_HERE,  //到这里去
//                 BMAPLIB_TAB_FROM_HERE //从这里出发
//             ]
//         });
//     var marker = new BMap.Marker(poi); //创建marker对象
//     // marker.enableDragging(); //marker可拖拽
//     marker.addEventListener("click", function(e){
//         searchInfoWindow.open(marker);
//     })
//     map.panBy(305,300);
//     map.addOverlay(marker); //在地图中添加marker

})



	// 点击图片放大预览
  	var initPhotoSwipeFromDOM = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements 
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes 
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) { 
                continue; 
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');  
            if(pair.length < 2) {
                continue;
            }           
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            fullscreenEl : false,
            //点击图片关闭
            tapToClose: true,

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
    };

	// execute above function
	initPhotoSwipeFromDOM('.my-gallery');
	initPhotoSwipeFromDOM('.intor_pic');

	// 自动定义图片data-size
	window.onload=function(){
		auto_data_size();
	};
	function auto_data_size(){
		var imgss= $("figure img");
		$("figure img").each(function() {
		var imgs = new Image();
		imgs.src=$(this).attr("src");
		var w = imgs.width,
		h =imgs.height;
		$(this).parent("a").attr("data-size","").attr("data-size",w+"x"+h);
		})
	};


