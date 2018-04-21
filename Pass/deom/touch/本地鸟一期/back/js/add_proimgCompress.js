  function submit(){
	    var have = $('.pic_new')
	    var all ="";
    	$.each(have,function(index,item){
    	var srcnew = $(this).attr('src')
             all += srcnew+"&"; 
    	})
 
    	$('#picnew').val(all); 

}

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
                  +'<div class="delpic"></div>'
                  +'<img class="delete_icon delpic" src="http://www.bdniao.com/Public/Home/img/delete_pic.png">'
                  +'</div></div>')
           	    delpiconly()
           	    numberall()
             }
        }); 
      }
  });
  });

function  numberall(){
	 var all = 0;
	 var have = $('.pic_new')
	 $.each(have,function(index,item){
          all +=1;
	 })
	 // alert(all)
	 if (all > 5) {
	 	// alert(2)
	 	 $(".addproimg").hide();
	 }else{
	 	 $(".addproimg").show();

	 }
}

function delpiconly(){
$(".delpic").click(function(){
  var ss = $(this).parent().parent().find('.pic_newbox').remove();
   numberall()
   // alert(ss)
})
 
 }