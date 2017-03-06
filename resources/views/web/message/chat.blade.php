@foreach ($messages as $message)
    <div class="user">
        <span class="message">{{ $message->content }}</span>
        <br>
        <span class="author-message"><b>{{ $message->user->name }}</b></span>
    </div>
@endforeach
