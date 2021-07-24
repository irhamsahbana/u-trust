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
                <h3 class="card-title">Product Management</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#store">Create Data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach ($product as $pr)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pr->product_name }}</td>
                        <td>{{ $pr->type }}</td>
                        <td>
                          <button data-toggle="modal" data-target="#editmodal" type="submit" class="btn btn-block btn-warning btn-sm edit">Update</button>
                         <!--  <form action="{{ url('/admin/master-database/series/'.$pr->id) }}" method="POST">
                            @csrf
                            @method('DELETE') -->
                            <button data-toggle="modal" data-target="#destroy{{ $pr->id }}" type="submit" class="btn btn-block btn-danger btn-sm delete">Delete</button>
                          <!-- </form> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- batas nya content -->

<!-- Modal  -->
<div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ action('Admin\ProductController@store') }}" method="POST" id="quickForm">

      @csrf
      <div class="modal-body">          
          <div class="form-group">
            <label @error('product_name')
            class="text-danger"
            @enderror>Product Name @error('product_name')
              | {{ $message }}
            @enderror</label>
            <input type="name" id="product_name" name="product_name" value="{{ old ('product_name') }}" class="form-control" aria-describedby="emailHelp" placeholder="Insert product name" >
          </div>
          <div class="form-group">
            <label @error('type')
            class="text-danger"
            @enderror>Type @error('type')
              | {{ $message }}
            @enderror</label>
            <input type="name" id="type" name="type" value="{{ old ('type') }}" class="form-control" aria-describedby="emailHelp" placeholder="Insert Type" >
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


<!-- Modal Update -->
@foreach ($product as $pr)
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
    <form action="{{ route('admin.product.index') }}" method="POST" id="editform">
      {{csrf_field()}}
      {{method_field('PUT')}}
      <div class="modal-body">          
          <div class="form-group">
            <label class="text-danger">Product Name</label>
            <input type="name" id="product_name" id="product_name" name="product_name" value="{{ $pr->product_name }}" class="form-control" aria-describedby="emailHelp" placeholder="Insert product name" >
          </div>
          <div class="form-group">
            <label class="text-danger">Type</label>
            <input type="name" id="type" name="type" id="type" value="{{ $pr->type }}" class="form-control" aria-describedby="emailHelp" placeholder="Insert product name" >
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


<!-- modal destroy -->
@foreach ($product as $pr)
<div class="modal fade" id="destroy{{ $pr->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <p class="col-md-8">Apakah anda ingin menghapus data {{$pr->product_name}}</p>
      <form action="{{ url('/admin/master-database/product/'.$pr->id) }}" method="POST">
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


@endsection

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
  <script src="{{ URL::asset('assets')}}/plugins/jquery/jquery.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/toastr/toastr.min.js"></script>

  
  @section('javascript')
  {{-- <script>
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
       

  $(document).ready(function(){
    var table = $('#example1').DataTable();

    table.on('click', '.edit', function(){
      $pr = $(this).closest('pr');
      if ($($pr).hasClass('child')){
        $pr = $pr.prev('.parent');
      }

      var data = table.row($pr).data();
      console.log(data);

      $('#product_name').val(data[1]);
      $('#type').val(data[2]);

      $('#editform').attr('action', 'admin.product.index'+data[0]);
      $('#editmodal').modal('show');
    });
  });
 </script> --}}