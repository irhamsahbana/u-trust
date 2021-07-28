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
                            <button data-toggle="modal" data-target="#destroy{{ $srv->id }}" type="submit" class="btn btn-block btn-danger btn-sm delete">Delete</button>
                          </td>
                        </tr>
                    </tbody>
                    @endforeach
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
              <label>Series Name</label>
              <select name="series_id" class="form-control">
                <option value="" selected hidden>Choose One</option>
                @foreach($series as $sr)
                  <option value="{{ $sr->id }}">{{ $sr->series_name }}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-body">          
            <div class="form-group">
              <label>Series Variety Name</label>
              <input type="name" id="series_variety_name_store" name="series_variety_name" value="{{ old ('series_variety_name') }}" class="form-control" placeholder="Insert series variety name" >
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
  @foreach ($seriesvariety as $srv)
    <div class="modal fade" id="destroy{{ $srv->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <p class="col-md-8">Do you sure want to destroy {{$srv->series_variety_name}}?</p>
          <form action="{{ url('/admin/master-database/seriesVariety/'.$srv->id) }}" method="POST">
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
  @foreach ($seriesvariety as $srv)
    <div class="modal fade" id="edit{{ $srv->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <form action="{{ url('/admin/master-database/seriesVariety/'.$srv->id) }}" method="POST" id="quickForm{{ $srv->id }}">
            @csrf
            @method('PUT')
            <div class="modal-body">          
                <div class="form-group">
                  <div class="form-group">
                  <label>Series Name</label>
                  <select name="series_id" class="form-control">
                    <option>- Pilih -</option>
                    @foreach($seriesvariety as $srv)
                      <option value="{{ $srv->series_id }}">{{ $srv->series->series_name }}</option>
                    @endforeach
                  </select>
                </div>
                  <label for="series_variety_name{{ $srv->id }}">Series Variety Name</label>
                  @error('series_variety_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                  <input type="name" id="series_variety_name{{ $srv->id }}" name="series_variety_name" value="{{ $srv->series_variety_name }}" class="form-control"  placeholder="Insert series variety name" >
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
