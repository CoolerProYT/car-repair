<div class="px-md-5 px-2">
    @if($flag == 'image')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Profile Image</span>
                <form wire:submit.prevent="changeImage">
                    <div class="my-3 d-md-flex text-center align-items-center">
                        <div class="image-box border">
                            <img src="{{ $new_profile_image ? $new_profile_image->temporaryUrl() : $profile_image}}">
                        </div>
                        <div class="ms-3">
                            <input type="file" wire:model="new_profile_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    @if($errors->has('new_profile_image'))
                        <span class="text-danger">{{ $errors->first('new_profile_image') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'username')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Username</span>
                <form wire:submit.prevent="changeUsername">
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Username: </span>
                            <input type="text" wire:model="username" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'email')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Email</span>
                <form wire:submit.prevent="changeEmail">
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Email: </span>
                            <input type="text" wire:model="email" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'phone')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Phone Number</span>
                <form wire:submit.prevent="changePhoneNumber">
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">New Phone Number: </span>
                            <input type="text" wire:model="new_phone_number" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('new_phone_number'))
                        <span class="text-danger">{{ $errors->first('new_phone_number') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'password')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Password</span>
                <form wire:submit.prevent="changePassword">
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Current Password: </span>
                            <input type="password" wire:model="password" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">New Password: </span>
                            <input type="password" wire:model="new_password" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('new_password'))
                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                    @endif
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Confirm New Password: </span>
                            <input type="password" wire:model="confirm_password" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="bg-white px-3 py-2 shadow-sm">
        <span class="h2">Account Settings</span>
        <div>
            <div class="my-3 d-flex align-items-center">
                <div class="image-box border">
                    <img src="{{ $profile_image }}">
                </div>
                <div class="ms-3">
                    <button class="btn" wire:click="updateFlag('image')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Username: </span>
                    <span>{{ $username }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('username')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Email: </span>
                    <span>{{ $email }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('email')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Phone Number: </span>
                    <span>{{ $phone_number }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('phone')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Password: </span>
                    <span>********</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('password')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('updated', event => {
            location.reload();
        });
    </script>
</div>
