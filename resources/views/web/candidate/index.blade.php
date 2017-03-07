@push('css')
<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css">
{!! Html::style(mix('css/candidate/table.css')) !!}
@endpush

@extends('layouts.web.main')

@section('content')
<div class="col-md-9" id="content">
    <div class="pull-left">
        <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>
            @lang('messages.add')
        </a>
    </div>
    <div class="pull-right">
        <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-export"></span>
            @lang('messages.export')
        </a>
    </div>
    <div class="col-md-12"></div>
    <div class="row">
        <div class="panel panel-primary table-filterable table-filterable-candidate col-md-12"
             data-url="{{ action('Web\CandidateController@filter') }}">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans_choice('messages.candidate', 2) }}</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-reset-filters">
                        <span class="glyphicon glyphicon-repeat"></span>
                        {{ trans('messages.reset_filters') }}
                    </button>
                </div>
            </div>
            <div class="table candidates">
                <table class="table candidates">
                    <thead>
                    <tr class="filters table-filterable-inputs">
                        <input name="reset" id="reset" type="hidden" title="reset" value="0">
                        <th>
                            {{ trans('messages.name') }}
                            <input name="name" type="text" id="name" class="form-control" title="name">
                        </th>
                        <th>
                            {{ trans('messages.email') }}
                            <input name="email" type="text" class="form-control" title="email">
                        </th>
                        <th>
                            {{ trans('messages.position') }}
                            {{ Form::select('position', $positions, null, [
                                 'placeholder' => trans('messages.all'),
                                 'class' => 'position',
                            ]) }}
                        </th>
                        <th>
                            {{ trans('messages.phone') }}
                            <input name="phone" type="text" id="phone" class="form-control" title="phone">
                        </th>
                        <th>
                            {{ trans('messages.cv_file') }}
                        </th>
                        <th>
                            {{ trans('messages.status') }}
                            {{ Form::select('status', $statuses, null, [
                                 'placeholder' => trans('messages.all'),
                                 'class' => 'form-control',
                            ]) }}
                        </th>
                        <th>
                            {{ trans('messages.created_at') }}
                            <input name="date" type="month" id="date" class="form-control" title="date">
                        </th>
                    </tr>
                    </thead>
                    <tbody class="result">
                        @include('web.candidate.filter')
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('/bower_components/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(".position").select2({
        theme: "bootstrap"
    });
</script>
@endpush
