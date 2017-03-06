import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: $('meta[name="pusher-key"]').attr('content')
});
