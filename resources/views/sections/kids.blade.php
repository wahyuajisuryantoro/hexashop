    <!-- ***** Kids Area Starts ***** -->
    <section class="section" id="kids">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Kid's Latest</h2>
                        <span>Details to details is what makes Hexashop different from the other themes.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            @foreach ($kidsProducts as $product)
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
                                    <img src="{{ asset($product->image_url) }}">
                                </div>
                                <div class="down-content">
                                    <h4>{{ $product->name }}</h4>
                                    <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <ul class="stars">
                                        <!-- Asumsikan rating belum dinamis, jadi kita hardcode dulu -->
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Kids Area Ends ***** -->