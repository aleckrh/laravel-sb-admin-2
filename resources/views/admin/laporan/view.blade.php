@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Halaman Laporan') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">

        <!-- Form -->
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan No <b>{{$dataLaporan->id}}</b> oleh {{$dataLaporan->user->name}} {{$dataLaporan->user->last_name}}</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('laporan.agree',$dataLaporan->id) }}" autocomplete="off" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="status" value={{2}}>

                    <div class="pl-lg-4">
                        <div class="row">

                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="judul">Judul Laporan</label>
                                    <input type="text" id="judul" class="form-control" name="judul" value="{{old('judul',$dataLaporan->judul)}}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="ringkasan">Deskripsi Laporan</label>
                                    <textarea type="text" id="deskripsi" class="form-control" name="deskripsi" disabled>{{old('deskripsi', $dataLaporan->deskripsi)}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="ringkasan">Lokasi</label>
                                    <input type="text" id="lokasi" class="form-control" name="lokasi" value="{{old('lokasi', $dataLaporan->lokasi)}}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group text-center">
                                    <div class="container">
                                    @foreach ($fotoLaporan as $item)
                                        <img class="object-fit-contain border rounded mb-4" src="{{asset('gambar/'.$item->foto)}}" alt="Responsive image">
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="file">{{$dataLaporan->file}}</label>
                                </div>
                            </div>

                            <input type="hidden">


                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-left">
                                <a href="{{route('laporan')}}" class="btn btn-light">Kembali</a>
                            </div>
                            @if (auth()->user()->level == 1 | 4)
        
                                @if ($dataLaporan->status == 1)
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary">Setujui Laporan</a>
                                    </div>
                                @endif
                                
                                @if ($dataLaporan->status == 2)
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary" disabled>Sudah Diterima</a>
                                    </div>
                                @endif

                            @endif



                        </div>
                    </div>

                </form>

            </div>

        </div>



    </div>

@endsection
