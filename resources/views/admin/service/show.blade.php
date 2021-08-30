 @extends('admin.layout')

@push('css')
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
    .form-group {
      margin-bottom: 0px;
    }
    td {
      padding: 6px !important;
    }
    thead {
      background-color: #343a40;
      color: aliceblue;
      border: 1px solid black;
      border-collapse: collapse;
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      z-index: 2;
    }
    /* th{
      border: 2px solid black !important;
    } */
  </style>
@endpush

@section('content')


<!-- mulai disini content nya -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Service</a></li>
              <li class="breadcrumb-item active">{{ $series->series_name }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
       <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title"><b>{{ $series->series_name }} Services</b></h3>
                      <a class="btn btn-primary float-right ml-2" role="button" href="#" id="print_page">Print page</a>
                      {{-- <a class="btn btn-primary float-right" role="button" href="{{ route('service.invoice') }}" target="_blank" id="print_invoice">Print</a> --}}
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body">
                      <div class="container">
                        <div class="row">
                          <div class="col-sm">
                            <div class="form-group mb-2">
                              <strong>
                                Service Advisor : {{Auth::user()->name}}
                              </strong>
                            </div>
                            <div class="form-group mb-2">
                              <strong>
                                Phone Number : {{Auth::user()->phone}}
                              </strong>
                            </div>
                          </div>
                          <div class="col-sm">
                            <div class="from-group mb-3">
                              <b class="d-inline">Customer Plate License : </b><input type="text" id="cstm_licence_plate" placeholder="Customer Plate Number" style="width: 200px">
                            </div>
                            <div class="from-group mb-3">
                              <b>Customer Phone Number : </b><input type="number" id="cstm_phone" placeholder="Costumer Phone Number" style="width: 200px">
                            </div>
                          </div>
                          <div class="col-sm">
                            <div class="from-group mb-3">
                              {{-- <a class="btn btn-primary" role="button" href="">Print</a> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th rowspan="2" class="align-middle">Item Spare Part, Material & Sublet</th>
                            <th rowspan="2" class="align-middle">Nomor Part / Material</th>
                            <th rowspan="2" class="align-middle">Price (IDR)</th>
                            <th colspan="2">Kelipatan 10K</th>
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
                          @foreach($product as $pr)
                            <tr class="non-active-product" id="product_row{{ $pr->id }}">
                              <td data-toggle="modal" data-target="#detail{{ $pr->id }}">{{ $pr->product_name }}</td>
                              <td>
                                <div class="form-group">
                                  <select id="product_id{{ $pr->id }}" name="" class="form-control select2-detail">
                                    <option value="0" selected>-- Choose One --</option>
                                    @foreach($product_variety as $prv)
                                      @if($prv->product_id == $pr->id)
                                        <option value="{{ $prv->price }}">{{-- ({{ $prv->product->product_name }}) --}}{{$prv->no_part_or_material}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td id="price{{$pr->id}}" class="product_price">0</td>
                              <td>
                                <div class="form-group">
                                  <select id="qty10_{{ $pr->id }}">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td id="price10_{{ $pr->id }}" class="price">0</td>
                              <td>
                                <div class="form-group">
                                  <select id="qty20_{{ $pr->id }}">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td id="price20_{{ $pr->id }}" class="price">0</td>
                              <td>
                                <div class="form-group">
                                  <select id="qty40_{{ $pr->id }}">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td id="price40_{{ $pr->id }}" class="price">0</td>
                              <td>
                                <div class="form-group">
                                  <select id="qty80_{{ $pr->id }}">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td id="price80_{{ $pr->id }}" class="price">0</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td colspan="8"><strong>SUB TOTAL PART/MATERIAL/SUBLET</strong></td>
                            <td colspan="3"><strong id="total_product_price" class="sub_total_price">0</strong></td>
                          </tr>
                          <tr>
                            <td colspan="3"><strong>JASA</strong></td>
                            <td colspan="3"><strong id="service_price">{{ $series->service_price }}</strong></td>
                            <td colspan="2" class="text-center">
                              <input type="number" min="0" name="" id="service_hour" value="0" style="width: 90px;">
                            </td>
                            <td colspan="3"><strong id="total_treatment_price" class="sub_total_price">0</strong></td>
                          </tr>
                          <tr>
                            <td colspan="3"><strong>MATERAI</strong></td>
                            <td colspan="3" class="text-center">
                              <select name="" id="stamp_price">
                                <option value="8000">Rp. 6000</option>
                                <option value="12000">Rp. 10.000</option>
                              </select>
                            </td>
                            <td colspan="2" class="text-center">
                              <select name="" id="stamp_qty">
                                <option value="0" selected hidden>Quantity</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                            </td>
                            <td colspan="3"><strong id="total_stamp_price" class="sub_total_price">0</strong></td>
                          </tr>
                          <tr>
                            <td colspan="8"><strong>TOTAL</strong></td>
                            <td colspan="3"><strong id="total_final">0</strong></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </section>
  </div>


  @foreach($product as $pr)
    <div class="modal fade" id="detail{{ $pr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">          
              <h3 class="text-center"><strong>{{ $pr->product_name }}</strong></h3>
              @if ($pr->type == 'goods')
                {{-- <div>
                  <img class="rounded mx-auto d-block" src="{{ asset('images/products/'.$pr->filename) }}" style="max-height: 300px;">
                </div> --}}
                <div id="carouselExampleControls{{ $pr->id }}" class="carousel slide mb-3" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block mx-auto rounded" src="{{ asset('images/products/'.$pr->filename) }}" style="max-height: 300px;">
                    </div>
                    @foreach ($goods_image as $gi)
                      @if ($gi->product_id ==  $pr->id)
                        <div class="carousel-item">
                          <img class="d-block mx-auto rounded" src="{{ asset('images/products/more/'.$gi->image_name) }}" style="max-height: 300px;">
                        </div>
                      @endif  
                    @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls{{ $pr->id }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls{{ $pr->id }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <div ml-3 mt-3>
                  {!! $pr->description !!}
                </div>
              @else($pr->type == 'goods')
                <div class="text-center">
                  <iframe width="400" height="250" allow="fullscreen;"
                    @php
                      $url = $pr->yt_video_id;
                      preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                      $youtube_id = $match[1];
                    @endphp
                    src="https://www.youtube.com/embed/{{ $youtube_id }}">
                  </iframe>
                </div>
              @endif
            </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection

@push('javascript')
  <script src="{{ URL::asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>

  <script> 
    const formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 2
    });

      $(document).ready(function() {
        //select2 configuration
        $('.select2-detail').select2({
          theme: 'bootstrap4',
          // placeholder: 'Choose One',
        });

        //stamp price and quantity change
        $('#stamp_price').on('change', function(){
          calculate();
        });

        $('#stamp_qty').on('change', function(){
          calculate();
        });

        $('#service_hour').on('change keyup', function(){
          calculate();
        });

        //print service invoice
        $('#print_invoice').on('click', function(){
          localStorage.clear();

          let invoice_data = {
            customer_plate: $('#cstm_licence_plate').val(),
            customer_phone: $('#cstm_phone').val(),
 
            sub_total: $('#total_product_price').html(),
            service_rate: {
              service_price: $('#service_price').html(),
              rate: $('#service_hour').val(),
              total: $('#total_treatment_price').html()
            },
            stamp: {
              label: $('#stamp_price option:selected').text(),
              price: $('#stamp_price').val(),
              qty: $('#stamp_qty').val(),
              total: $('#total_stamp_price').html()
            },
            total: $('#total_final').html()
          };

          window.localStorage.setItem('invoice_data', JSON.stringify(invoice_data));
        });

        let remove_tr = function (item) {
          $('#'+item).remove();
        };

        $('#print_page').on('click', function(){
            let row = []; 
          $('.product_price').each(function() {
            if($(this).html() == '0' ){
              let trid = $(this).closest('tr').attr('id');
              row.push(trid); 
            }
          });
          row.forEach(remove_tr);
          window.print();
        });
      });

      let calculate_part = function () {
        let total_product_price = 0;
        $('.price').each(function() {
            let currentElement = $(this);
            let value = parseInt(currentElement.html());
            total_product_price += value;
        });
        $('#total_product_price').html(total_product_price);
      }
      
      let calculate_service = function () {
        service_price = parseFloat($('#service_price').html()).toFixed(1);
        service_hour = parseFloat($('#service_hour').val()).toFixed(1);
        total_treatment_price = service_price*service_hour;
        $('#total_treatment_price').html(total_treatment_price.toFixed(2));
      }
      
      let calculate_stamp = function () {
        let total_stamp_price = parseInt($('#stamp_price option:selected').val()) * parseInt($('#stamp_qty option:selected').val());
        $('#total_stamp_price').html(total_stamp_price);
      }

      let calculate_total = function() {
        let total_final = 0.00;
        $('.sub_total_price').each(function() {
            let currentElement = $(this);
            let value = parseFloat(currentElement.html());
            total_final += value;
        });
        total_final = formatter.format(total_final);
        $('#total_final').html(total_final);
      }

      let calculate = function(){
        calculate_part();
        calculate_service();
        calculate_stamp();
        calculate_total();
      }
  </script>


  @foreach($product as $pr)        
      <script>
        $(document).ready(function(){
          //add product variety to price column when select option change
          $('#product_id{{ $pr->id }}').on('select2:select',function(event){
            let select_val = parseInt($(event.currentTarget).val());
            $('#price{{ $pr->id }}').html(select_val);

            let price_10 = parseInt($("#qty10_{{ $pr->id }} option:selected").val()) * select_val;
            let price_20 = parseInt($("#qty20_{{ $pr->id }} option:selected").val()) * select_val;
            let price_40 = parseInt($("#qty40_{{ $pr->id }} option:selected").val()) * select_val;
            let price_80 = parseInt($("#qty80_{{ $pr->id }} option:selected").val()) * select_val;

            $('#price10_{{ $pr->id }}').html(price_10);
            $('#price20_{{ $pr->id }}').html(price_20);
            $('#price40_{{ $pr->id }}').html(price_40);
            $('#price80_{{ $pr->id }}').html(price_80);
            calculate();
          });
          
          //change quantity and multiply with product variety price
          //for 10KM column
          $('#qty10_{{ $pr->id }}').on('change', function(event){
            let quantity_10 = parseInt($(event.currentTarget).val());
            let product_price =  parseInt($('#price{{ $pr->id }}').html());
            let price_10 = product_price*quantity_10;
            $('#price10_{{ $pr->id }}').html(price_10);
            calculate();
          });

          //for 20KM column
          $('#qty20_{{ $pr->id }}').on('change', function(event){
            let quantity_20 = parseInt($(event.currentTarget).val());
            let product_price =  parseInt($('#price{{ $pr->id }}').html());
            let price_20 = product_price*quantity_20;
            $('#price20_{{ $pr->id }}').html(price_20);
            calculate();
          });

          //for 40KM column
          $('#qty40_{{ $pr->id }}').on('change', function(event){
            let quantity_40 = parseInt($(event.currentTarget).val());
            let product_price =  parseInt($('#price{{ $pr->id }}').html());
            let price_40 = product_price*quantity_40;
            $('#price40_{{ $pr->id }}').html(price_40);
            calculate();
          });

          //for 80KM column
          $('#qty80_{{ $pr->id }}').on('change', function(event){
            let quantity_80 = parseInt($(event.currentTarget).val());
            let product_price =  parseInt($('#price{{ $pr->id }}').html());
            let price_80 = product_price*quantity_80;
            $('#price80_{{ $pr->id }}').html(price_80);
            calculate();
          });

        });
    </script>
  @endforeach
@endpush
