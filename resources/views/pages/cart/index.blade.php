@extends('layouts.app')

@section('content')
<div class="page-heading about-page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Your Cart Is Beautiful</h2>
                    <span>Let's Checkout</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="h-100 h-custom" style="background-color: #ffffff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted">{{ count($cart ?? []) }} items</h6>
                                    </div>
                                    <hr class="my-4">
                                    @foreach ($cart as $id => $item)
                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ asset($item['image']) }}" class="img-fluid rounded-3" alt="{{ $item['name'] }}">
                                            </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h6 class="text-black mb-0">{{ $item['name'] }}</h6>
                                    </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <!-- Decrease button -->
                                    <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                     @csrf
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-minus"></i></button>
                                     </form>
                                    <span class="quantity-display px-3">{{ $item['quantity'] }}</span>
                                    <!-- Increase button -->
                                     <form action="{{ route('cart.increase', $id) }}" method="POST">
                                     @csrf
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                                        </form>
                                        </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h6 class="price-display mb-0">Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <!-- Remove button -->
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-muted"><i class="fa fa-times"></i></button>
                                        </form>
                                     </div>
                                    </div>
                                    @endforeach

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="{{ route('index') }}" class="text-body"><i class="fa fa-long-arrow-left"></i> Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5>Rp. {{ number_format(array_sum(array_map(function($item) {
                                            return $item['price'] * $item['quantity'];
                                        }, $cart)), 0, ',', '.') }}</h5>
                                      </div>
                    
                                      <form action="{{ route('orders.checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Checkout</button>
                                    </form>                                                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
