@extends('layouts.app')

@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Check Our Products</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Latest Products</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-lg-4">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="{{ route('products.detail', ['id' => $product->id]) }}"><i class="fa fa-eye"></i></a></li>
                                    <form action="{{ route('add.cart', $product->id) }}" method="POST" style="display: inline; margin: 0; padding: 0;">
                                        @csrf
                                        <button type="submit" style="background-color: #fff; border: none; padding: 0; margin: 0; width: 50px; height: 50px; line-height: 50px; display: inline-block; color: #2a2a2a; text-align: center;">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    
                                </ul>
                            </div>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                        <div class="down-content">
                            <h4>{{ $product->name }}</h4>
                            <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
@endsection