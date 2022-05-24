@extends('layout.auth')

@section('container')

<div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>

                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn ml-auto" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    @endif

                    @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn ml-auto" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    @endif

                    <form class="user" action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input autofocus type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id=" email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ url('/register') }}">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection