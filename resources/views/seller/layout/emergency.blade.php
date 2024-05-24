<div class="px-md-5 px-3 py-4">
    <div class="d-none d-md-block">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('seller.emergency') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.emergency' ? 'bg-primary text-light' : 'text-dark' }}">All Emergency Service</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('seller.emergency.add') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.emergency.add' ? 'bg-primary text-light' : 'text-dark' }}">Add Emergency Service</a>
            </li>
        </ul>
    </div>
    <div class="d-md-none">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('seller.emergency') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.emergency' ? 'bg-primary text-light' : 'text-dark' }}" style="font-size: 12px">All E.Service</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('seller.emergency.add') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.emergency.add' ? 'bg-primary text-light' : 'text-dark' }}" style="font-size: 12px">Add E.Service</a>
            </li>
        </ul>
    </div>
</div>
