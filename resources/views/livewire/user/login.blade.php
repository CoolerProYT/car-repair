<div class="col-12 h-100">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="text-center py-3">
        <img src="{{ asset('image/logo.png') }}">
    </div>
    <div class="d-lg-flex text-center justify-content-between align-items-center col-12">
        <div>
            <span class="h3 text-light">Welcome to Car Repair! Please login.</span>
        </div>
        <div class="mt-2 my-lg-0">
            <span class="text-light">Doesn't have an account? <a href="{{ route('user.register') }}" class="blue-link">Register here</a></span>
        </div>
    </div>

    <div class="bg-gray-4 py-4 px-md-5 px-2 mt-5 h-75">
        <span class="h2">Login</span>
        <form class="auth-form" wire:submit.prevent="login">
            <div class="my-5">
                <label for="email">Email</label>
                <div class="mt-2 border">
                    <input class="col-12 p-3" type="text" id="email" placeholder="Enter your Email" wire:model="email">
                </div>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="my-5">
                <div class="d-flex justify-content-between">
                    <label for="password">Password</label>
                    <a href="{{ route('user.reset_password') }}" class="blue-link">Forgot Password?</a>
                </div>
                <div class="mt-2 border">
                    <input class="col-12 p-3" type="password" id="password" placeholder="Enter your Password" wire:model="password">
                </div>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="text-center">
                <button class="auth-btn col-5 py-2" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>
