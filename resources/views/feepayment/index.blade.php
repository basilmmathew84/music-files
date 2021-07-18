@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">{{ trans('users.fee_collection') }}</h1>
     
@stop
<style>

body {
    background-color: #ffffff
}

.container {
    width: 600px;
   /* background-color: #fff;*/
    padding-top: 100px;
    padding-bottom: 100px
}

.card {
    background-color: #fff;
    width: 300px;
    border-radius: 15px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

.name {
    font-size: 15px;
    color: #403f3f;
    font-weight: bold
}

.cross {
    font-size: 11px;
    color: #b0aeb7
}

.pin {
    font-size: 14px;
    color: #b0aeb7
}

.first {
    border-radius: 8px;
    border: 1.5px solid #78b9ff;
    color: #000;
    background-color: #eaf4ff
}

.second {
    border-radius: 8px;
    border: 1px solid #acacb0;
    color: #000;
    background-color: #fff
}

.dot {}

.head {
    color: #137ff3;
    font-size: 12px
}

.dollar {
    font-size: 18px;
    color: #097bf7
}

.amount {
    color: #007bff;
    font-weight: bold;
    font-size: 18px
}

.form-control {
    font-size: 18px;
    font-weight: bold;
    width: 60px;
    height: 28px
}

.back {
    color: #aba4a4;
    font-size: 15px;
    line-height: 73px;
    font-weight: 400
}

.button {
    width: 150px;
    height: 60px;
    border-radius: 8px;
    font-size: 17px
}
</style>
@section('content')

    @if(Session::has('success_message') or Session::has('error_message'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {!! session('success_message') !!}
            {!! session('error_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
    @if(Session::has('error_message'))
        <div class="alert alert-danger">
            <i class="fas fa-check-circle"></i>
            {!! session('error_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

<div class="container d-flex justify-content-center mt-5">
    <div class="card">
        <div>
		<form method="POST" action="{{ route('feepayment.fee.update',$user->id) }}" accept-charset="UTF-8" id="update_fee_form" name="update_fee_form" class="form-horizontal">
            {{ csrf_field() }}
            @method("PUT")
            <div class="d-flex pt-3 pl-3">
                <div><img src="https://img.icons8.com/ios-filled/50/000000/visa.png" width="60" height="80" /></div>
                <div class="mt-3 pl-2"><span class="name">{{$user->name}}</span>
                    <div><span class="cross">&#10005&#10005&#10005&#10005</span><span class="pin ml-2">8880</span></div>
                </div>
            </div>
            <div class="py-2 px-3">
                <div class="first pl-2 d-flex py-2">
                    <div class="form-check"> </div>
                    <div class="border-left pl-2"><span class="head">Total credits</span>
                        <div><span class="dollar">{{$user->symbol}}</span><span class="amount">{{$user->credits}}</span></div>
                    </div>
                </div>
            </div>
            <div class="py-2 px-3">
                <div class="first pl-2 d-flex py-2">
                    <div class="form-check"> <input type="radio" name="optradio" class="form-check-input mt-3 dot" checked> </div>
                    <div class="border-left pl-2"><span class="head">Total amount due</span>
                        <div><span class="dollar">{{$user->symbol}}</span><span class="amount">{{($payment * $user->class_fee) }}</span></div>
                    </div>
                </div>
            </div>
            <div class="py-2 px-3">
                <div class="second pl-2 d-flex py-2">
                    <div class="form-check"> <input type="radio" name="optradio" class="form-check-input mt-3 dot"> </div>
                    <div class="border-left pl-2"><span class="head">Pay amount</span>
                        <div class="d-flex"><span class="dollar">{{$user->symbol}}</span>
						<input type="text" name="class_fee" class="form-control ml-1" required="true" placeholder="0">
						</div>
                    </div>
					
                </div>
				<div>
					{!! $errors->first('class_fee', '<p class="text-danger">:message</p>') !!}
				</div>
            </div>
            <div class="d-flex justify-content-between px-3 pt-4 pb-3">
            <div class="col-md-offset-2 col-md-10">  
              <input class="btn btn-primary" type="submit" value="{{ trans('users.update') }}">
              <a href="{{ URL::to('feepay')}}" type="button" class="btn btn-default">{{ trans('users.back') }}</a>
            </div>
            </div>
		</form>
        </div>
    </div>
</div>

@endsection
@section('js')
@stop