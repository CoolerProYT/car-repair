<div class="header bg-white shadow-sm col-12 px-4 py-md-3 py-2 d-flex justify-content-between align-items-center sticky-top">
    <div>
        <span class="h2">
            @switch(\Illuminate\Support\Facades\Route::currentRouteName())
                @case('admin.dashboard')
                    Dashboard
                    @break
                @case('admin.product')
                    Product Management
                    @break
                @case('admin.emergency')
                    Emergency Service Management
                    @break
                @case('admin.slideshow')
                    Slideshow Management
                    @break
            @endswitch
        </span>
    </div>
    <div>
        <div class="dropdown">
            <button type="button" data-bs-toggle="dropdown" class="btn dropdown-toggle d-flex align-items-center">
                @php
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $url = $disk->url(\Illuminate\Support\Facades\Auth::guard('admin')->user()->profile_image);
                @endphp
                <div class="profile-image border">
                    <img src="{{ $url }}" class="rounded-circle">
                </div>
                <span class="d-none d-md-inline ms-2">{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->username }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
