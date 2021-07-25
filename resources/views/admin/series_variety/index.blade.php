@extends('admin.layout')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/plugins/toastr/toastr.min.css">
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
                    <th>Series Variety</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($seriesvariety as $srv)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $srv->series->series_name }}</td>
                        <td>{{ $srv->series_variety_name }}</td>
                        <td>
                          <button data-toggle="modal" data-target="#edit{{ $srv->id }}" type="submit" class="btn btn-block btn-warning btn-sm">Update</button>
                         <!--  <form action="{{ url('/admin/master-database/series/'.$srv->id) }}" method="POST">
                            @csrf
                            @method('DELETE') -->
                            <button data-toggle="modal" data-target="#destroy{{ $srv->id }}" type="submit" class="btn btn-block btn-danger btn-sm delete">Delete</button>
                          <!-- </form> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Series Name</th>
                    <th>Series Variety</th>
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

    <form action="{{ action('Admin\SeriesVarietyController@store') }}" method="POST" id="quickForm">

      @csrf
      <div class="modal-body">          
          <div class="form-group">
            <label @error('series_name')
            class="text-danger"
            @enderror>Series Name @error('series_name')
              | {{ $message }}
            @enderror</label>
            <select class="custom-select" id="exampleFormControlSelect1">
            @foreach($seriesvariety as $srv)
              <option placeholder="Pilih Series Name">{{ $srv->series->series_name }}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Series Variety Name</label>
            <input type="name" id="series_variety_name" name="series_variety_name" value="{{ old ('series_variety_name') }}" class="form-control" aria-describedby="emailHelp" placeholder="Insert series variety name" >
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

@endsection
