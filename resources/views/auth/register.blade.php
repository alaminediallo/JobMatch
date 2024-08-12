@extends('layouts.auth')

@section('js')
    <!-- Page JS Code -->
    <script src="{{asset('js/pages/op_auth_signup.min.js')}}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('{{asset('media/photos/photo14@2x.jpg')}}');">
        <div class="row g-0 justify-content-center bg-black-75">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <!-- Sign Up Block -->
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div
                        class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx fw-bold fs-1" href="{{ route('home')}}">
                                <span class="text-dark">Job</span><span class="text-primary">Match</span>
                            </a>
                            <p class="text-uppercase fw-bold fs-sm text-muted">Créer un nouveau compte</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign Up Form -->
                        <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Username" value="{{ old('name') }}" autofocus>
                                    <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                </div>
                                @error('name')
                                <div class="text-danger mt-1 fs-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email" required value="{{ old('email') }}">
                                    <span class="input-group-text"><i class="fa fa-envelope-open"></i></span>
                                </div>
                                @error('email')
                                <div class="text-danger mt-1 fs-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="password" class="form-control" id="password"
                                           name="password" placeholder="Password">
                                    <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                </div>
                                @error('password')
                                <div class="text-danger mt-1 fs-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" placeholder="Password Confirm">
                                    <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                </div>
                                @error('password_confirmation')
                                <div class="text-danger mt-1 fs-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-hero btn-primary">
                                    <i class="fa fa-fw fa-plus opacity-50 me-1"></i> S'inscrire
                                </button>
                            </div>
                        </form>
                        <!-- END Sign Up Form -->
                    </div>
                </div>
            </div>
            <!-- END Sign Up Block -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
