<div class="px-md-5 px-3 py-4">
    <form wire:submit.prevent="uploadSlideshow" class="bg-white shadow-sm p-3">
        <div class="mb-3">
            <label for="image" class="form-label">Add new slideshow image:</label>
            <input class="form-control" type="file" id="image" wire:model="image" accept="image/*">
            @error('image') <span class="text-danger">{{ $message }}</span>  @enderror
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>

    <div class="table-responsive my-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-11">Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($slideshows as $slideshow)
                @php
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $url = $disk->url($slideshow->image);
                @endphp
                <tr>
                    <td>
                        <img src="{{ $url }}" alt="slideshow" class="slideshow-table">
                    </td>
                    <td style="vertical-align: middle">
                        <button class="btn btn-danger" wire:click="deleteSlideshow({{ $slideshow->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
