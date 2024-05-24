<div class="col-12 bg-white px-3">
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 py-4 row-cols-md-5 border-bottom">
            <div class="col mb-3">

            </div>

            <div class="col mb-3">
                <h5>Become a Seller</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('seller.login') }}" class="nav-link p-0 text-muted">Seller Portal</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Browse</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('user.home') }}" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('user.emergency',['category' => 'Tow Truck']) }}" class="nav-link p-0 text-muted">Emergency Service</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('user.product',['category' => 'all']) }}" class="nav-link p-0 text-muted">All Products</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('user.contact') }}" class="nav-link p-0 text-muted">Contact Us</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>New User</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('user.login') }}" class="nav-link p-0 text-muted">Login</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('user.register') }}" class="nav-link p-0 text-muted">Register</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('user.reset_password') }}" class="nav-link p-0 text-muted">Reset Password</a></li>
                </ul>
            </div>
        </footer>
        <div class="col-12 mt-3 pb-3 text-center">
            <p class="text-muted">Car Repair © 2024</p>
        </div>
    </div>
</div>
