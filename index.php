<!DOCTYPE html>
<html>
    <head>
        <title> Chatting app
        </title>
        <link rel="shortcut icon" href="fav%20icon.png" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="/socket.io/socket.io.js"></script>
        
<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
        <i class="em em-some-emoji"></i>
        <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4gLwOK09nYiW8NH98qZ5QlX2blfix1HU";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
        <style>
            body{
                margin-top: 50px;
                background-color:lightgrey;
            }
            #messageArea{
                
               display: none;
            }
            h1{
            
                color: silver;
                text-shadow:white 2px 2px 0px 3px;
                background-color: whitesmoke;
                border:solid 1px ;
                border-color: ghostwhite;
                text-align: center;
                margin: 100px;
                border-radius: 5px;
                font-style: italic;
                font-style: oblique;
                font-family: cursive;
            }
           
            .chat{
                height: 250px;
                
                overflow-y: scroll;
                display: grid;
                
                
            }
            /*chat background and color*/
            .zebra{
                background-color: white;
                color: brown;
                
            }
            .mod{
                color: gold;
                background-color: cornsilk;
            }
            .username-font{
                font-size: 20px;
            }
            label{
                color: dodgerblue;
            }
            .greenyellow{
                background-color:white;
                border-color:ghostwhite;
            }
            h3{
                color: green
            }
            li{
                color: red;
            }
            
            ::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
        </style>
    </head>
    <body>
        <h1>
            Welcome to Dream Chat Space
        </h1>
        <div class="container ">
            <div id="userFormArea" class="row">
                <div class="col-md-12">
                    <form id="userForm">
                        <div class="form-group">
                            <label>Enter Username:</label>
                            <input class="form-control greenyellow" id="userName" placeholder="please enter your username"/>
                            <br />
                            <input type="submit" class="btn btn-primary" value="Login"/>
                            
                        </div>
                    </form>
                
                </div>
            </div>
            
            <div class="chatter">
            <div id="messageArea" class="row ">
                <div class = "col-md-4">
                    <div class="well greenyellow">
                        <h3 >Online Users</h3>
                        <ul class="list-group" id="users"></ul>
                    </div>
                </div>
                <div class ="col-md-8">
                    <div class="chat" id="chat"></div>
                    <form id="messageForm">
                        <div class="form-group">
                            <label>Enter a message</label>
                            <textarea class="form-control greenyellow" id="message" placeholder="please enter your message here"></textarea>
                            <br />
                            <input type="submit" class="btn btn-primary " value="send message"/>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>    
        
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>
       -->
        
        <script>
  
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
                var owner =$('#userName').val();
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
                
                
                socket.on('new message',function(data){
                    if($.trim(owner) == 'Diaa'){
                             $chat.append('<div class="well mod "><strong> <span class="username-font ">'+data.user+'</span>:</strong>'+data.msg+'</div>')
                    }
                    
                    else{
                    $chat.append('<div class="well zebra "><strong> <span class="username-font">'+data.user+'</span>:</strong>'+data.msg+'</div>')
                    }
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
            if($.trim(owner) == 'Diaa')
                console.log('diaa');
        </script>
        
    </body>
</html>
