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
                                    <label class="form-control-label" for="ringkasan">Ringkasan Laporan</label>
                                    <input type="text" id="ringkasan" class="form-control" name="ringkasan" value="{{old('ringkasan', $dataLaporan->ringkasan)}}" disabled>
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
                                    <label class="form-control-label" for="foto">Bukti Foto</label>
                                    <input type="file" id="foto" class="form-control" name="foto[]" multiple>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="file">File</label>
                                    <input type="file" id="file" class="form-control" name="file">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                            </div>
                        </div>
                    </div>

            </div>

        </div>



    </div>

@endsection
