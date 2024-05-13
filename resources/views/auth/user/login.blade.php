@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #FFFFFF;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('assets/images/login.jpg') }}" class="img-fluid"
                                style="object-fit: cover; width: 100%; height: 100%; border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="{{ route('index') }}" class="logo">
                                            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid">
                                        </a>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account
                                    </h5>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="form2Example17" name="email"
                                            class="form-control form-control-lg" placeholder="Email address" required />
                                    </div>

                                    <div class="form-outline mb-4 position-relative">
                                        <input type="password" id="form2Example27" name="password"
                                               class="form-control form-control-lg" placeholder="Password" required />
                                        <i id="togglePassword" class="fa fa-eye-slash position-absolute" style="top: 10px; right: 10px; cursor: pointer;"></i>
                                    </div>
                                    

                                    <div class="pt-1 mb-4">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block">Login</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{ route('register')}}"
                                            style="color: #393f81;">Register here</a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection