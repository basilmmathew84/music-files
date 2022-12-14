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
    padding-top: 3px;
    padding-bottom: 10px;
    height:510px;
}

.card {
    background-color: #fff;
    width: 500px;
    border-radius: 15px;
	height:auto;
	padding-bottom: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
.card h2{ font-weight:600; color:#764830 ;}

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
    border: 1.5px solid #eea838;
    color: #000;
    background-color: #eea83829;
}

.second {
    border-radius: 8px;
    border: 1px solid #acacb0;
    color: #000;
    background-color: #fff
}

.dot {}

.head {
    color: #000;
    font-size: 16px;
        font-weight: 600;
}

.dollar {
    font-size: 22px;
    color: #764830
}

.amount {
    color: #764830;
    font-weight: 600;
    font-size: 22px
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

             
<div class="container d-flex justify-content-center mt-3">
    <div class="main-body">

    <div class="card">
        <div>
		<form method="POST" action="{{ route('razorpay.verify.class') }}" accept-charset="UTF-8" name='razorpayform' id="razorpayform" class="form-horizontal">
            {{ csrf_field() }}
			<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
			<input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
			<input type="hidden" name="order_id"  id="order_id" value="">
            <div class="d-flex pt-3 pl-3">
                <div><img src="/images/visa-icon.png" width="auto" height="32" /></div>
                <div class="pl-2">      <h2>{{$user->name}} </h2>
                </div>
            </div>

            @if($isSuperAdmin)
            <div class="py-2 px-3">
                <div class="second py-2">
                <div class="form-check">
            </div>
                    <div class="pl-2 pr-2"><span class="head">Student</span>
                        <div class="d-flex">
                            <select name="student_user_id" id="student_user_id" class="form-control">
                                <option value="" >Select</option>
                                @foreach ($students as  $student)
				                    <option value="{{$student->id}}" @if($id == $student->id) selected="selected" @endif >{{$student->name}}</option>
			                    @endforeach
                            </select>
                        </div>
                    </div>
				 </div>
				<div>
					{!! $errors->first('student_user_id', '<p class="text-danger">:message</p>') !!}
				</div>
            </div>
            @endif
           
            <div class=" px-3">
                <div class="firstpy-2">
                    <div class="pl-2 pr-2"><span class="head">Total credits</span>
                        <div>
                            <span class="dollar">{{ $user->symbol}}</span>
                            <span class="amount" id="amount">{{ $user->credits}}</span>
                        </div>

                        <div id="divAmountInr" style="display:none">
                            <span class="amountInr">???</span>
                            <span class="amount" id="amountInr">{{$user->credits}}@if($user->credits == "") 0.00 @endif</span>
                        </div>
                    </div>
                </div>
            </div>

                     
            <div class="py-2 px-3">
                <div class="first py-2">
                  
                    <div class="pl-2 pr-2"><span class="head">Total amount due</span>
                        <div>
                            <span class="dollar">{{ $user->symbol}}</span>
                            <span class="amount" id="payment"><!--{{$payment}}-->0.00</span>
                        </div>

                        <div id="divPaymentInr" id="divAmountInr" style="display:none">
                            <span class="amountInr">???</span>
                            <span class="amount" id="paymentInr">0.00</span>
                        </div>
                    </div>
                </div>
            </div>
            
 
            <div class="py-2 px-3">
                  <div class="second py-2">
                    <input type="hidden" name="one_class_fee_dump" id="one_class_fee_dump" value="{{ $user->class_fee }}">
                    <input type="hidden" name="one_class_fee_dump" id="one_class_fee_inr_dump" value="">
                    <div class="pl-2 pr-2"><span class="head">No of classes</span>
                        <div class="d-flex">
                            <select id="no_of_classes" name="no_of_classes" class="form-control " required="true">
                                <option value="">--Select--</option>
                                <?php for($i=1;$i<=10;$i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
				 </div>
				<div>
                    <span id="no_class_fee_msg">
                    @if($user->class_fee == 0) <p class="text-danger">The course fee for the student has not updated</p>  @endif
                    </span>
					{!! $errors->first('no_of_classes', '<p class="text-danger">:message</p>') !!}
				</div>
            </div>

            <div class="py-2 px-3">
                <div class="second py-2">
                  
                    <div class="pl-2 pr-2"><span class="head">Pay amount</span>
                        <div class="d-flex"><span class="dollar"  style="padding-top:5px;">{{ $user->symbol}}</span>
						    <input type="text" id="class_fee" name="class_fee" class="form-control" required="true" readonly placeholder="0">
						</div>

                        <div  id="divClassfee" style="display:none">
                            <span class="amountInr"></span>
                            <span class="amount" id="class_feeInr">{{$user->credits}}@if($user->credits == "") 0.00 @endif</span>
                        </div>
                    </div>
				</div>
				<div>
					{!! $errors->first('class_fee', '<p class="text-danger">:message</p>') !!}
				</div>
            </div>
            <div class="d-flex justify-content-between px-3  ">
                <div class="col-md-offset-2 col-md-10 p-0">  
                    <input class="btn btn-primary" type="button" id="rzp-button1" value="{{ trans('users.paynow') }}">
                </div>
            </div>
		</form>
        </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@if(!$isSuperAdmin)
<script>
 var SITEURL = '{{URL::to('')}}';
 $('document').ready( function(e){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$("#rzp-button1").click(function(){
		
		var amount = $('#class_fee').val();
		var no_of_classes = $('#no_of_classes').val();
		if(no_of_classes == ""){
			alert("please select No of classes")
		}else{
			var postData = {"class_fee":amount,"no_of_classes":no_of_classes}
			
			$.ajax({
				type: "post",
				url: "{{ route('razorpay.ajax') }}",
				data: postData,
				contentType: "application/x-www-form-urlencoded",
				success: function(responseData, textStatus, jqXHR) {
					document.getElementById('order_id').value = responseData.notes.merchant_order_id;
					var options = responseData;
					options.amount = (parseFloat($('#class_feeInr').html()))*100;
					options.description = "Class ("+ $('#no_of_classes').val() +") Fees",
					options.handler = function (response){
						document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
						document.getElementById('razorpay_signature').value = response.razorpay_signature;
						document.getElementById('razorpayform').submit();
					};
					options.modal = {
						ondismiss: function() {
							
							//console.log("This code runs when the popup is closed");
						},
						// Boolean indicating whether pressing escape key 
						// should close the checkout form. (default: true)
						escape: false,
						// Boolean indicating whether clicking translucent blank
						// space outside checkout form should close the form. (default: false)
						backdropclose: false
					};
					var rzp1 = new Razorpay(options);
					rzp1.open();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				}
			})
		}			
		
		
	});
 });
</script>
@else
<script>
 var SITEURL = '{{URL::to('')}}';
 $('document').ready( function(e){
	$("#rzp-button1").click(function(){
		 document.getElementById('razorpayform').submit();
	});
 });
</script>
@endif

<script>
 

 $('document').ready( function(e){

	
	$("#rzp-button11").click(function(){
		
		
		var options = "";
		options.amount = ($('#class_fee').val())*100;
		options.description = "Class ("+ $('#no_of_classes').val() +") Fees",
        options.handler = function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.getElementById('razorpayform').submit();
        };
        options.modal = {
            ondismiss: function() {
                
                //console.log("This code runs when the popup is closed");
            },
            // Boolean indicating whether pressing escape key 
            // should close the checkout form. (default: true)
            escape: false,
            // Boolean indicating whether clicking translucent blank
            // space outside checkout form should close the form. (default: false)
            backdropclose: false
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
	});
 });
</script>
<script type="text/javascript">
    var one_class_fee;
    
    $(document).ready(function() {
            
            var amount          =   '<?php echo $user->credits; ?>';
            var code            =   '<?php echo $user->code; ?>';
            var mode_remittance =   '<?php echo $user->mode_of_remittance; ?>';
            var symbol          =   '<?php echo $user->symbol; ?>';
            var user_code       =   '<?php echo $user->code; ?>';
            if(mode_remittance == 'Indian'){
                
                showAmount(amount,'credits',symbol);
                var payment = '<?php echo $payment; ?>';
                showAmount(payment,'payment',symbol);
                one_class_fee = '<?php echo $user->class_fee;?>';
                showAmount(one_class_fee,'one_class_fee',symbol);
                
                if(code != "INR")
                {
                    to         =  'INR'
                    from       =  code;
                    //currencyConverter(to,from,amount,'credits',symbol,mode_remittance);
                    var payment = '<?php echo $payment; ?>';
                    //currencyConverter(to,from,payment,'payment',symbol,mode_remittance);
                    var class_fee = '<?php echo $user->class_fee;?>';
                    currencyConverter(to,from,amount,payment,class_fee,'one_class_fee',symbol,mode_remittance);

                }
            }else if(mode_remittance == "International"){
                    showAmount(amount,'credits',symbol);
                    var payment = '<?php echo $payment; ?>';
                    showAmount(payment,'payment',symbol);
                    one_class_fee = '<?php echo $user->class_fee;?>';
                    showAmount(one_class_fee,'one_class_fee',symbol);
                    clearCurrencyINR();
            }
            


            function showAmount(amount,mode,symbol)
            {
                if(mode == 'credits'){
                    $("#amount").html(amount);
                }
                if(mode == 'payment'){
                    $("#payment").html(amount);
                }
                if(mode == 'one_class_fee'){
                    one_class_fee   =   amount;
                }
                $(".dollar").html(symbol);
            }

            function clearCurrencyINR()
            {
                $("#amountInr").html('');
                $("#divAmountInr").hide();
                $("#paymentInr").html('');
                $("#divPaymentInr").hide();
                $(".amountInr").html('');
                $("#divClassfee").hide();
                $("#class_feeInr").html('');
            }

            $("#no_of_classes").change(function(){
                one_class_fee     =     $("#one_class_fee_dump").val();
                one_class_fee_inr =     $("#one_class_fee_inr_dump").val();
                var no_of_classes =     parseInt($(this).val());
                var class_fee     =     one_class_fee*no_of_classes;
                var class_fee_inr =     one_class_fee_inr*no_of_classes;
                class_fee_inr     =     class_fee_inr.toFixed(2);
                $("#class_fee").val(class_fee);
                if(mode_remittance == "Indian" && user_code != 'INR'){
                        $("#divClassfee").show();
                        $(".amountInr").html('???')
                        $("#class_feeInr").html(class_fee_inr);
                        //$("#class_feeInr").html('');
                    }else{
                        clearCurrencyINR();
                    }
            });
            
    });

    
    function currencyConverter(to,from,credit,payment,one_class_fees,mode,symbol,remittance ="")
            {
                amount     = 1;
                endpoint   = 'convert'
                access_key = '0d0b39254cefb941a64f7838ba522781';
                // get the most recent exchange rates via the "latest" endpoint:
                $.ajax({
                    url: 'https://data.fixer.io/api/' + endpoint + '?access_key=' + access_key + '&from=' + from + '&to=' + to + '&amount=' + amount,
                    dataType: 'jsonp',
                    success: function(json) {
                    
                       if(json.result){
                        dues  = json.result;
                        }else{
                        dues  = 0.00;
                        }

                    if(remittance == "Indian"){
                        currencyINR(dues,mode,symbol,credit,payment,one_class_fees);
                    }else{
                        clearCurrencyINR();
                    }
                    }
                });
                }
           
            function currencyINR(amount,mode,symbol,credit,payment,one_class_fees)
            {
                //if(mode == 'credits'){
                    credit      =   amount * credit;
                    $("#amountInr").html(credit.toFixed(2));
                    $("#divAmountInr").show();
                //}
                //if(mode == 'payment'){
                    payment      =   parseFloat(amount) * parseFloat(payment);
                    $("#paymentInr").html(payment.toFixed(2));
                    $("#divPaymentInr").show();
                //}
                //if(mode == 'one_class_fee'){
                    //one_class_fee_inr   =   amount;
                    one_class_fee_inr   =   parseFloat(amount) * parseFloat(one_class_fees);
                    $("#one_class_fee_inr_dump").val(one_class_fee_inr);
                    
                 //}
                $(".amountInr").html('???');
            }            
</script>
@stop



        