@extends('admin.layout')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/toastr/toastr.min.css">
@endsection

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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <div class="bs-example">
                  <h3 class="card-title">Series Management</h3>
                  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#store">Create Data</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Series Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($series as $sr)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sr->series_name }}</td>
                        <td>
                          <button data-toggle="modal" data-target="#edit{{ $sr->id }}" type="submit" class="btn btn-block btn-warning btn-sm">Update</button>
                         <!--  <form action="{{ url('/admin/master-database/series/'.$sr->id) }}" method="POST">
                            @csrf
                            @method('DELETE') -->
                            <button data-toggle="modal" data-target="#destroy{{ $sr->id }}" type="submit" class="btn btn-block btn-danger btn-sm delete">Delete</button>
                          <!-- </form> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Series Name</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- batas nya content -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ action('Admin\SeriesController@store') }}" method="POST" id="quickForm">

      @csrf
      <div class="modal-body">          
          <div class="form-group">
            <label for="series_name_store">Series Name</label>
            @error('series_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input type="name" id="series_name_store" name="series_name" value="{{ old ('series_name') }}" class="form-control" placeholder="Insert series name" >
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- modal destroy -->
@foreach ($series as $sr)
<div class="modal fade" id="destroy{{ $sr->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <p class="col-md-8">Do you sure want to destroy {{$sr->series_name}}?</p>
      <form action="{{ url('/admin/master-database/series/'.$sr->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach


<!-- Modal Update -->
@foreach ($series as $sr)
<div class="modal fade" id="edit{{ $sr->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
    <form action="{{ url('/admin/master-database/series/'.$sr->id) }}" method="POST" id="quickForm{{ $sr->id }}">
      @csrf
      @method('PUT')
      <div class="modal-body">          
          <div class="form-group">
            <label for="series_name{{ $sr->id }}">Series Name</label>
            @error('series_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input type="name" id="series_name{{ $sr->id }}" name="series_name" value="{{ $sr->series_name }}" class="form-control" aria-describedby="emailHelp" placeholder="Insert series name" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
        
      </div>
    </form>
    </div>
  </div>
</div>
@endforeach

@endsection

@section('javascript')
  <!-- DataTables  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Toastr  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/toastr/toastr.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

@endsection