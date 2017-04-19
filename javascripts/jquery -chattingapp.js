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
                        if($message == ""){
                             alert("Please write something in mes.");
                   
                        }
                        else{ 
                    e.preventDefault();
                    socket.emit('send message',$message.val());
                    $message.val('');
                          }
                        }
                    });
                        
                    $messageForm.submit(function(e){
                    e.preventDefault();
                    socket.emit('send message',$message.val());
                    $message.val('');
                        
                });
       
                        var owner = '(Owner) Diaa',admin='Mostafa(Admin)',password= prompt('please enter your password if you are a mod or admin if you aint press okay Thanks ;)');
                
                    socket.on('new message',function(data){
                        
                        if (data.user == owner || data.user== admin)
                            {
                            
                            if(password == 336933){
                                switch(data.user){
                                case '(Owner) Diaa':
                             $chat.append('<div class="well mod"><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>');
                                break;
                                case 'Mostafa(Admin)':
                             $chat.append('<div class="well mod"><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>');
                                break;
                                default:$chat.append('<div class="well mod"><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>');
                                    break;
                                            }
                                
                                }
                            else
                                    $chat.append('<div class="well zebra"><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>');
                                    
                                
                                
                            }
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
                        html += '<li class=list-group-item red">'+data[i]+'</li>';
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
            