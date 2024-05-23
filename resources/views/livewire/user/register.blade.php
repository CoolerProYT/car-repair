<div class="col-12 h-100">
    <div class="d-md-flex text-center justify-content-between align-items-center col-12">
        <span class="h3">Create Your Account</span>
        <span>Already have an account? <a href="{{ route('user.login') }}" class="blue-link">Login here</a></span>
    </div>

    <div class="bg-white py-4 px-md-5 px-2 mt-5 h-75">
        <form class="auth-form d-flex flex-wrap" wire:submit.prevent="register">
            <div class="col-6 pe-3">
                <div class="my-5">
                    <label for="username">Username</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="username" placeholder="Username" wire:model="username">
                    </div>
                    @if($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div class="my-5">
                    <label for="email">Email</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="email" placeholder="name@domain.com" wire:model="email">
                    </div>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="my-5">
                    <div class="d-flex justify-content-between">
                        <label for="phone">Phone Number</label>
                    </div>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="phone" placeholder="0123456789" wire:model="phone">
                    </div>
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-6 ps-3">
                <div class="my-5">
                    <div class="d-flex justify-content-between">
                        <label for="password">Password</label>
                    </div>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="password" id="password" placeholder="Minimum 6 character with number and letter." wire:model="password">
                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="my-5">
                    <div class="d-flex justify-content-between">
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="password" id="confirm_password" placeholder="Confirm Password" wire:model="confirm_password">
                    </div>
                    @if($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    @endif
                </div>
            </div>

            <div class="text-center col-12">
                <button class="auth-btn col-5 py-2" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
