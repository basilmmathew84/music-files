@extends('adminlte::auth.register-page', ['auth_type' => 'music'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')





<h3>REGISTER WITH MUSICSHIKSHAN</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('registration.store') }}" accept-charset="UTF-8" id="create_user_form" name="create_user_form" class="form-horizontal">
    {{ csrf_field() }}
    {{-- Name field --}}

    @include ('students_reg.form', [
    'user' => null,
    'files' => true
    ])

    <div class="form-group">
        <div class="col-md-12 text-center">
            <input class="btn btn-primary" type="submit" value="Register">
            <a href="{{ URL::to('login')}}" type="button" class="btn btn-default">Cancel</a>
        </div>
    </div>

</form>
<p class="my-0">
    <a href="{{ $login_url }}">
        {{ __('adminlte::adminlte.i_already_have_a_membership') }}
    </a>
</p>





@stop

@section('auth_footer')




<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col text-center">
            <h5><i class="uil uil-estate"></i>'Madhavam', Elavakkat Nagar, Thrikkakara,  Eranakulam 682021</h5>
                <h5><i class="uil uil-forwaded-call"></i> <a href="tel: +91 9495 400 124">+91 8590577026</a> ,
                    <a href="tel: +91 8547307308"> +91 9495400124</a>
                </h5>
                <h5> <i class="uil uil-envelope"></i> <a href="mailto:hello@musicshikshan.com">hello@musicshikshan.com</a></h5>
                <div class="social-icons">
                    <li> <a href="https://www.facebook.com/DevSudhiMusic?ref=hl" class="facebook" title="Facebook" target="blank"><i class="uil uil-facebook"></i></a></li>
                    <li> <a href="https://www.linkedin.com/home?trk=nav_responsive_tab_home" class="linkedin" title="Linked in" target="blank"><i class="uil uil-linkedin"></i></a></li>
                    <li> <a href="https://twitter.com/musicshikshan01" class="twitter" title="Twitter" target="blank"><i class="uil uil-twitter"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UC7XDOEMWnK_zwIpRzyNuDpQ" class="youtube" title="You Tube" target="blank"><i class="uil uil-youtube"></i></a></li>
                    </ul>

                </div>
                <p class="mt-4">Copyright ?? musicshikshan 2021</p>
            </div>
        </div>
    </div>
</div>
@stop


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#dob').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
        });
    });
    $(document).ready(function() {
        $(".sidebar").height(1295);
    });
</script>