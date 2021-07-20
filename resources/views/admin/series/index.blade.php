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
    <section class="content col-sm-10 mx-auto w-auto">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#store">
        Tambah Data
      </button>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Edit/Delete</th>
          </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($series as $sr)
          <tr>
            <th>{{$no++}}</th>
            <td>{{$sr->series_name}}</td>
            <td>
              <ul class="list-inline m-0">
                <li class="list-inline-item">
                  <button class="btn btn-success btn-sm rounded-0" type="button"><i class="fa fa-edit"></i></button>
                </li>
                <li class="list-inline-item">
                  <button class="btn btn-danger btn-sm rounded-0" type="button"><i class="fa fa-trash"></i></button>
                </li>
              </ul>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ action('SeriesController@store') }}" method="POST">

      {{ csrf_field() }}
      <div class="modal-body">          
          <div class="form-group">
            <label >Nama Mobil</label>
            <input type="name" class="form-control" aria-describedby="emailHelp" placeholder="Masukkan Nama Mobil">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
@stop