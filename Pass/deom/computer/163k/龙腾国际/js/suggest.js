$(function() {
            $(":submit").click(function() {
              if ($(":input[name='info[ask_text]']").val() == '') {
                alert('留言内容必须填写！');
                return false;
              }
            })
          })