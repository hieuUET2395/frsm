<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href={{ action('Web\HomeController@index') }}>{{ trans('messages.title') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
            <li><a href="#" id="header-toggle-nav"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                <li class="dropdown">
                    <a href="{{ action('Web\CandidateController@index') }}">
                        {{ trans_choice('messages.candidate', 2) }}
                    </a>
                </li>
                <li>
                    <a href="{{ action('Web\UserController@index') }}">
                        {{ trans_choice('messages.employee', 2) }}
                    </a>
                </li>
                <li><a href="#">{{ trans_choice('messages.schedule', 2) }}</a></li>
                <li><a href="#">@lang('messages.statistic')</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control"
                                   placeholder="{{ trans('messages.search_placeholder') }}" style="border-radius: 20px;" size="20">
                        </div>
                    </form>
                </li>
                <li>
                    <a href="{{ action('Web\SettingController@index') }}"><i class="fa fa-cog" aria-hidden="true"></i> @lang('messages.setting')</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ trans_choice('messages.user', 1) }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-user" aria-hidden="true"></i>
                                @lang('messages.profile')
                            </a>
                        </li>
                        <li>
                            @include('layouts.web._logout')
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
