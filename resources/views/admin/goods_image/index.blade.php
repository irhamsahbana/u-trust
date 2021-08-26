@extends('admin.layout')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins')}}/toastr/toastr.min.css">
  <!-- Select2 -->
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
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Goods Images</li>
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
                <h3 class="card-title">Goods Images Management</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#store">Create Data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <th>Goods Image</th>
                      <th>Preview</th>
                      <th>Action</th>
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach ($goods_images as $goods)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $goods->product->product_name }}</td>
                        <td>{{ $goods->image_name }}</td>
                        <td>
                            <img src="{{ asset('images/products/more/'.$goods->image_name) }}" style="max-height: 200px;">
                        </td>
                        <td>
                          {{-- <button data-toggle="modal" data-target="#edit{{ $goods->id }}" type="submit" class="btn btn-block btn-warning btn-sm edit">Update</button> --}}
                          <button data-toggle="modal" data-target="#destroy{{ $goods->id }}" type="submit" class="btn btn-block btn-danger btn-sm delete">Delete</button>
                          <!-- </form> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <th>Goods Image</th>
                      <th>Preview</th>
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

<!-- Modal create -->
<div class="modal fade" id="store" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('goods-image.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="form-group">
            <label for="product_id">Product Name</label>
            @error('product_id') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <select id="product_id" name="product_id" class="form-control product_type_store select-store">
              <option value="" selected disabled hidden>-- Choose One --</option>
              @foreach ($goods_products as $pr)
                <option value="{{ $pr->id }}">{{$pr->product_name}}</option>
              @endforeach
            </select>
          </div>

            <div class="form-group">
              <label for="goods_photo">Goods Photo</label>
              @error('goods_photo') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="goods_photo" name="goods_photo" accept="image/*">
                <label class="custom-file-label" for="goods_photo">Choose file</label>
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


<!-- Modal Update -->
{{-- @foreach ($goods_images as $goods)
  <div class="modal fade" id="edit{{ $pr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <form action="{{ route('goods-image.update', $goods->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">    

            <div class="form-group">
              <label for="product_name{{$goods->id}}">Product Name</label>
              @error('product_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
              <input type="name" id="product_name{{$goods->id}}" name="product_name" value="{{ $pr->product_name }}" class="form-control"  placeholder="Insert product name" >
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
@endforeach --}}


<!-- modal destroy -->
@foreach ($goods_images as $goods)
  <div class="modal fade" id="destroy{{ $goods->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <p class="col-md-12 text-center">Do you sure want to destroy {{$goods->image_name}}?</p>
        <form action="{{ route('goods-image.destroy', $goods->id) }}" method="POST">
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

@push('javascript')
  <!-- DataTables  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ URL::asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- Toastr  & Plugins -->
  <script src="{{ URL::asset('assets')}}/plugins/toastr/toastr.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ URL::asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Select2 -->
  <script src="{{ URL::asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $('.select-store').select2({
        theme: 'bootstrap4',
        dropdownParent: $('#store'),
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      bsCustomFileInput.init()
    })
  </script>

  <!-- Datatable client-side -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        columns: [
          null,
          null,
          null,
          { orderable: false },
          { orderable: false }
        ]
      })
    });
  </script>

@endpush