@extends('layouts.app')

@section('content')
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Thanks For Your Purchase</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Thanks for your Order, <span
                                    style="color: #a8729a;">{{ $order->user->name }}</span>!</h5>
                        </div>
                        <div class="card-body p-4">
                            @foreach ($order->orderDetails as $detail)
                                <div class="card shadow-0 border mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ asset($detail->product->image_url) }}" class="img-fluid"
                                                    alt="{{ $detail->product->name }}">
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">{{ $detail->product->name }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{ $detail->product->category }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Qty: {{ $detail->quantity }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">${{ number_format($detail->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between pt-2">
                                <p class="fw-bold mb-0">Order Details</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span>
                                    ${{ number_format($order->total_price, 2) }}</p>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <p class="text-muted mb-0">Invoice Number : {{ $order->id }}</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="text-muted mb-0">Invoice Date : {{ $order->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                        <div class="card-footer border-0 px-4 py-5"
                            style="background-color: #080808; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                                paid: <span class="h2 mb-0 ms-2"> Rp.{{ number_format($order->total_price, 0, ',', '.') }}</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
