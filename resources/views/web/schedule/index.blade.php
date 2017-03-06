@extends('layouts.web.main')
@section('content')
    <div class="container-fluid">
        <div class="row" id="interview-content">
                <div class="col-md-6 content-left">
                    <div id="candidate">
                        <div id="info-cadidate">
                            <span>{{ trans('interview.gerneralInfomation') }}</span>
                            <table class="table">
                                <tr>
                                    <td>{{ trans('interview.fullName') }}</td>
                                    <td>{{ $schedule->candidate->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('interview.position') }}</td>
                                    <td>{{ $schedule->candidate->position->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('interview.profileCv') }}</td>
                                    <td>@include('web.schedule._modal_cv', ['cv_file' => $schedule->candidate->cv_file])</td>
                                </tr>
                            </table>
                        </div>
                        <div class="interview-evaluate-candidate">
                           {!! Form::open([
                                'action' => ['Web\ScheduleController@update', $schedule->id],
                                'role' => 'form',
                                'id' => 'form-evaluate-candidate',
                                'method' => 'PUT',
                            ]) !!}
                                <div id="msg-submit-evaluate">
                                </div>
                                <table class="table score-candidate">
                                        <tr class="score-candidate-title">
                                            <th>{{ trans('interview.field') }}</th>
                                            <th>{{ trans('interview.score') }}</th>
                                            <th>{{ trans('interview.delete') }}</th>
                                        </tr>
                                        <tr class="score-candidate-content">
                                            <td> 
                                                <select name="field" class="interview-evaluate-field">
                                                <option value="0" data-max="5">
                                                    {{ trans('interview.chooseField') }}
                                                </option>
                                                    @foreach ($fieldsNotEvaluated as $field)
                                                        <option value="{{ $field->id }}" data-max="{{ $field->max_score }}">
                                                            {{ $field->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                        <!-- if exits fields evaluated print, combine add + edit -->
                                        {{-- @if (count($fieldEvaluated) != 0)  --}}
                                            @foreach ($schedule->fields as $field)
                                                <tr>
                                                    <td>{{ $field->name }}</td>
                                                    <td>
                                                        <input 
                                                            step="0.1" 
                                                            size="2" 
                                                            data-max="{{ $field->max_score }}" 
                                                            name="field[{{ $field->id }}]" 
                                                            type="number" 
                                                            requied=""
                                                            value= "{{ $field->pivot->score }}" >
                                                        / <span id="max-score">{{ $field->max_score }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="delete-field"
                                                            data-id="{{ $field->id }}"
                                                            data-name={{ $field->name }}
                                                            data-max={{ $field->max_score }} >
                                                        {{ trans('interview.remove') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        {{-- @endif --}}
                                        <!-- end  -->
                                </table>
                                <label for="">{{ trans('interview.review') }}</label>
                                 {{ Form::textarea('evaluation', $schedule->evaluation , [
                                        'class' => 'form-control', 
                                        'row' => 3,
                                 ]) }}
                                {!! Form::submit(trans('interview.send'), ['class' => 'btn btn-info']) !!}
                                {!! Form::close() !!}
                            </div> 
                    </div>
                </div>
                <div class="col-md-3 content-right">
                    <div id="msg-submit-note">
                    </div>
                    <div class="interview-note">
                    <div class="title-note">{{ trans('interview.NoteTitle') }}
                        <a href="#" id="btn-edit-note">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <div id="list-note">
                        {!! setting('note') !!}
                    </div>
                    <div id="edit-note">
                        {!! Form::open([
                            'action' => ['Web\SettingController@update', 'note'],
                            'role' => 'form',
                            'method' => 'PUT'
                        ]) !!}
                            {{ Form::textarea('value', setting('note') , [
                                'class' => 'form-control textarea-tinymce',
                                'row' => 3,
                            ]) }}
                            {{ Form::submit('Save', [
                                'id' => 'save-note',
                                'class' => 'btn btn-info',
                            ]) }}
                        {{ Form::close() }}
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    <div class="panel panel-default chat">
                        <div class="panel-heading">
                            {{ __('interview.chat') }}
                        </div>
                        <div class="box-chat">
                            @include('web.message.chat', ['messages' => $schedule->messages])
                        </div>
                        <div class="panel-footer clearfix">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control message-content" placeholder="Type your message">
                                    <input type="hidden" class="room-id" value="{{ $schedule->id }}">
                                    <input type="hidden" class="user-id" value="{{ Auth::id() }}">
                                        <div class="input-group-addon">
                                        <a href="#" id="interview-message-send" data-url="{{ action('Web\MessageController@store') }}">
                                            {{ __('interview.sendMessage') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@stop
