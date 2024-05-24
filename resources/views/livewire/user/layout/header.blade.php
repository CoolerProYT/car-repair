<div class="col-12 bg-white sticky-top">
    <div class="container text-center py-2 d-flex align-items-center col-12 justify-content-between">
        <div class="col-6 d-flex align-items-center">
            <img class="d-none d-lg-block" id="logo" src="{{ asset('image/logo.png') }}">
            <img class="d-lg-none" id="logo" src="{{ asset('image/small-logo.png') }}">
            <form class="col-12 ms-md-4 d-md-flex d-none" style="background-color: #F4F3F6" wire:submit.prevent="searchProduct">
                <input class="search-box col-12" type="text" placeholder="Search products..." wire:model="search">
                <button class="search-btn px-3" type="submit">
                    <img src="{{ asset('icon/white_search.svg') }}">
                </button>
            </form>
        </div>
        @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
            <div class="d-flex">
                <div>
                    <a href="{{ route('user.chat',['seller_id' => 'none']) }}"><img src="{{ asset('icon/chat.svg') }}"></a>
                </div>
                <div class="dropdown ms-3">
                    <span class="pointer dropdown-toggle" data-bs-toggle="dropdown">{{ \Illuminate\Support\Facades\Auth::guard('user')->user()->username }}</span>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('user.settings') }}">Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.order') }}">My Orders</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        @else
            <a href="{{ route('user.login') }}" class="btn btn-outline-dark">Login</a>
        @endif
    </div>
    <div class="col-lg-6 col-12 container py-2 d-flex justify-content-between">
        <div>
            <a href="{{ route('user.home') }}" class="nav-link">Home</a>
        </div>
        <div>
            <div class="dropdown">
                <span class="pointer dropdown-toggle d-none d-md-block" data-bs-toggle="dropdown">Emergency Services</span>
                <span class="pointer dropdown-toggle d-md-none" data-bs-toggle="dropdown">E. Services</span>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('user.emergency',['category' => 'Tow Truck']) }}">Tow Truck</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.emergency',['category' => 'Change Tyre']) }}">Change Tyre</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.emergency',['category' => 'Charging']) }}">Charging</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.emergency',['category' => 'Petrol']) }}">Petrol</a></li>
                </ul>
            </div>
        </div>
        <div>
            <div class="dropdown">
                <span class="pointer dropdown-toggle d-none d-md-block" data-bs-toggle="dropdown">Products Category</span>
                <span class="pointer dropdown-toggle d-md-none" data-bs-toggle="dropdown">Products</span>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach($categories as $category)
                        <li><a class="dropdown-item" href="{{ route('user.product',['category' => $category->name]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <a href="{{ route('user.contact') }}" class="nav-link d-none d-md-block">Contact Us</a>
            <a href="{{ route('user.contact') }}" class="nav-link d-md-none">Contact</a>
        </div>
    </div>
</div>
