<div class="px-md-5 px-3">
    <div class="bg-white p-3 shadow-sm">
        <span class="h2">Add Emergency Service</span>
        <div class="my-3">
            <form wire:submit.prevent="uploadService">
                <div>
                    <span class="form-label">Image:</span>
                    <label for="image" class="pointer image-upload d-flex justify-content-center align-items-center border {{ $image ? 'hover-image-upload' : '' }}">
                        @if($image)
                            <img src={{ $image->temporaryUrl() }}>
                        @else
                            +
                        @endif
                    </label>
                    <input id="image" class="d-none" type="file" accept="image/*" wire:model="image">
                    @if($errors->has('image'))
                        <div>
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-md-6">
                    <label for="name" class="form-label">Service Name:</label>
                    <input type="text" class="form-control" id="name" wire:model="name">
                    @if($errors->has('name'))
                        <div>
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-md-6">
                    <label for="desc" class="form-label">Service Description:</label>
                    <textarea wire:model="description" id="desc" class="form-control" style="max-height: 200px;min-height: 200px"></textarea>
                    @if($errors->has('description'))
                        <div>
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-12 d-flex">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Service Category:</label>
                        <select id="category" class="form-select" wire:model="category">
                            <option value="">Select Category</option>
                            <option value="Tow Truck">Tow Truck</option>
                            <option value="Change Tyre">Change Tyre</option>
                            <option value="Charging">Charging</option>
                            <option value="Petrol">Petrol</option>
                        </select>
                        @if($errors->has('category'))
                            <div>
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="my-3 col-md-6">
                    <div>
                        <b>Price Range:</b>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="pe-2 col-6">
                            <label for="from" class="form-label">From:</label>
                            <input type="number" step="0.01" class="form-control" id="from" wire:model="price_from">
                            @if($errors->has('price_from'))
                                <div>
                                    <span class="text-danger">{{ $errors->first('price_from') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="ps-2 col-6">
                            <label for="to" class="form-label">To:</label>
                            <input type="number" step="0.01" class="form-control" id="to" wire:model="price_to">
                            @if($errors->has('price_to'))
                                <div>
                                    <span class="text-danger">{{ $errors->first('price_to') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="my-3 col-md-6">
                    <label for="deposit" class="form-label">Deposit:</label>
                    <input type="number" step="0.01" class="form-control" id="deposit" wire:model="deposit">
                    @if($errors->has('deposit'))
                        <div>
                            <span class="text-danger">{{ $errors->first('deposit') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-md-6 col-12">
                    <button type="submit" class="btn btn-primary col-12">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
