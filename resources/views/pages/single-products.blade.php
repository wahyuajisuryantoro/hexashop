@extends('layouts.app')

@section('content')
<!-- ***** Main Banner Area Start ***** -->
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Single Product Page</h2>
                    <span>{{ $product->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->
<!-- ***** Product Area Starts ***** -->
<section class="section mt-13" id="product">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="left-images">
                    <img src="{{ asset($product->image_url) }}" alt="product image"/>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content">
                    <h4>{{ $product->name }}</h4>
                    <span class="price">Rp. {{ number_format($product->price,  0, ',', '.') }}</span>
                    <div class="quote">
                        <span>{{ $product->description }}</span>
                    </div>
                    <form action="{{ route('add.cart', $product->id) }}" method="POST">
                        @csrf
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>No. of Orders</h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="input-text qty text" size="4">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="total" style="display: flex; align-items: center; justify-content: space-between;">
                            <button type="submit" class="main-border-button">Add To Cart</button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Product Area Ends ***** -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusButton = document.querySelector('.minus');
        const plusButton = document.querySelector('.plus');
        const quantityInput = document.querySelector('.input-text.qty');
        const pricePerItem = {{ $product->price }};
        const totalSpan = document.getElementById('product-total');
    
        minusButton.addEventListener('click', function() {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotal();
            }
        });
    
        plusButton.addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotal();
        });
    
        function updateTotal() {
            const total = (parseFloat(quantityInput.value) * pricePerItem).toFixed(2);
            totalSpan.textContent = `$${total}`;
        }
    });
    </script>
    
@endsection
