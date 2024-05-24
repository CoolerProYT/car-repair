@php
use Illuminate\Support\Facades\Route;
@endphp
<div class="sidebar bg-white shadow-sm">
    <div class="logo col-12 text-center py-1 border-bottom">
        <img id="big-logo" src="{{ asset('image/logo.png') }}">
        <img id="small-logo" src="{{ asset('image/small-logo.png') }}">
    </div>

    <div class="big-sidebar">
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/dashboard.svg') }}">
                <span class="ms-2">Dashboard</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'admin.product' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.product') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/product.svg') }}">
                <span class="ms-2">Product</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'admin.emergency' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.emergency') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/emergency.svg') }}">
                <span class="ms-2">E. Service</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'admin.slideshow' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.slideshow') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/slideshow.svg') }}">
                <span class="ms-2">Slideshow</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'admin.withdraw' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.withdraw') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/withdraw.svg') }}">
                <span class="ms-2">Withdraw</span>
            </a>
        </div>
    </div>

    <div class="small-sidebar">
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <img class="col-8" src="{{ asset('icon/dashboard.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'admin.product' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.product') }}">
                <img class="col-8" src="{{ asset('icon/product.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Product">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'admin.emergency' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.emergency') }}">
                <img class="col-8" src="{{ asset('icon/emergency.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Emergency Service">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'admin.slideshow' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.slideshow') }}">
                <img class="col-8" src="{{ asset('icon/slideshow.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Slideshow Management">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'admin.withdraw' ? 'bg-light' : '' }}">
            <a href="{{ route('admin.withdraw') }}">
                <img class="col-8" src="{{ asset('icon/withdraw.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Withdraw Management">
            </a>
        </div>
    </div>

    <script>
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</div>
