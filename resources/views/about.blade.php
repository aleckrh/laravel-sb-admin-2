@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('About') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h5 class="font-weight-bold">Alejandro RH</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://facebook.com/aleckrh" target="_blank" class="btn btn-facebook btn-circle btn-lg"><i class="fab fa-facebook-f fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://github.com/aleckrh" target="_blank" class="btn btn-github btn-circle btn-lg"><i class="fab fa-github fa-fw"></i></a>
                        </div>
                        <div class="col-md-4 mb-1 text-center">
                            <a href="https://twitter.com/aleckrh" target="_blank" class="btn btn-twitter btn-circle btn-lg"><i class="fab fa-twitter fa-fw"></i></a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Laravel SB Admin 2</h5>
                            <p>SB Admin 2 for Laravel.</p>
                            <p>Recommend to install this preset on a project that you are starting from scratch, otherwise your project's design might break.</p>
                            <a href="https://github.com/aleckrh/laravel-sb-admin-2" target="_blank" class="btn btn-github">
                                <i class="fab fa-github fa-fw"></i> Go to repository
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Credits</h5>
                            <p>Laravel SB Admin 2 uses some open-source third-party libraries/packages, many thanks to the web community.</p>
                            <ul>
                                <li><a href="https://laravel.com" target="_blank">Laravel</a> - Open source framework.</li>
                                <li><a href="https://github.com/DevMarketer/LaravelEasyNav" target="_blank">LaravelEasyNav</a> - Making managing navigation in Laravel easy.</li>
                                <li><a href="https://startbootstrap.com/themes/sb-admin-2" target="_blank">SB Admin 2</a> - Thanks to Start Bootstrap.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
