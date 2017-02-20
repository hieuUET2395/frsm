@push('css')
<link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/jquery-ui/themes/smoothness/jquery-ui.min.css') }}">
@endpush

@extends('layouts.web.main')

@section('content')

<div class="col-md-9" id="content">
    <div class="row">
        <div id="top">
            @lang('messages.locale')
            <select id='locale-selector'></select>
        </div>
        <div id='calendar' data-url="{{ action('Web\ScheduleController@getEvents') }}"></div>
        <div id="fullCalModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                        <h4 id="modalTitle" class="modal-title"></h4>
                        <p>@lang('messages.time') : <span id="startTime"></span></p>
                        <p>@lang('messages.room') : <span id="room"></span></p>
                    </div>
                    <div class="modal-body" id="modalBody">
                        {{ trans_choice('messages.candidate', 1) }}:
                        <p><a class="btn btn-link" id="candidate" target="_blank"></a></p>
                        <p>@lang('messages.round') : <span id="round"></span></p>
                        <div id="description"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            @lang('messages.close')
                        </button>
                        <a class="btn btn-primary" id="roomUrl" target="_blank">
                            @lang('messages.join_interview_room')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('bower_components/fullcalendar-scheduler/dist/scheduler.min.js') }}"></script>
<script src="{{ asset('bower_components/fullcalendar/dist/locale-all.js') }}"></script>
@endpush
