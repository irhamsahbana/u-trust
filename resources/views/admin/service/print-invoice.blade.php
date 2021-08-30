<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>U-Trust | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
           PT. Hadji Kalla (Kalla Toyota) 
          <small class="float-right">Date: {{ Carbon\Carbon::parse(now())->format('d/m/Y') }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Service Advisor
        <address>
          <strong>{{ Auth::user()->name }}</strong><br>
          Phone: {{ Auth::user()->phone }}<br>
          Email: {{ Auth::user()->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Customer
        <address>
          <strong id="customer_plate"></strong><br>
          Phone: <span id="customer_phone"></span><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        {{-- <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567 --}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th rowspan="2" class="align-middle" style="width: 30%;">Item Spare Part, Material & Sublet</th>
              <th rowspan="2" class="align-middle" style="width: 20%;">Nomor Part / Material</th>
              <th rowspan="2" class="align-middle" style="width: 10%;">Price (IDR)</th>
              <th colspan="2" style="width: 10%;">Kelipatan 10K</th>
              <th colspan="2">kelipatan 20K</th>
              <th colspan="2">Kelipatan 40K</th>
              <th colspan="2">kelipatan 80K</th>
            </tr>
            <tr>
              <th>QTY</th>
              <th>Rupiah</th>
              <th>QTY</th>
              <th>Rupiah</th>
              <th>QTY</th>
              <th>Rupiah</th>
              <th>QTY</th>
              <th>Rupiah</th>
            </tr>
          </thead>
          <tbody>
      
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        {{-- <p class="lead">Payment Methods:</p>
        <img src="{{ asset('assets') }}/dist/img/credit/visa.png" alt="Visa">
        <img src="{{ asset('assets') }}/dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="{{ asset('assets') }}/dist/img/credit/american-express.png" alt="American Express">
        <img src="{{ asset('assets') }}/dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> --}}
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due {{ Carbon\Carbon::parse(now())->format('d/m/Y') }}</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">SUB TOTAL PART/MATERIAL/SUBLET</th>
              <td id="sub_total"></td>
            </tr>
            <tr>
              <th>JASA (<span id="service_price"></span> x <span id="rate"></span>)</th>
              <td id="service_rate_total"></td>
            </tr>
            <tr>
              <th>MATERAI (<span id="stamp_label"></span> x <span id="stamp_qty"></span>)</th>
              <td id="stamp_total"></td>
            </tr>
            <tr>
              <th>TOTAL</th>
              <td id="total"></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function(){

        //localstorage data
        let inv = JSON.parse(window.localStorage.getItem('invoice_data'));
        console.log(inv);
        
        $('#customer_plate').html(inv.customer_plate);
        $('#customer_phone').html(inv.customer_phone);
        
        $('#sub_total').html(inv.sub_total);
        
        $('#service_price').html(inv.service_rate.service_price);
        $('#rate').html(inv.service_rate.rate);
        $('#service_rate_total').html(inv.service_rate.total);

        $('#stamp_label').html(inv.stamp.label);
        $('#stamp_qty').html(inv.stamp.qty);
        $('#stamp_total').html(inv.stamp.total);

        $('#total').html(inv.total);
    });
</script>
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
