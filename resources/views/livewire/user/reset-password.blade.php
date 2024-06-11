<div class="col-12 h-100">
    <div class="text-center py-3">
        <img src="{{ asset('image/logo.png') }}">
    </div>
    <div class="d-md-flex text-center justify-content-between align-items-center col-12">
        <span class="h3 text-light">Reset Your Password Here</span>
        <span class="text-light">Wrongly pressed? <a href="{{ route('user.login') }}" class="blue-link">Login here</a></span>
    </div>

    <div class="bg-gray-4 py-3 px-md-5 px-2 mt-5 h-75">
        <span class="h2">Reset Password</span>
        <form wire:submit.prevent="resetPassword">
            <div class="my-3">
                <label for="email">Email</label>
                <div class="mt-2 border">
                    <input class="col-12 p-3" type="text" id="email" placeholder="Enter your Email" wire:model="email">
                </div>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="my-3">
                <label for="password">New Password</label>
                <div class="mt-2 border">
                    <input class="col-12 p-3" type="password" id="password" placeholder="Minimum 6 character with number and letter." wire:model="password">
                </div>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="my-3">
                <label for="confirm_password">Confirm New Password</label>
                <div class="mt-2 border">
                    <input class="col-12 p-3" type="password" id="confirm_password" placeholder="Confirm Password" wire:model="confirm_password">
                </div>
                @if($errors->has('confirm_password'))
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                @endif
            </div>

            <div class="my-3">
                <label for="verification_code">Verification Code</label>
                <div class="col-12 d-flex align-items-center">
                    <div class="col-6 mt-2 border">
                        <input class="p-3 col-12" type="number" id="verification_code" placeholder="Verification Code" wire:model="verification_code">
                    </div>
                    <button wire:click="getCode" type="button" class="ms-3 btn btn-primary" style="white-space: nowrap" {{ $code_sent ? 'disabled' : '' }}>Get Code</button>
                    @if($verification_code != "")
                        <span class="ms-3 text-primary">Your verification code has been sent to {{ $email }}</span>
                    @endif
                </div>
                @if($errors->has('verification_code'))
                    <span class="text-danger">{{ $errors->first('verification_code') }}</span>
                @endif
            </div>

            <div class="my-4 text-center">
                <button type="submit" class="auth-btn col-md-5 col-12 py-2" {{ $code_sent ? '' : 'disabled' }} style="white-space: nowrap">Change Password</button>
            </div>
        </form>
    </div>
</div>
