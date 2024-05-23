<div class="col-12 h-100">
    <div class="d-md-flex justify-content-between align-items-center col-12">
        <span class="h3">Create your seller account</span>
        <span>Already have an account? <a href="{{ route('seller.login') }}" class="blue-link">Login here</a></span>
    </div>

    <div class="bg-white py-4 px-md-5 px-2 mt-5">
        <form class="d-flex col-12 auth-form flex-wrap" wire:submit.prevent="register">
            <div class="col-md-6 col-12 pe-md-3">
                <div>
                    <label for="username">Username</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="username" placeholder="Username" wire:model="username">
                    </div>
                    @if($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div class="my-3">
                    <label for="email">Email</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="email" placeholder="name@domain.com" wire:model="email">
                    </div>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="my-3">
                    <label for="password">Password</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="password" id="password" placeholder="Minimum 6 character with number and letter." wire:model="password">
                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="my-3">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="password" id="confirm_password" placeholder="Confirm Password" wire:model="confirm_password">
                    </div>
                    @if($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    @endif
                </div>

                <div class="my-3">
                    <label for="phone_number">Phone Number</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="phone_number" placeholder="0123456789" wire:model="phone_number">
                    </div>
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 col-12 ps-md-3">
                <div>
                    <span>Store Image/Profile Image</span>
                    <div class="mt-2 border col-12 p-3">
                        <input type="file" id="profile_image" wire:model="profile_image" accept="image/*">
                        <label class="pointer" for="profile_image">{{ $profile_image ? $profile_image->getClientOriginalName() : 'Upload Image' }}</label>
                    </div>
                    @if($errors->has('profile_image'))
                        <span class="text-danger">{{ $errors->first('profile_image') }}</span>
                    @endif
                </div>

                <div class="my-3">
                    <label for="store_name">Store Name</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="store_name" placeholder="Store Name" wire:model="store_name">
                    </div>
                    @if($errors->has('store_name'))
                        <span class="text-danger">{{ $errors->first('store_name') }}</span>
                    @endif
                </div>

                <div class="my-3">
                    <label for="store_address">Store Address</label>
                    <div class="mt-2 border">
                        <input class="col-12 p-3" type="text" id="store_address" placeholder="Store Address" wire:model="store_address">
                    </div>
                    @if($errors->has('store_address'))
                        <span class="text-danger">{{ $errors->first('store_address') }}</span>
                    @endif
                </div>

                <div class="my-3 d-md-flex">
                    <div class="me-md-3 col-md-6 col-12">
                        <label for="area">Area</label>
                        <div class="mt-2 border">
                            <input class="col-12 p-3" type="text" id="area" wire:model="area">
                        </div>
                        @if($errors->has('area'))
                            <span class="text-danger">{{ $errors->first('area') }}</span>
                        @endif
                    </div>
                    <div class="ms-md-3 col-md-6 col-12">
                        <label for="state">State</label>
                        <div class="mt-2 border p-3">
                            <select wire:model="state" id="state" class="col-12">
                                <option value="" selected>--Select State--</option>
                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                <option value="Johor">Johor</option>
                                <option value="Kedah">Kedah</option>
                                <option value="Kelantan">Kelantan</option>
                                <option value="Melaka">Melaka</option>
                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                <option value="Pahang">Pahang</option>
                                <option value="Penang">Penang</option>
                                <option value="Perak">Perak</option>
                                <option value="Perlis">Perlis</option>
                                <option value="Sabah">Sabah</option>
                                <option value="Sarawak">Sarawak</option>
                                <option value="Selangor">Selangor</option>
                                <option value="Terengganu">Terengganu</option>
                                <option value="Labuan">Labuan</option>
                                <option value="Putrajaya">Putrajaya</option>
                            </select>
                        </div>
                        @if($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                    </div>
                </div>

                <div class="my-3 d-md-flex">
                    <div class="me-md-3 col-md-6 col-12">
                        <label for="open_time">Open Time</label>
                        <div class="mt-2 border">
                            <input class="col-12 p-3" type="time" id="open_time" wire:model="open_time">
                        </div>
                        @if($errors->has('open_time'))
                            <span class="text-danger">{{ $errors->first('open_time') }}</span>
                        @endif
                    </div>
                    <div class="ms-md-3 col-md-6 col-12">
                        <label for="close_time">Close Time</label>
                        <div class="mt-2 border">
                            <input class="col-12 p-3" type="time" id="close_time" wire:model="close_time">
                        </div>
                        @if($errors->has('close_time'))
                            <span class="text-danger">{{ $errors->first('close_time') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="my-3 col-12 text-center">
                <button type="submit" class="auth-btn col-5 py-2" wire:loading.attr="disabled">Register</button>
            </div>
        </form>
    </div>
    <script>
        $("#store_address").change(function (){
            let address = $("#store_address").val() + `, ${$("#area").val()}, ${$("#state").val()}`;
            address = encodeURI(address);

            $.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key={{ env('GOOGLE_MAP_API_KEY') }}`, function (data){
                Livewire.first().call('updateCoordinate', data.results[0].geometry.location.lat, data.results[0].geometry.location.lng)
            })
        })
    </script>
</div>
