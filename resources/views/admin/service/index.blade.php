@extends('admin.layout')


@push('css')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


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
              <li class="breadcrumb-item"><a href="{{url('admin/service')}}">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container ml-4">
        <div class="d-flex justify-content row">
            @foreach($series as $sr)
           <div class="card mr-4 mb-5" style="width: 15rem; display: inline-block">
            <a href="{{route('service.show',$sr->id)}}">
            <div style="background-color: #f3f2f2;">
              <img src="{{ asset('images/series/'.$sr->filename) }}" class="card-img-top" alt="...">
            </div>
              <div class="card-body" style="font-family: 'Manrope', sans-serif;text-shadow: 1px 0 #888888; letter-spacing:2px; font-weight:bold;">
                <h5 class="card-title text-dark">{{$sr->series_name}}</h5>
              </div>
            </a>
            </div>
            @endforeach
        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- batas nya content -->

@stop