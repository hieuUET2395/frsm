export default class {
    constructor(app) {
        this.app = app;
        this.window = app.window;
        this.jQuery = app.jQuery;
    }

    init() {
        this.listenMessage();
        this.saveMessage();
    }

    listenMessage() {
        const $ = this.jQuery;
        $(() => {
            var boxChat = $('.box-chat');
            boxChat[0].scrollTop = boxChat[0].scrollHeight;
            
            Echo.join('chatroom')
            .listen('MessagePosted', (e) => {
                boxChat.append(e.message);
                boxChat[0].scrollTop = boxChat[0].scrollHeight;
            });
        });
    }

    saveMessage() {
        const $ = this.jQuery;
        $(() => {
            $('.input-group-addon').on('click', '#interview-message-send', function (event) {
                event.preventDefault();
                var url = $(this).data('url');
                var message = $('.message-content').val();
                var room_id = $('.room-id').val();
                $.post(
                    url, 
                    {
                        message : message,
                        room_id : room_id,
                    }, 
                    function(data) {
                        $('.message-content').val('');
                    }
                )
                .fail(function(data) {
                    boxChat.append('Error send message');
                });
            });
        });
    }
}
