/* CHAT */
 (function () {

    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.img = arg.img;
        this.name = arg.name;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($('.message_template').clone().html());
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $message.find('.userPhoto').attr("src", _this.img);
                $message.find('.userName').addClass("small d-block ml-1").html(_this.name);
                $('.list').append($message);
                return setTimeout(function () {
                    return $message.addClass('');
                }, 0);
            };
        }(this);
        return this;
    };
    $(function () {
        var getMessageText, message_side, sendMessage;
        message_side = 'right';
        getMessageText = function () {
            var $message_input;
            $message_input = $('.message_input');
            return $message_input.val();
        };
        sendMessage = function (text, img, user, name) {
          if(user == user_id){
            message_side = "sent";
          }
          else{
            message_side = "replies";
          }
          if(img == null){
            img ='resources/img/undraw/gold-undraw_male_avatar_323b.svg';
          }
          console.log("img: " + img);
            var $messages, message;
          
            $('.message_input').val('');
            $messages = $('.messages');
            imgUrl = baseUrl + "/" + img;
            message = new Message({
                text: text,
                img: imgUrl,
                name: name,
                message_side: message_side
            });
            message.draw();

            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
        };
        $('.send_message').click(function (e) {
              saveMessage(getMessageText(),userPhoto,user_id, user_name);
           // return sendMessage(getMessageText());
        });

        $('.message_input').keyup(function (e) {
            if (e.which === 13) {
              saveMessage(getMessageText());
                //return sendMessage(getMessageText());
            }
        });
        setInterval(function(){
         updateMessageList(); 
        }, 5000);  




 function saveMessage(mensaje) {
  if($.trim(mensaje) == '') {
    return false;
  }
  url = baseUrl + '/api/chat';
  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    method:"POST",
    data:{_token: '{!! csrf_token() !!}',user_id:user_id, user_id:user_id, clase_id, message:mensaje, lastMessage: lastMessage},
    success:function(response) {
     var length = response.length;
     length--;
     lastMessage = response[length].created_at;
     console.log(lastMessage);
     for (var i=0; i<response.length; i++) {
       sendMessage(response[i].mensaje, response[i].user.foto, response[i].user.id, response[i].user.name);
      }
    }
  }); 
}

 function updateMessageList() {
  console.log('updating...');
  url = baseUrl + '/api/chat';
  $.ajax({
    url: url,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    method:"GET",
    data:{_token: '{!! csrf_token() !!}',user_id:user_id, user_id:user_id, clase_id, lastMessage: lastMessage},
    success:function(response) {
     var length = response.length;
     length--;
     console.log(length);
     if(length >= 0){
           lastMessage = response[length].created_at;
           console.log(lastMessage);
           for (var i=0; i<response.length; i++) {
             sendMessage(response[i].mensaje, response[i].user.foto, response[i].user.id, response[i].user.name);
            }
     }
    
    }
  }); 
}



        /*
        sendMessage('Hello Philip! :)');
        setTimeout(function () {
            return sendMessage('Hi Sandy! How are you?');
        }, 1000);
        return setTimeout(function () {
            return sendMessage('I\'m fine, thank you!');
        }, 2000);*/
    });



}.call(this)); 
 /* ./CHAT */ 

