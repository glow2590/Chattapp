
            $(function(){
                var socket = io.connect();  
                var $messageForm = $('#messageForm');
                var $message = $('#message');
                var $chat = $('#chat');
                var $messageArea = $('#messageArea');
                var $userFormArea = $('#userFormArea');
                var $userForm = $('#userForm');
                var $users = $('#users');
                var $userName = $('#userName');
                
                    $messageForm.keyup(function(e){
                    if(e.keyCode == 13){
                    e.preventDefault();
                    socket.emit('send message',$message.val());
                    $message.val('');
                        }
                    });
                        
                    $messageForm.submit(function(e){
                    e.preventDefault();
                    socket.emit('send message',$message.val());
                    $message.val('');
                        
                });
                console.log($users);
                

       
                
                    socket.on('new message',function(data){
                        var owner = data.user;
                          if(owner== 'Diaa')
                
                             $chat.append('<div class="well mod"><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>');
        
                    
                                 
              
                else 
                     
                    
                             $chat.append('<div class="well zebra"><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>');
                
                });
                    
                    
                    $userForm.submit(function(e){
                    window.setInterval(function() {
  var elem = document.getElementById('chat');
  elem.scrollTop = elem.scrollHeight;
}, 2500);
                    e.preventDefault();
                    socket.emit('new user',$userName.val(),function(data){
                        if (data){
                            $userFormArea.hide();
                            $messageArea.show();
                        }
                    });
                    $userName.val('');
                    
                });
                
                socket.on('get users',function(data){
                    var html = '';
                    for(i = 0 ;i < data.length;i++){
                        html += '<li class=list-group-item">'+data[i]+'</li>';
                    }
                    $users.html(html);
                });
                
            
            
            function reconnect() {
    console.log('Connection lost, trying to reconnect...');
    $.ajax({
        url:dreamchatspace.azurewebsites.net,
        success: function() {
            //Server is back online
            socket = new WebSocket(myUrl);
            socket.onerror = onErrorHandler;
            socket.onmessage = onMessageHandler;
            socket.onopen = onOpenHandler;
            socket.onclose = onCloseHandler;
        },
        error: function() {
            //Server is still down
            setTimeout(function() {
                reconnect();
            }, 1000);
        }
    });
}
            });
            
  