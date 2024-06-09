@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Halaman User') }}</h1>



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

        <div class="pl-lg-4 mb-3">
            <div class="row">
                <div class="col text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                        <i class="fas fa-fw fa-plus mr-2"></i>
                        <span class="font-weight-bold">{{ __('Tambahkan User') }}</span></a>
                    </a>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data User Keseluruhan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-sm-1">No</th>
                                <th>Nama Lengkap</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUser as $i => $row)
                                <tr>
                                    <td class="col-sm-1">{{ ++$i }}</td>
                                    <td>{{ $row->name }} {{ $row->last_name }}</td>
                                    <td>{{ $row->level }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-warning mr-2" href="{{ route('user.edit', $row->id) }}"><i class="fas fa-fw fa-edit"></i></a>
                                            <a data-confirm-delete="true" class="btn btn-sm btn-danger mr-2"href="{{ route('user.destroy', $row->id) }}"><i class="fas fa-fw fa-trash-alt"></i></a>


                                            {{-- <form action="{{route('user.destroy',$row->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger mr-2" type="submit"><i class="fas fa-fw fa-trash-alt"></i></button>
                                            </form> --}}
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



@endsection
