<div class="col-12 bg-white sticky-top">
    <div class="container text-center py-2 d-md-flex align-items-center col-12 justify-content-between">
        <div class="col-6 d-md-flex align-items-center">
            <img id="logo" src="{{ asset('image/logo.png') }}">
            <form class="col-12 ms-4 d-flex" style="background-color: #F4F3F6" wire:submit.prevent="searchProduct">
                <input class="search-box col-12" type="text" placeholder="Search products..." wire:model="search">
                <button class="search-btn px-3">
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
                        <li><a class="dropdown-item" href="#">Link 2</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        @else
            <a href="{{ route('user.login') }}" class="btn btn-outline-dark">Login</a>
        @endif
    </div>
    <div class="col-6 container py-2 d-flex justify-content-between">
        <div>
            <a href="{{ route('user.home') }}" class="nav-link">Home</a>
        </div>
        <div>
            <div class="dropdown">
                <span class="pointer dropdown-toggle" data-bs-toggle="dropdown">Emergency Services</span>
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
                <span class="pointer dropdown-toggle" data-bs-toggle="dropdown">Products Category</span>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach($categories as $category)
                        <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <a href="" class="nav-link">Contact Us</a>
        </div>
    </div>
</div>
