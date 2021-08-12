 @extends('admin.layout')

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
                            @foreach($productvariety as $prv)
                            <tr>
                              <td>{{ $pr->product_name }}</td>
                              <td>{{ $prv->no_part_or_material }}</td>
                              <td>{{ $prv->price }}</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            @endforeach
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


    @stop