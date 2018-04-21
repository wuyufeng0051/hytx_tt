$(function(){

  $('.top-tit').click(function(){
    var t = $(this), dropdown = $('.dropdown'), arrow = $('.arrow');
    if (dropdown.css('display') == "none") {
      dropdown.show(); arrow.show();
    }else {
      dropdown.hide(); arrow.hide();
    }
    return false;
  })

  // 选择搜索模块
  $('#dropdown li').click(function(){
    var t = $(this), val = t.text(), url = t.attr('data-url'), name = t.attr('data-name');
    $('.top-tit').html(val);
    $('.dropdown, .arrow').hide();
    $('.formbox').attr('action', url);
    $('.searchbtn').attr('name', name);

  })

  $(document).click(function(){
    $('.dropdown').hide(); $('.arrow').hide();
  })

  // 历史记录
  if(window.localStorage){  //或者 window.sessionStorage
      console.log("浏览支持localStorage")
  }else{
      alert("浏览暂不支持localStorage")
  }

  //从localStorage获取搜索时间的数组
  var hisTime;
  //从localStorage获取搜索内容的数组
  var hisItem;
  //从localStorage获取最早的1个搜索时间
  var firstKey;

  function init (){
    //每次执行都把2个数组置空
    hisTime = [];
    hisItem = [];
    //模拟localStorage本来有的记录
    //localStorage.setItem("b",12333);
    //本函数内的两个for循环用到的变量
    var i=0;
    for(;i<localStorage.length;i++){
      if(!isNaN(localStorage.key(i))){
        hisTime.push(localStorage.key(i));
      }
    }

    if(hisTime.length>0) {
      hisTime.sort();
      for (var y = hisTime.length-1; y>0; y--) {
        localStorage.getItem(hisTime[y]).trim()&&hisItem.push(localStorage.getItem(hisTime[y]));
      }
    }

    i=0;
    //执行init(),每次清空之前添加的节点
    $("#list").html("");
    for(;i<hisItem.length;i++){
      $("#list").prepend('<li><i></i><p>'+hisItem[i]+'</p></li>')
    }
  }
  init();

  $(".formbox").submit(function(){
    var value = $(".searchbtn").val();
    var time = (new Date()).getTime();

    if(!value){
      alert("你未输入搜索内容");
      return false;
    }
    //输入的内容localStorage有记录
    if($.inArray(value,hisItem)>=0){
      for(var j = 0;j<localStorage.length;j++){
        if(value==localStorage.getItem(localStorage.key(j))){
          localStorage.removeItem(localStorage.key(j));
        }
      }
      localStorage.setItem(time,value);
    }
    //输入的内容localStorage没有记录
    else{
      //由于限制了只能有6条记录，所以这里进行判断
      if(hisItem.length>4){
        firstKey = hisTime[0]
        localStorage.removeItem(firstKey);
        localStorage.setItem(time,value);
      }else{
        localStorage.setItem(time,value)
      }
    }
    init();
  });

  //清除记录功能
  $(".del").click(function(){
    var f = 0;
    for(;f<hisTime.length;f++){
      localStorage.removeItem(hisTime[f]);
    }
    init();
    window.location.reload();
  });


  $('#list li').click(function(){
    var t = $(this), val = t.find('p').text();
    $('.searchbtn').val(val);
    $(".formbox").submit();
  })



})
