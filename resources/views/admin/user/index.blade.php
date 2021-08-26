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
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
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
                    <h3 class="card-title">Users Management</h3>
                    {{-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#store">Create Data</button> --}}
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Verified At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $usr)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $usr->role }}</td>
                          <td>{{ $usr->name }}</td> 
                          <td>{{ $usr->email }}</td>
                          <td>{{ $usr->phone }}</td>
                          <td>{{ $usr->email_verified_at }}</td>
                          <td>
                            @can('manager')
                              @if ($usr->email_verified_at == null)
                                <button data-toggle="modal" data-target="#verify{{ $usr->id }}" type="submit" class="btn btn-block btn-primary btn-sm">Verify</button>
                              @endif
                              <button data-toggle="modal" data-target="#edit{{ $usr->id }}" type="submit" class="btn btn-block btn-warning btn-sm ">Update</button>
                              @if (Auth::id() != $usr->id)
                                <button data-toggle="modal" data-target="#handover{{ $usr->id }}" type="submit" class="btn btn-block btn-dark btn-sm ">Handover</button>
                                <button data-toggle="modal" data-target="#destroy{{ $usr->id }}" type="submit" class="btn btn-block btn-danger btn-sm ">Delete</button>
                              @endif
                            @endcan
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Role</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Verified At</th>
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

  <!-- modal verify -->
  @foreach ($users as $usr)
    @if ($usr->email_verified_at == null)
      <div class="modal fade" id="verify{{ $usr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Verify User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <p class="col-md-12 text-center">Do you sure want to verify {{$usr->email}}?</p>
            <form action="{{ route('user.verify', $usr->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif
  @endforeach

  <!-- modal destroy -->
  @foreach ($users as $usr)
    @if ($usr->id != Auth::id())
      <div class="modal fade" id="destroy{{ $usr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="">Delete Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <p class="col-md-12 text-center">Do you sure want to destroy {{$usr->email}}?</p>
            <form action="{{ route('user.destroy', $usr->id) }}" method="POST">
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
    @endif
  @endforeach

  <!-- modal Handover -->
  @foreach ($users as $usr)
    @if ($usr->id != Auth::id())
      <div class="modal fade" id="handover{{ $usr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="">Update Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <p class="col-md-12 text-center">Do you sure want handover manager status to {{$usr->email}}?</p>
            <form action="{{ route('user.handover', ['from' => Auth::id(), 'to' => $usr->id]) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif
  @endforeach

  <!-- Modal Update -->
  @foreach ($users as $usr)
    <div class="modal fade" id="edit{{ $usr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
        <form action="{{ route('user.update', $usr->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">

              <div class="form-group">
                <label for="name{{ $usr->id }}">Name</label>
                @error('name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <input type="name" id="name{{ $usr->id }}" name="name" value="{{ $usr->name }}" class="form-control" placeholder="Insert name" >
              </div>

              <div class="form-group">
                <label for="email{{ $usr->id }}">Email</label>
                @error('email') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <input type="email" id="email{{ $usr->id }}" name="email" value="{{ $usr->email }}" class="form-control" placeholder="Insert email" >
              </div>

              <div class="form-group">
                <label for="phone{{ $usr->id }}">Phone</label>
                @error('phone') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <input type="text" id="phone{{ $usr->id }}" name="phone" value="{{ $usr->phone }}" class="form-control" placeholder="Insert Phone number, Ex: 082188449289">
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

  <!-- Toastr  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/toastr/toastr.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        columns: [
          null,
          null,
          null,
          null,
          { orderable: false }
        ]
      })
    });
  </script>
@endpush
