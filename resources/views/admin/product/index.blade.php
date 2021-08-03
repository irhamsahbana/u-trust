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
                <h3 class="card-title">Products Management</h3>
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
                      <th>Preview</th>
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
                          @if ($pr->type == 'goods')
                            <img src="{{ asset('images/products/'.$pr->filename) }}" style="max-height: 200px;">
                          @elseif ($pr->type == 'service')
                            <iframe width="250" height="200" allow="fullscreen;"
                              src="https://www.youtube.com/embed/{{ $pr->yt_video_id }}">
                            </iframe>
                          @else
                            Something went wrong! not recognized type of product!
                          @endif
                        </td>
                        <td>
                          <button data-toggle="modal" data-target="#edit{{ $pr->id }}" type="submit" class="btn btn-block btn-warning btn-sm edit">Update</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ route('product.store') }}" method="POST" id="quickForm" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">          
          <div class="form-group">
            <label for="product_name_store">Product Name</label>
            @error('product_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input id="product_name_store" name="product_name" value="{{ old ('product_name') }}" class="form-control" placeholder="Insert product name" >
          </div>

          <div class="form-group">
            <label for="product_type_store">Type</label>
            @error('type') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <select id="product_type_store" name="type" class="form-control product_type_store">
              <option value="" selected disabled hidden>Choose One</option>
              <option value="goods" @if (old('type') == "goods" ) selected @endif>goods</option>
              <option value="service" @if (old('type') == "service" ) selected @endif>service</option>
            </select>
          </div>

          <div class="form-group">
            <label for="yt_video_id">Youtube Video Id</label>
            @error('yt_video_id') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input id="yt_video_id" name="yt_video_id" value="{{ old ('yt_video_id') }}" class="form-control" placeholder="Insert youtube video Id" disabled>
          </div>

          <div class="form-group">
            <label for="goods_photo">Goods Photo</label>
            @error('goods_photo') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="goods_photo" name="goods_photo" accept="image/*" disabled>
              <label class="custom-file-label" for="goods_photo">Choose file</label>
            </div>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            @error('description') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
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
  <div class="modal fade" id="edit{{ $pr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <form action="{{ route('product.update', $pr->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">    

            <div class="form-group">
              <label for="product_name{{$pr->id}}">Product Name</label>
              @error('product_name') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
              <input type="name" id="product_name{{$pr->id}}" name="product_name" value="{{ $pr->product_name }}" class="form-control"  placeholder="Insert product name" >
            </div>

            <div class="form-group">
              <label for="product_type{{$pr->id}}">Type</label>
              @error('type') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
              <select id="product_type{{ $pr->id }}" name="type" class="form-control product_type_store">
                <option value="" selected disabled hidden>Choose One</option>
                @if ($pr->type == 'goods')
                  <option value="goods" selected>goods</option>
                @else
                  <option value="service" selected >service</option>
                @endif
              </select>
            </div>

            @if ($pr->type == 'goods')
              <div class="form-group">
                <label for="goods_photo{{$pr->id}}">Goods Photo</label>
                @error('goods_photo') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="goods_photo{{$pr->id}}" name="goods_photo" accept="image/*">
                  <label class="custom-file-label" for="goods_photo{{$pr->id}}">Don't choose file if you don't want to change the image</label>
                  <input type="hidden" name="old_goods_photo" value="{{ $pr->filename }}">
                </div>
              </div>

              <div class="form-group">
                <label for="description{{$pr->id}}">Description</label>
                @error('description') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <textarea id="description{{$pr->id}}" name="description" class="form-control" rows="3" placeholder="Enter ...">{{ $pr->description }}</textarea>
              </div>
            @else
              <div class="form-group">
                <label for="yt_video_id{{$pr->id}}">Youtube Video Id</label>
                @error('yt_video_id') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
                <input id="yt_video_id{{$pr->id}}" name="yt_video_id" value="{{ $pr->yt_video_id }}" class="form-control" placeholder="Insert youtube video Id">
              </div>
            @endif

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
          <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <p class="col-md-12 text-center">Do you sure want to destroy {{$pr->product_name}}?</p>
        <form action="{{ route('product.destroy', $pr->id) }}" method="POST">
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
  
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init()
    })
  </script>

  <!-- Add element base on type selection on create modal -->
  <script>
    $(document).on('change', '#product_type_store', function(){
        let product_type_store = $(this).val();

        if(product_type_store == 'goods') {
          $('#yt_video_id').prop('disabled', true);
          $('#goods_photo').prop('disabled', false);
          $('#description').prop('disabled', false);
        } else if(product_type_store == 'service') {
          $('#yt_video_id').prop('disabled', false);
          $('#goods_photo').prop('disabled', true);
          $('#description').prop('disabled', true);
        } else {
          $('#yt_video_id').prop('disabled', false);
          $('#goods_photo').prop('disabled', false);
          $('#description').prop('disabled', false);
        }
    });
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