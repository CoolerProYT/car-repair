<div class="header bg-white shadow-sm col-12 px-4 py-md-3 py-2 d-flex justify-content-between align-items-center sticky-top">
    <div>
        <span class="h2">
            @switch(\Illuminate\Support\Facades\Route::currentRouteName())
                @case('seller.dashboard')
                    Dashboard
                    @break
                @case('seller.settings.account')
                @case('seller.settings.shop')
                    Settings
                    @break
                @case('seller.product')
                    Product Management
                    @break
                @case('seller.product.add')
                    Add Product
                    @break
                @case('seller.product.edit')
                    Edit Product
                    @break
                @case('seller.emergency')
                    Emergency Service
                    @break
                @case('seller.emergency.add')
                    Add Emergency Service
                    @break
                @case('seller.emergency.edit')
                    Edit Emergency Service
                    @break
                @case('seller.chat')
                    Chat
                    @break
                @case('seller.order')
                    Order Management
                    @break
                @case('seller.withdraw')
                    Withdraw
                    @break
            @endswitch
        </span>
    </div>
    <div>
        <div class="dropdown">
            <button type="button" data-bs-toggle="dropdown" class="btn dropdown-toggle d-flex align-items-center">
                @php
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $url = $disk->url(\Illuminate\Support\Facades\Auth::guard('seller')->user()->profile_image);
                @endphp
                <div class="profile-image border">
                    <img src="{{ $url }}" class="rounded-circle">
                </div>
                <span class="d-none d-md-inline ms-2">{{ \Illuminate\Support\Facades\Auth::guard('seller')->user()->username }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('seller.settings') }}">Shop Settings</a></li>
                <li><a class="dropdown-item" href="{{ route('seller.logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
