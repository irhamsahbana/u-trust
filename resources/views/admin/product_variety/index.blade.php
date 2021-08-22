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
              <li class="breadcrumb-item active">Product Varities</li>
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
                <h3 class="card-title">Products Variety Management</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#store">Create Data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Type</th>
                      <th>Product Name</th>
                      <th>Part Number/Material</th>
                      <th>Price (IDR)</th>
                      <th>Action</th>
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach ($product_varieties as $prv)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $prv->type }}</td>
                        <td>{{ $prv->product_name }}</td>
                        <td> {{ $prv->no_part_or_material }}</td>
                        <td> {{ number_format($prv->price, 2, '.', ',') }}</td>
                        <td>
                          {{-- <a role="button" class="btn btn-block btn-info btn-sm" href="{{ route('product-variety.suitabilities', $prv->id) }}" target="_blank">Suitabilities</a> --}}
                          <button data-toggle="modal" data-target="#edit{{ $prv->id }}" type="submit" class="btn btn-block btn-warning btn-sm edit">Update</button>
                          <button data-toggle="modal" data-target="#destroy{{ $prv->id }}" type="submit" class="btn btn-block btn-danger btn-sm delete">Delete</button>
                          <!-- </form> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Type</th>
                      <th>Product Name</th>
                      <th>Part Number/Material</th>
                      <th>Price (IDR)</th>
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
    <form action="{{ route('product-variety.store') }}" method="POST">
      @csrf
      <div class="modal-body">          
          <div class="form-group">
            <label for="product_id">Product Name</label>
            @error('product_id') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <select id="product_id" name="product_id" class="form-control product_type_store select2-store">
              <option value="" selected disabled hidden>-- Choose One --</option>
              @foreach ($products as $pr)
                <option value="{{ $pr->id }}">({{ $pr->type }}) {{$pr->product_name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="no_part_or_material">Product Part Number or Material</label>
            @error('no_part_or_material') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input id="no_part_or_material" name="no_part_or_material" value="{{ old ('no_part_or_material') }}" class="form-control" placeholder="Insert product part number or material" >
          </div>
          
          <div class="form-group">
            <label for="price">Price (IDR)</label>
            @error('price') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input type="number" id="price" name="price" value="{{ old ('price') }}" class="form-control" placeholder="Insert product part number or material price" >
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
@foreach ($product_varieties as $prv)
  <div class="modal fade" id="edit{{ $prv->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <form action="{{ route('product-variety.update', $prv->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          
          <div class="form-group">
            <label for="product_id">Product Name</label>
            @error('product_id{{ $prv->id }}') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <select id="product_id{{ $prv->id }}" name="product_id" class="form-control">
              <option value="" selected disabled hidden>-- Choose One --</option>
              @foreach ($products as $pr)
                <option value="{{ $pr->id }}" @if ($prv->product_id == $pr->id) selected @endif>({{ $pr->type }}) {{$pr->product_name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="no_part_or_material{{ $prv->id }}">Product Part Number or Material</label>
            @error('no_part_or_material{{ $prv->id }}') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input id="no_part_or_material{{ $prv->id }}" name="no_part_or_material" value="{{ $prv->no_part_or_material }}" class="form-control" placeholder="Insert product part number or material" >
          </div>

          <div class="form-group">
            <label for="price{{ $prv->id }}">Price (IDR)</label>
            @error('price') <span style="font-size: 12px; color:red; display: block;">{{ $message }}</span> @enderror
            <input type="number" id="price{{ $prv->id }}" name="price" value="{{ $prv->price }}" class="form-control" placeholder="Insert product part number or material price" >
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
@foreach ($product_varieties as $prv)
  <div class="modal fade" id="destroy{{ $prv->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <p class="col-md-12 text-center">Do you sure want to destroy {{$prv->no_part_or_material}}?</p>
        <form action="{{ route('product-variety.destroy', $prv->id) }}" method="POST">
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
  <!-- Select2 -->
  <script src="{{ URL::asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>

  <!-- select2 configuration -->
  <script>
      $(document).ready(function() {
        $('.select2-store').select2({
          theme: 'bootstrap4',
          // placeholder: 'Choose One',
          dropdownParent: $('#store'),
        });
      });
  </script>

  <!-- make select2 configuration for every number part or material -->
  @foreach ($product_varieties as $prv)
    <script>
      $(document).ready(function() {
        $('#product_id{{ $prv->id }}').select2({
          theme: 'bootstrap4',
          // placeholder: 'Choose One',
          dropdownParent: $('#edit{{ $prv->id }}'),
        });
      });
    </script>
  @endforeach


  <!-- Datatable client-side -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        columns: [
          null,
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