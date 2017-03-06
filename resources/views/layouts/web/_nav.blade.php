<div class="col-md-3 sidebar">
    <ul class="list-group">
        <li id="title">
            <a href="#">
                <i class="fa fa-list" aria-hidden="true"></i> <b>List Category</b>
            </a>
        </li>
        <li id="parent-list-group">
            <a href="#">Uninterview Cadidates <span class="badge text-info">12</span></a>
            <ul id="sub-list-group">
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 1</a></li>
            </ul>
        </li>
        <li id="parent-list-group">
            <a href="#">{{ trans_choice('messages.employee', 2) }} <span class="badge text-info">12</span></a>
            <ul id="sub-list-group">
                <li><a href="{{ action('Web\UserController@index') }}">{{ trans('messages.list') }}</a></li>
                <li><a href="{{ action('Web\UserController@create') }}">{{ trans('messages.create') }}</a></li>
                <li><a href="#">Item 1</a></li>
            </ul>
        </li>
        <li id="parent-list-group">
            <a href="#">Uninterview Cadidates <span class="badge text-info">12</span></a>
            <ul id="sub-list-group">
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 1</a></li>
            </ul>
        </li>
    </ul>
</div>
