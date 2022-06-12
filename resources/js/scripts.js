
      $(document).ready(function(){
        scroll_messages();
        upload();
        setInterval(upload, 5000);

        $('#search-conversation').on('keyup', function(){
          $('.found-one-user').remove();
          search($(this).val());
        });

      })

      // show profile details
      $(document).ready(function(){
        profile = 'показать профиль';
        $('#user-info').css({'display':'none'});
        $('#show-user-info').click(function(){
           $(this).next('#user-info').slideToggle(500);
           profile = 'скрыть профиль';
        });
      });

      function scroll_messages(){
          $("#messages").scrollTop(99999);
      }

      // send new text-message
      $(document).ready(function(){
        $('#new-message-text').on('keydown', function(e){
          if(e.ctrlKey && e.keyCode == 13)
          {
            e.preventDefault();
            caretStart = this.selectionStart;
            caretEnd = this.selectionEnd;
            this.value = (this.value.substring(0, caretStart)
                          + "\n"
                          + this.value.substring(caretEnd));
          }
          else if(e.keyCode === 13) {
            e.preventDefault();

            if($("#new-message-text").val())
            {
              formData = new FormData();
              formData.append('text', $("#new-message-text").val());
              formData.append('conv_id', $("#conversation-id").val());
              send_message(formData, 'messages', "/ajax/text_load.php");

              $('#new-message-text').val('');
              scroll_messages();
            }
          }
        });

        $('#message-send-button').click(function(){
          if($("#new-message-text").val())
          {
            formData = new FormData();
            formData.append('text', $("#new-message-text").val());
            formData.append('conv_id', $("#conversation-id").val());
            send_message(formData, 'messages', "/ajax/text_load.php");

            $('#new-message-text').val('');
            scroll_messages();
          }
        });
      });

      // load file to conversation
      $(document).ready(function(){
        $('#clip').on('click', function(){
          $('#file').click();
        });
        $('#file').change(function(){
          formData = new FormData();
          formData.append('file', $("#file")[0].files[0]);
          formData.append('conv_id', $("#conversation-id").val());
          send_message(formData, 'messages', "/ajax/file_load.php");
          scroll_messages();
        });
      });

      function send_message(data, responseBlock, url)
      {
        $.ajax({
          url: url,
          method: "post",
          dataType: 'text',
          data: data,
          cache: false,
          contentType: false,
			    processData: false,
          processData: false,
          success: function(response)
          {
            if(response != false)
            {
              $('#' + responseBlock).append(response);
              scroll_messages();
            }
          }
        })
      }

      function upload()
      {
        messages = $('#messages').find('.message');
        last_message = messages.last();
        id = last_message.find('.message-id').val();
        conv_id = $('#conversation-id').val();

        $.ajax({
          url: "/ajax/upload.php",
          method: "post",
          dataType: 'text',
          data: { id: id, conv_id: conv_id },
          success: function(response)
          {
            if(response != false)
            {
              $('#messages').append(response);
              scroll_messages();
            }
          }
        })
      }

      function search(login_part)
      {
        if(login_part == '') return 1;
        $.ajax({
          url: "/ajax/search.php",
          method: "post",
          dataType: 'text',
          data: { login: login_part},
          success: function(response)
          {
            if(response != false && response != null)
            {
              response = JSON.parse(response);
              console.log(response);
              if(response.constructor === Array){
                $.each(response, function(index, data){
                  $('#found-users').append('<div class="found-one-user">' + data.login  +
                  '<form class="add-conversation" action="/new_conversation" method="post">' +
                    '<input hidden name="id" type="text" value="' + data.id + '">' +
                    '<input type="submit">' +
                  '</form></div>');
                });
              }
              else {
                $('#found-users').append('<div class="found-one-user">' + response.login  +
                '<form class="add-conversation" action="/new_conversation" method="post">' +
                  '<input hidden name="id" type="text" value="' + response.id + '">' +
                  '<input type="submit">' +
                '</form></div>');
              }
            }
          }
        })
      }

      $(document).ready(function(){
        /*$(".download-form").click(function(){
          file = $(this).children(".path").val();
          $.ajax({
            url: 'ajax/download_file.php',
            method: "post",
            dataType: 'text',
            data: {file : file},
            cache: false });
        })*/


        $(".image").hover(function(){
          form = $(this).children('form');
          submit = form.children('.download');
          submit.show();
          //submit.animate({ opacity: 0.8 }, 270);
        },
        function(){
          form = $(this).children('form');
          submit = form.children('.download');
          //submit.animate({ opacity: 0 }, 270);
          submit.hide();
        });




      })
