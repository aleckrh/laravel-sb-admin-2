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

        @if (Auth::user()->level == 1 | 5)
            <div class="pl-lg-4 mb-3">
                <div class="row">
                    <div class="col text-right">
                        <a href="{{ route('laporan.create') }}" class="btn btn-primary">
                            <i class="fas fa-fw fa-plus mr-2"></i>
                            <span class="font-weight-bold">{{ __('Ajukan Laporan') }}</span></a>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-sm-1">No</th>
                                <th>No Laporan</th>
                                <th>Judul</th>
                                <th>Pelapor</th>
                                <th>Divisi Terkait</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataLaporan as $i => $row)
                                <tr id="tr_{{$row['id']}}">
                                    <td class="col-sm-1">{{ ++$i }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->judul }}</td>
                                    <td>{{ $row->user->name }} {{ $row->user->last_name }}</td>
                                    <td>
                                        @foreach( $row->divisiTerkait as $divisi)
                                                
                                            {{ $divisi->nama_divisi }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($row->status == 1)
                                            Belum Diterima
                                        @endif

                                        @if ($row->status == 2)
                                            Sudah Diterima
                                        @endif

                                        @if ($row->status == 3)
                                            Sudah Dikerjakan
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            @if (auth()->user()->level == 1|2|3|4|5)     
                                            <a class="btn btn-info btn-sm mr-2" href="{{ route('laporan.show', $row->id) }}"><i class="fas fa-fw fa-circle-info"></i></a>
                                            @endif

                                            @if (auth()->user()->level == 1|2)
                                            <a class="btn btn-success btn-sm mr-2" href="{{ route('laporan.group', $row->id) }}"><i class="fas fa-fw fa-people-group"></i></a>
                                            @endif

                                            @if (auth()->user()->level == 1|2|5)
                                                @if ($row->status == 1)
                                                <a class="btn btn-warning btn-sm mr-2"href="{{ route('laporan.edit', $row->id) }}"><i class="fas fa-fw fa-edit"></i></a>
                                                @endif
                                            @endif

                                            @if (auth()->user()->level== 1|2)
                                            <a class="btn btn-danger btn-sm mr-2 deleteLaporan" data-id="{{ $row->id }}"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('.deleteLaporan').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            Swal.fire({
                title: 'Yakin Ingin Menghapus Laporan?',
                text: "Tindakan tidak bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/laporan/' + itemId + '/destroy',
                        type: 'GET',
                        success: function(response) {
                            Swal.fire(
                                'Berhasil Hapus!',
                                'Data Berhasil Dihapus.',
                                'success'
                            );
                            $('#tr_'+ itemId).hide()
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi Kesalahan Ketika Menghapus Data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
