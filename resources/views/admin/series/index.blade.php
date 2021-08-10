@extends('admin.layout')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/toastr/toastr.min.css">
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
                        <th>Preview</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($series as $sr)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $sr->series_name }}</td>
                          <td>
                            <img src="{{ asset('images/series/'.$sr->filename) }}" style="max-height: 200px;">
                          </td>
                          <td>
                            <a href="{{ url('/admin/master-database/seriesVariety/'.$sr->id) }}" class="btn btn-block btn-primary btn-sm">Variety</a>
                            <button data-toggle="modal" data-target="#edit{{ $sr->id }}" type="submit" class="btn btn-block btn-warning btn-sm">Update</button>
                              <button data-toggle="modal" data-target="#destroy{{ $sr->id }}" type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
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

  <!-- Modal store -->
  <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{ url('admin/master-database/series/') }}" method="POST" id="quickForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">          
            <div class="form-group">
              <label for="series_name_store">Series Name</label>
              @error('series_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
              <input type="name" id="series_name_store" name="series_name" value="{{ old ('series_name') }}" class="form-control" placeholder="Insert series name" >
            </div>

            <div class="form-group">
              <label for="series_photo">Series Photo</label>
              @error('series_photo') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="series_photo" name="series_photo" accept="image/*">
                <label class="custom-file-label" for="series_photo">Choose file</label>
              </div>
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
    <div class="modal fade" id="destroy{{ $sr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <p class="col-md-12 text-center">Do you sure want to destroy {{$sr->series_name}}?</p>
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
    <div class="modal fade" id="edit{{ $sr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
        <form action="{{ url('/admin/master-database/series/'.$sr->id) }}" method="POST" id="quickForm{{ $sr->id }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-body">          
              <div class="form-group">
                <label for="series_name{{ $sr->id }}">Series Name</label>
                @error('series_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <input type="name" id="series_name{{ $sr->id }}" name="series_name" value="{{ $sr->series_name }}" class="form-control" placeholder="Insert series name" >
              </div>

              <div class="form-group">
                <label for="series_photo{{$sr->id}}">Series Photo</label>
                @error('series_photo') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="series_photo{{$sr->id}}" name="series_photo" accept="image/*">
                  <label class="custom-file-label" for="series_photo{{$sr->id}}">Don't choose file if you don't want to change the image</label>
                  <input type="hidden" name="old_series_photo" value="{{ $sr->filename }}">
                </div>
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

@push('javascript')
  <!-- DataTables  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- Toastr  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/toastr/toastr.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false
      })
    });
  </script>

   <script>
    $(document).ready(function () {
      bsCustomFileInput.init()
    })
  </script>
@endpush