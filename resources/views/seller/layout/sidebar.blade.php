@php
use Illuminate\Support\Facades\Route;
@endphp
<div class="sidebar bg-white shadow-sm">
    <div class="logo col-12 text-center py-1 border-bottom">
        <img id="big-logo" src="{{ asset('image/logo-black.png') }}">
        <img id="small-logo" src="{{ asset('image/small-logo.png') }}">
    </div>

    <div class="big-sidebar">
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'seller.dashboard' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.dashboard') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/dashboard.svg') }}">
                <span class="ms-2">Dashboard</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'seller.product' || Route::currentRouteName() == 'seller.product.add' || Route::currentRouteName() == 'seller.product.edit' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.product') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/product.svg') }}">
                <span class="ms-2">Product</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'seller.emergency' || Route::currentRouteName() == 'seller.emergency.add' || Route::currentRouteName() == 'seller.emergency.edit' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.emergency') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/emergency.svg') }}">
                <span class="ms-2">E. Service</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'seller.order' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.order') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/order.svg') }}">
                <span class="ms-2">Order</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'seller.chat' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.chat',['user_id' => 'none']) }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/chat-black.svg') }}">
                <span class="ms-2">Chat</span>
            </a>
        </div>
        <div class="sidebar-link col-12 px-2 py-2 {{ Route::currentRouteName() == 'seller.withdraw' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.withdraw') }}" class="d-flex align-items-center px-2 rounded">
                <img src="{{ asset('icon/withdraw.svg') }}">
                <span class="ms-2">Withdraw</span>
            </a>
        </div>
    </div>

    <div class="small-sidebar">
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'seller.dashboard' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.dashboard') }}">
                <img class="col-8" src="{{ asset('icon/dashboard.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'seller.product' || Route::currentRouteName() == 'seller.product.add' || Route::currentRouteName() == 'seller.product.edit' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.product') }}">
                <img class="col-8" src="{{ asset('icon/product.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Product">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'seller.emergency' || Route::currentRouteName() == 'seller.emergency.add' || Route::currentRouteName() == 'seller.emergency.edit' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.emergency') }}">
                <img class="col-8" src="{{ asset('icon/emergency.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Emergency Service">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'seller.order' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.order') }}">
                <img class="col-8" src="{{ asset('icon/order.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Order">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'seller.chat' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.chat',['user_id' => 'none']) }}">
                <img class="col-8" src="{{ asset('icon/chat.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Chat">
            </a>
        </div>
        <div class="col-12 text-center py-2 {{ Route::currentRouteName() == 'seller.withdraw' ? 'bg-light' : '' }}">
            <a href="{{ route('seller.withdraw') }}">
                <img class="col-8" src="{{ asset('icon/withdraw.svg') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Withdraw">
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
