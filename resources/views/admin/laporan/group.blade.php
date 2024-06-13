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
                <h6 class="m-0 font-weight-bold text-primary">Pengajuan Laporan</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('laporan.groupping' , $dataLaporan->id) }}" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @method('PUT')
                    @csrf
                    
                    <input type="hidden" name="status" value={{$dataLaporan->status}}>

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="judul">Judul Laporan</label>
                                    <input type="text" id="judul" class="form-control" name="judul" disabled value="{{$dataLaporan->judul}}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="deskripsi">Deskripsi Laporan</label>
                                    <textarea type="text" id="deskripsi" class="form-control" name="deskripsi" disabled>{{$dataLaporan->deskripsi}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="judul">Lokasi Pelabuhan</label>
                                    <input type="text" id="judul" class="form-control" name="judul" disabled value="{{$dataLaporan->pelabuhan}}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="lokasi">Detail Lokasi</label>
                                    <textarea disabled type="text" id="lokasi" class="form-control" name="lokasi">{{$dataLaporan->lokasi}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="divisi">Divisi Terkait</label>
                                    @foreach ($dataDivisi as $item)
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="divisi[{{$item->nama_divisi}}]" value="{{$item->nama_divisi}}"
                                            @if (in_array($item->nama_divisi, $divisiTerkait)) checked @endif
                                            >
                                            <label class="form-check-label" for="exampleCheck1">{{$item['nama_divisi']}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">

                            <div class="col text-left">
                                <a href="{{route('laporan')}}" class="btn btn-light">Kembali</a>
                            </div>

                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>



    </div>

@endsection
