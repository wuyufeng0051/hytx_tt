 function submit(){
      var have = $('.pic_new')
      var all ="";
      $.each(have,function(index,item){
      var srcnew = $(this).attr('src')
             all += srcnew+"&"; 
      })
         // alert(all)
      $('#picnew').val(all); 
    }

/****************图片**********************/
	$(document).ready(function(e) {
   $('#file1').localResizeIMG({
      width: 440,
      quality: 0.8,
      success: function (result) {  
          var submitData={
                base64_string:result.clearBase64, 
            }; 
        $.ajax({
           type: "POST",
           url: "http://www.bdniao.com/index.php/Home/Demo/addimg",
           data: submitData,
           binary:"json",
           success: function(data){
           	   // alert(data)
           	    $(".addproimg").before('<div><div class="pic_newbox"><img class="pic_new" style="width:100px;height:100px;" src="http://www.bdniao.com/Public/../'+data+'">'
                  +'<div class="delpic" sty="0"></div>'
                  +'<img class="delete_icon delpic" src="http://www.bdniao.com/Public/Home/img/delete_pic.png" style="width:20px;" sty="0">'
                  +'</div></div>')
           	    delpiconly()
           	    numberall()
             }
        }); 
      }
  });
  });

//限制图片
function  numberall(){
	 var all = 0;
	 var have = $('.pic_newbox')
	 $.each(have,function(index,item){
          all +=1;
	 })
 
	 if (all > 5) {
	 	// alert(2)
	 	 $(".addproimg").hide();
	 }else{
	 	 $(".addproimg").show();

	 }
}

//删除图片
function delpiconly(){
$(".delpic").click(function(){
   var imgs_id = $(this).attr('sty');
   var _this = $(this);
    // 判断是否已经存在
	  if (imgs_id == 0) {
 	   var ss = $(this).parent().parent().find('.pic_newbox').remove();
	   numberall()
     }else{
          var existencedel = $('#existencedel').val();
          // alert(existencedel)
          var existencedelnew = existencedel+"&"+imgs_id;
          $('#existencedel').val(existencedelnew);
           var ss = $(this).parent().parent().find('.pic_newbox').remove();
           numberall()
     }
 	 })
}

// function existdel(){
//   var existencedel = $('#existencedel').val();
//   $.post('http://www.bdniao.com/index.php/Home/Demo/deletepic', {existencedel:existencedel}, function(data) {
//           // alert(data)
//            if (data == 1) {
//              _this.parent().parent().find('.pic_newbox').remove();
//              numberall()
//            }
//        });    
// }


// [词典]
 
numberall()

delpiconly()