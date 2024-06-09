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
                <h6 class="m-0 font-weight-bold text-primary">Pengajuan Laporan oleh {{$dataLaporan->user->name}} {{$dataLaporan->user->last_name}}</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('laporan.agree',$dataLaporan->id) }}" autocomplete="off" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="status" value="Sudah Disetujui">

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
                                        <img class="image-fluid mb-4" src="{{asset('gambar/'.$item->foto)}}" alt="Responsive image">
                                        {{-- <label>{{$item->foto}}</label> --}}
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="file">{{$dataLaporan->file}}</label>
                                    {{-- <a href="{{route('download', $dataLaporan->file) }}">{{$dataLaporan->file}}</a> --}}
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

                            @if ($dataLaporan->status == "Belum Disetujui")
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Setujui</a>
                            </div>
                            @endif
                            
                            @if ($dataLaporan->status == "Sudah Disetujui")
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary" disabled>Sudah Disetujui</a>
                            </div>
                            @endif



                        </div>
                    </div>

                </form>

            </div>

        </div>



    </div>

@endsection
