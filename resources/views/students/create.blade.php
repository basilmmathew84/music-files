@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">{{ trans('students.create') }}</h1>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('students.student.index') }}" class="btn btn-primary" title="{{ trans('students.show_all') }}">
            <i class="fas fa-list-alt"></i>
        </a>
    </div>
@stop

@section('content')

    <div class="panel panel-default">

<div class="card card-primary card-outline">
    <div class="card-body">

        <div class="panel-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('students.student.store') }}" accept-charset="UTF-8" id="create_user_form" name="create_user_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('students.form', [
                                        'user' => null,
                                        'files' => true
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('users.add') }}">
                        <a href="{{ URL::to('students/students')}}" type="button" class="btn btn-default">{{ trans('students.back') }}</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
                $(function () {
                    $('#dob').datepicker({
                        format: "dd-mm-yyyy",
                        autoclose: true,
                        todayHighlight: true, 
                    });
                });
                $( document ).ready(function() {
                    $(".sidebar").height(1295);  
                });
               

</script>
