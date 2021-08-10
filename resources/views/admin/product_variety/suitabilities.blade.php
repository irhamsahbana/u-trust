@extends('admin.layout')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/toastr/toastr.min.css">
  <!-- Select2 -->
  {{-- <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @foreach ($series as $sr)
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ $sr->series_name }}</h3>

            <div class="card-tools roll-up">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped datatable-product">
              <thead>
                <tr>
                  <th>Series Variety Name</th>
                  <th>Action</th>
                </tr> 
              </thead>
              <tbody>
                @foreach ($series_varieties as $srv)
                  @if ($srv->series_id == $sr->id)
                    <tr>
                      <td>{{ $srv->series_variety_name }}</td>
                      <td>

                        @foreach ($product_suitabilities as $key)
                            @if ($key->series_variety_id == $srv->id)
                            <a role="button" class="btn btn-block btn-success btn-sm" target="_blank">Suitable</a>
                            @endif
                        @endforeach

                        {{-- @if ($product_suitabilities->contains($srv->id))
                          <a role="button" class="btn btn-block btn-success btn-sm" target="_blank">Suitable</a>
                        @else
                          <a role="button" class="btn btn-block btn-danger btn-sm" target="_blank">Not Suitable</a>
                        @endif --}}
                      </td>
                    </tr>                      
                  @endif
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Product Name</th>
                  <th>Action</th>
                </tr> 
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            {{-- Footer --}}
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      @endforeach

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- batas nya content -->
@endsection

@push('javascript')
  <!-- DataTables  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- Toastr  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/toastr/toastr.min.js"></script>

  <!-- Datatable client-side -->
  <script>
    $(function () {
      $(".datatable-product").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        columns: [
          null,
          { orderable: false }
        ]
      })
    });
  </script>
@endpush
