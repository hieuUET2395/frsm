@push('css')
{!! Html::style(mix('css/user/table.css')) !!}
@endpush

@extends('layouts.web.main')

@section('content')
    <div class="col-md-9" id="content">
        <div class="row">
            <div class="panel panel-primary table-filterable table-filterable-user col-md-12"
                 data-url="{{ action('Web\UserController@filter') }}">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans_choice('messages.employee', 2) }}</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span
                                    class="glyphicon glyphicon-filter"></span>{{ trans('messages.filter') }}</button>
                    </div>
                </div>
                <div class="table user">
                    <table class="table">
                        <thead>
                        <tr class="filters table-filterable-inputs">
                            <th>
                                {{ trans('messages.name') }}
                                <input name="name" type="text" id="name" class="form-control">
                            </th>
                            <th>
                                {{ trans('messages.email') }}
                                <input name="email" type="text" id="email" class="form-control">
                            </th>
                            <th>
                                {{ trans('messages.position') }}
                                {{ Form::select('position', $positions, null, [
                                     'placeholder' => trans('messages.all'),
                                     'class' => 'form-control'
                                ]) }}
                            </th>
                            <th>{{ trans('messages.action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="result">
                        @include('web.user.filter')
                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <div id="permission" class="modal fade permission-popup" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-content-permission" data-loading="{{ trans('messages.loading') }}"></div>
        </div>
    </div>
@endsection
