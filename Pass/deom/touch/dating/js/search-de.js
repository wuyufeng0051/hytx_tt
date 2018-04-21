$(function(){
    // 关注
    $('.zan').click(function(){
        var  x = $(this);
        if (x.hasClass('xin')) {
            x.removeClass('xin');
        }else{
            x.addClass('xin');
        }
    })
    // 基本资料全文
    $('.introduce span').click(function(){
        var  x = $(".introduce-txt");
        if (x.hasClass('height')) {
            x.removeClass('height');  
        }else{
            x.addClass('height');
            $('.introduce span').hide();
            $('.introduce i').show();
        }
    })

    $('.introduce i').click(function(){
        var  x = $(".introduce-txt");
        if (x.hasClass('height')) {
            x.removeClass('height');
            $('.introduce i').hide();
            $('.introduce span').show();     
        }else{
            x.addClass('height');
        }
    })

    // 发私信
    $('.sea-infor span,.first-nic').click(function(){
        var x = $(this);
        var box = $('.txt') 
        if (box.css('display') == 'none'){
            $('.txt').show();
            $('.disk').show();
        }else {
            $('.txt').hide();
            $('.disk').hide();
        }
    })
    $('.disk,.txt p').click(function(){
        $('.txt').hide();
        $('.disk').hide();
    })
    // 打招呼
    $('.second-nic').click(function(){
        var x = $(this);
        var dom = x.closest('.second-nic')
        dom.find('.op').hide();
        dom.find('.do').show();
        $('.zhaohu').show();
        setTimeout(function(){$('.zhaohu').hide()},1000);
    })
    // 列表body置顶
    $('.sea-infor span,.first-nic').click(function(){
        var dom = $('.txt')
        if (dom.css('display') == 'none'){
            $('body').removeClass('by')
        }else{
            $('body').addClass('by')
        }
    })
    $('.disk,.txt p').click(function(){
        var dom = $('.disk')
        if (dom.css('display') == 'none'){
            $('body').removeClass('by')
        }else{
            $('body').addClass('by')
        }
    })
    // 点关注
     $('.last-nic').click(function(){
        var  x = $(this);
        if (x.hasClass('guanzhu')) {
            x.removeClass('guanzhu');
        }else{
            x.addClass('guanzhu');
        }
    })


// 分享
$('.return b').click(function(){
    $('#shearBox').css('bottom','0');
    $('#shearBox .bg').css({'height':'100%','opacity':1});
})

// 分享取消
$('#cancelShear').click(function(){
    closeShearBox();
})
$('#cancelcode').click(function(){
    closecodeBox();
})

// 分享点击遮罩层
$('.shearBox .bg, .zhiyin .bg').click(function(){
    closeShearBox();
    closecodeBox();
    $('.zhiyin').hide();
    $('.zhiyin .bg').css({'height':'0','opacity':0});
})

// 分享二维码
$('.jiathis_button_code').click(function(){
  $('#shearBox').css('bottom','-100%');
  $('#codeBox').css('bottom','0');
  var code = masterDomain+'/include/qrcode.php?data='+encodeURIComponent(window.location);
  $('#codeBox img').attr('src', code);
})

// 分享右上角
$('.jiathis_button_tweixin, .jiathis_button_ttqq, .jiathis_button_comment').click(function(){
  closeShearBox();
  $('.zhiyin').show();
  $('.zhiyin .bg').css({'height':'100%','opacity':1});
})


function closeShearBox(){
        $('#shearBox').css('bottom','-100%');
        $('#shearBox .bg').css({'height':'0','opacity':0});
    }
    function closecodeBox(){
        $('#codeBox').css('bottom','-100%');
        $('.shearBox .bg').css({'height':'0','opacity':0});
    }



	// 图片浏览
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
})