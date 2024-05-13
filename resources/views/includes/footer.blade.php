    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="{{ asset($logoPath) }}" alt="Site Logo" style="max-width: 150px; height: auto;">
                        </div>
                        <ul>
                            <li><a href="#">{{ $profile->store_location ?? 'Default Store Location' }}</a></li>
                            <li><a href="mailto:{{ $profile->email }}">{{ $profile->email ?? 'Default Email' }}</a></li>
                            <li><a href="tel:{{ $profile->phone }}">{{ $profile->phone ?? 'Default Phone Number' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="/?section=men">Men’s Shopping</a></li>
                        <li><a href="/?section=women">Women’s Shopping</a></li>
                        <li><a href="/?section=kids">Kid's Shopping</a></li>
                    </ul>

                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © {{ date('Y') }} {{ $profile->name_store ?? 'Default Store Name' }} All
                            Rights Reserved.
                        <ul>
                            <li><a href="{{ $profile->facebook_url }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $profile->twitter_url }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ $profile->instagram_url }}"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
