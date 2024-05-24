<div class="px-md-5 px-3">
    @if($flag == 'name')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Store Name</span>
                <form wire:submit.prevent="changeName">
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Store Name: </span>
                            <input type="text" wire:model="store_name" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('store_name'))
                        <span class="text-danger">{{ $errors->first('store_name') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'address')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow col-md-6 col-lg-4">
                <span class="h3">Change Store Address</span>
                <form wire:submit.prevent="changeAddress">
                    <div class="my-3 d-flex align-items-center">
                        <div class="col-12">
                            <span class="h5">Store Address: </span>
                            <input type="text" id="address" wire:model="store_address" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('store_address'))
                        <span class="text-danger">{{ $errors->first('store_address') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'time')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Open/Close Time</span>
                <form wire:submit.prevent="changeTime">
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Open Time: </span>
                            <input type="time" wire:model="open_time" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('open_time'))
                        <span class="text-danger">{{ $errors->first('open_time') }}</span>
                    @endif
                    <div class="my-3 d-flex align-items-center">
                        <div>
                            <span class="h5">Close Time: </span>
                            <input type="time" wire:model="close_time" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('close_time'))
                        <span class="text-danger">{{ $errors->first('close_time') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'state')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow col-md-6 col-lg-4">
                <span class="h3">Change State</span>
                <form wire:submit.prevent="changeState">
                    <div class="my-3 d-flex align-items-center">
                        <div class="col-12">
                            <span class="h5">State: </span>
                            <select wire:model="state" id="state" class="form-select">
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
                    </div>
                    @if($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger ms-2" wire:click="updateFlag('')" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($flag == 'area')
        <div class="pop-up">
            <div class="bg-white rounded p-3 shadow">
                <span class="h3">Change Area</span>
                <form wire:submit.prevent="changeArea">
                    <div class="my-3 d-flex align-items-center">
                        <div class="col-12">
                            <span class="h5">Area: </span>
                            <input type="text" wire:model="area" class="form-control">
                        </div>
                    </div>
                    @if($errors->has('area'))
                        <span class="text-danger">{{ $errors->first('area') }}</span>
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
        <span class="h2">Shop Settings</span>
        <div>
            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Store Name: </span>
                    <span>{{ $store_name }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('name')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Store Address: </span>
                    <span>{{ $store_address }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('address')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Open Time: </span>
                    <span>{{ (new DateTime($open_time))->format('g:i A') }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('time')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Close Time: </span>
                    <span>{{ (new DateTime($close_time))->format('g:i A') }}</span>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">State: </span>
                    <span>{{ $state }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('state')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>

            <div class="my-3 d-flex align-items-center">
                <div>
                    <span class="h5">Area: </span>
                    <span>{{ $area }}</span>
                </div>
                <div class="ms-1">
                    <button class="btn" wire:click="updateFlag('area')">
                        <img src="{{ asset('icon/edit.svg') }}">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
