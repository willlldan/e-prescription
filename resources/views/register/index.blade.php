@extends('layout.auth')

@section('container')

<div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id=" firstName" placeholder="First Name" name="first_name" value="{{old('first_name')}}" />
                                @error('first_name')
                                <div class="ml-3 invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="last_name" placeholder="Last Name" placeholder="last_name" name="last_name" value="{{old('last_name')}}" />
                                @error('last_name')
                                <div class="ml-3 invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email" value="{{old('email')}}">
                            @error('email')
                            <div class="ml-3 invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{old('password')}}">
                            @error('password')
                            <div class="ml-3 invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection