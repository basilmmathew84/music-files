@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">{{ !empty($user->name) ? $user->name : 'User' }}</h1>
  
@stop

@section('content')

    <div class="panel panel-default">
    <div class="card card-primary card-outline">
    <div class="card-body">
        <div class="panel-body">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('profiles.profile.update', $user->id) }}" id="edit_student_form" name="edit_student_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('profiles.edit_form', [
                                        'user' => $user,
                                      ])

                    <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('students.update') }}">
                        <a href="{{ URL::to('profile/profile')}}" type="button" class="btn btn-default">{{ trans('users.back') }}</a>
                    </div>
                    
                </div>
            </form>
 </div> </div>
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
                        orientation: "auto"
                    });
                });
</script>