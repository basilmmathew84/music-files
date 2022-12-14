@extends('adminlte::page')
@section('content_header')
<h1 class="m-0 text-dark">{{__('dashboard.title')}}</h1>
@stop

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<section class="content">
  <div class="container-fluid">

    <!-- Students Registration fee -->
    @if(Session::has('success_message') or Session::has('error_message'))
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i>
          {!! session('success_message') !!}
          {!! session('error_message') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
      </div>
    </div>
    @endif
    @if(Session::has('error_message'))
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="alert alert-danger">
          <i class="fas fa-check-circle"></i>
          {!! session('error_message') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
      </div>
    </div>
    @endif
    @unlessrole('super-admin|admin|student|tutor')
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Pay your registration fee

            </h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body p-0 table-responsive">
            <br />
            <form method="POST" action="{{ route('regfee.paynow') }}" accept-charset="UTF-8" id="paynow" name="paynow" class="form-horizontal">
              {{ csrf_field() }}
              @method("POST")
              <div class="form-group">
                <div class="col-md-12 text-center">
                  Fees : <span id="fees">INR <?php echo $fee_pay;?></span>

                  <input class="form-control" name="regfee" type="hidden" id="regfee" value="">
                  <input class="form-control" name="inr_regfee" type="hidden" id="inr_regfee" value=<?php echo $fee_pay;?>>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 text-center">
                  <input class="btn btn-primary" type="submit" value="Continue">
                  @if($registration_fee_type == "Paid")
                  <div class="col-md-12 text-center">
                    Note:- Please continue, your regisrtration fee will be added to your first fee payment.
                  </div>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endunlessrole
    <!-- Students Registration fee -->

    <!-- Small boxes (Stat box) -->

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

@stop

@section('js')
<!-- <script>
  $(document).ready(function() {
    // set endpoint and your access key
    endpoint = 'convert'
    from = 'INR'
    to = '<?php echo $student_currency; ?>'
    amount = $("#inr_regfee").val()
    access_key = '0d0b39254cefb941a64f7838ba522781';
    if (amount > 0) {
      // get the most recent exchange rates via the "latest" endpoint:
      $.ajax({  
        url: 'https://data.fixer.io/api/' + endpoint + '?access_key=' + access_key + '&from=' + from + '&to=' + to + '&amount=' + amount,
        dataType: 'jsonp',
        success: function(json) {
          regfee = json.result.toFixed(2)
          $("#fees").html(to + ' ' + regfee);
          $("#regfee").val(regfee);
        }
      });
    }else{
      $("#fees").html(to + ' ' + '0.00');
      $("#regfee").val(0);
    }
  });
</script> -->
@stop