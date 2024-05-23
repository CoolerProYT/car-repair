<div class="px-5 py-4">
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('seller.product') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.product' ? 'bg-primary text-light' : 'text-dark' }}">All Product</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('seller.product.add') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.product.add' ? 'bg-primary text-light' : 'text-dark' }}">Add Product</a>
            </li>
        </ul>
    </div>
</div>
