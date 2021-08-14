 @extends('admin.layout')

@push('css')
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              <li class="breadcrumb-item"><a href="{{url('admin/service')}}">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
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
                      <h3 class="card-title">Expandable Table</h3>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th rowspan="2">Item Spare Part, Material & Sublet</th>
                            <th rowspan="2">Nomor Part / Material</th>
                            <th rowspan="2">Price</th>
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
                            <tr>
                                <td data-toggle="modal" data-target="#detail{{ $pr->id }}">{{ $pr->product_name }}</td>
                              <td>
                                <div class="form-group">
                                  <select id="product_id{{ $pr->id }}" name="" class="form-control select2-detail">
                                    <option value="" selected disabled hidden>-- Choose One --</option>
                                    @foreach($product_variety as $prv)
                                      @if($prv->product_id == $pr->id)
                                        <option value="{{ $prv->id }}">({{ $pr->product_name }}) {{$prv->no_part_or_material}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td id="price{{$pr->id}}"></td>
                              <td>
                                <div class="form-group">
                                  <select name="" id="qty10_{{ $pr->id }}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td></td>
                              <td>
                                <div class="form-group">
                                  <select name="" id="qty20_{{ $pr->id }}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td></td>
                              <td>
                                <div class="form-group">
                                  <select name="" id="qty40_{{ $pr->id }}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td></td>
                              <td>
                                <div class="form-group">
                                  <select name="" id="qty80_{{ $pr->id }}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </td>
                              <td></td>
                            </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th rowspan="2">Item Spare Part, Material & Sublet</th>
                            <th rowspan="2">Nomor Part / Material</th>
                            <th rowspan="2">Price</th>
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
                        </tfoot>
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
              <h5 class="modal-title" id="exampleModalLabel">Detail Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">          
              <h3 class="text-center">{{ $pr->product_name }}</h3>
              @if ($pr->type == 'goods')
              <div{{--  style=" background-color: #eee;" --}}>
                <img class="rounded mx-auto d-block" src="{{ asset('images/products/'.$pr->filename) }}" style="max-height: 200px;">
                </div>
                <div>
                  {!! $pr->description !!}
                </div>
              @else($pr->type == 'service')
                <iframe width="250" height="200" allow="fullscreen;"
                  @php
                    $url = $pr->yt_video_id;
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                    $youtube_id = $match[1];
                  @endphp
                  src="https://www.youtube.com/embed/{{ $youtube_id }}">
                </iframe>
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


  <!-- select2 configuration -->
  <script>
      $(document).ready(function() {
        $('.select2-detail').select2({
          theme: 'bootstrap4',
          // placeholder: 'Choose One',
        });
      });
    </script>


  @foreach($product as $pr)        
      <script>
        $(document).ready(function(){
          $('#product_id{{ $pr->id }}').change(function(e){

          })
        });
    </script>
  @endforeach
@endpush
