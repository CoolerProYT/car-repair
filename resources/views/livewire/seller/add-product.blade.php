<div class="px-5">
    @if($flag)
        <div class="pop-up">
            <div class="bg-white p-3 shadow-sm">
                <div>
                    <span class="h2">Add Category</span>
                </div>
                <form wire:submit.prevent="addCategory">
                    <label class="form-label">Category:</label>
                    <input type="text" wire:model="new_category" class="form-control">
                    @if($errors->has('new_category'))
                        <div>
                            <span class="text-danger">{{ $errors->first('new_category') }}</span>
                        </div>
                    @endif
                    <button type="submit" class="mt-3 btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary mt-3" wire:click="updateFlag(false)">Cancel</button>
                </form>
            </div>
        </div>
    @endif
    <div class="bg-white p-3 shadow-sm">
        <span class="h2">Add Product</span>
        <div class="my-3">
            <form wire:submit.prevent="uploadProduct">
                <div>
                    <span class="form-label">Product Image:</span>
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
                <div class="my-3 col-6">
                    <label for="name" class="form-label">Product Name:</label>
                    <input type="text" class="form-control" id="name" wire:model="name">
                    @if($errors->has('name'))
                        <div>
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-6">
                    <label for="desc" class="form-label">Product Description:</label>
                    <textarea wire:model="description" id="desc" class="form-control" style="max-height: 200px;min-height: 200px"></textarea>
                    @if($errors->has('description'))
                        <div>
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-12 d-flex">
                    <div class="col-6">
                        <label for="category" class="form-label">Product Category:</label>
                        <select id="category" class="form-select" wire:model="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name}}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <div>
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="ms-3 align-self-end">
                        <button type="button" class="btn btn-primary" wire:click="updateFlag(true)">Add Category</button>
                    </div>
                </div>
                <div class="my-3 col-6">
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
                <div class="my-3 col-6">
                    <label for="deposit" class="form-label">Deposit:</label>
                    <input type="number" step="0.01" class="form-control" id="deposit" wire:model="deposit">
                    @if($errors->has('deposit'))
                        <div>
                            <span class="text-danger">{{ $errors->first('deposit') }}</span>
                        </div>
                    @endif
                </div>
                <div class="my-3 col-6">
                    <button type="submit" class="btn btn-primary col-12">Add product</button>
                </div>
            </form>
        </div>
    </div>
</div>
