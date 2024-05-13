@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #FFFFFF;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('assets/images/register.jpg') }}" class="img-fluid"
                                style="object-fit: cover; width: 100%; height: 100%; border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <!-- Perhatikan perubahan action route ke 'register' -->
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="{{ route('index') }}" class="logo">
                                            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid">
                                        </a>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account
                                    </h5>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg"
                                            placeholder="Full Name" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            placeholder="Email Address" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" placeholder="Password" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="shipping_address" name="shipping_address"
                                            class="form-control form-control-lg" placeholder="Shipping Address" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="phone_number" name="phone_number"
                                            class="form-control form-control-lg" placeholder="Phone Number" />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block">Register</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a
                                            href="{{ route('login.user') }}" style="color: #393f81;">Login here</a></p>
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